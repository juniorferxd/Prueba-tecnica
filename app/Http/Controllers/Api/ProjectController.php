<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

/**
 * @OA\Info(
 *     title="API de Gestión de Proyectos",
 *     version="1.0",
 *     description="Documentación de la API para proyectos y tareas"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor principal"
 * )
 */

class ProjectController extends Controller
{

/**
 * @OA\Get(
 *     path="/api/projects",
 *     summary="Listar todos los proyectos",
 *     tags={"Proyectos"},
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Filtrar por estado (active, inactive)",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="Filtrar por nombre del proyecto",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="from",
 *         in="query",
 *         description="Fecha desde (YYYY-MM-DD)",
 *         required=false,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Parameter(
 *         name="to",
 *         in="query",
 *         description="Fecha hasta (YYYY-MM-DD)",
 *         required=false,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listado de proyectos"
 *     )
 * )
 */



    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled(['from', 'to'])) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        return response()->json($query->get());
    }

    /**
 * @OA\Post(
 *     path="/api/projects",
 *     summary="Crear un nuevo proyecto",
 *     tags={"Proyectos"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "status"},
 *             @OA\Property(property="name", type="string", example="Proyecto A"),
 *             @OA\Property(property="description", type="string", example="Descripción del proyecto"),
 *             @OA\Property(property="status", type="string", example="active")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Proyecto creado exitosamente"
 *     )
 * )
 */

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return response()->json($project, 201);
    }

    /**
 * @OA\Get(
 *     path="/api/projects/{id}",
 *     summary="Obtener detalle de un proyecto",
 *     tags={"Proyectos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del proyecto (UUID)",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle del proyecto"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Proyecto no encontrado"
 *     )
 * )
 */

    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
 * @OA\Put(
 *     path="/api/projects/{id}",
 *     summary="Actualizar un proyecto existente",
 *     tags={"Proyectos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del proyecto",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "status"},
 *             @OA\Property(property="name", type="string", example="Proyecto A Modificado"),
 *             @OA\Property(property="description", type="string", example="Nueva descripción"),
 *             @OA\Property(property="status", type="string", example="inactive")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Proyecto actualizado"
 *     )
 * )
 */

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return response()->json($project);
    }

    /**
 * @OA\Delete(
 *     path="/api/projects/{id}",
 *     summary="Eliminar un proyecto",
 *     tags={"Proyectos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del proyecto",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Proyecto eliminado"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Proyecto no encontrado"
 *     )
 * )
 */

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}

