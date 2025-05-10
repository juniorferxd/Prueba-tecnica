<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

/**
 * @OA\Tag(
 *     name="Tareas",
 *     description="Operaciones relacionadas con las tareas de proyectos"
 * )
 */


class TaskController extends Controller
{

    /**
 * @OA\Get(
 *     path="/api/tasks",
 *     summary="Listar todas las tareas con filtros",
 *     tags={"Tareas"},
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Filtrar por estado (pending, in_progress, done)",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="priority",
 *         in="query",
 *         description="Filtrar por prioridad (low, medium, high)",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="due_date",
 *         in="query",
 *         description="Filtrar por fecha de vencimiento",
 *         required=false,
 *         @OA\Schema(type="string", format="date")
 *     ),
 *     @OA\Parameter(
 *         name="project_id",
 *         in="query",
 *         description="Filtrar por ID del proyecto",
 *         required=false,
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Listado de tareas"
 *     )
 * )
 */


    public function index(Request $request)
    {
        $query = Task::query();

        $query->when($request->filled('status'), fn($q) => $q->where('status', $request->status));
        $query->when($request->filled('priority'), fn($q) => $q->where('priority', $request->priority));
        $query->when($request->filled('due_date'), fn($q) => $q->whereDate('due_date', $request->due_date));
        $query->when($request->filled('project_id'), fn($q) => $q->where('project_id', $request->project_id));

        return response()->json($query->get());
    }

    /**
 * @OA\Post(
 *     path="/api/tasks",
 *     summary="Crear una nueva tarea",
 *     tags={"Tareas"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"project_id", "title", "status", "priority", "due_date"},
 *             @OA\Property(property="project_id", type="string", format="uuid", example="a5b3d2e1-4567-4c9a-b8ff-abc123def456"),
 *             @OA\Property(property="title", type="string", example="Diseñar la base de datos"),
 *             @OA\Property(property="description", type="string", example="Crear esquema relacional"),
 *             @OA\Property(property="status", type="string", example="pending"),
 *             @OA\Property(property="priority", type="string", example="medium"),
 *             @OA\Property(property="due_date", type="string", format="date", example="2025-05-20")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Tarea creada correctamente"
 *     )
 * )
 */

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    /**
 * @OA\Get(
 *     path="/api/tasks/{id}",
 *     summary="Obtener detalle de una tarea",
 *     tags={"Tareas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea (UUID)",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalle de la tarea"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Tarea no encontrada"
 *     )
 * )
 */

    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
 * @OA\Put(
 *     path="/api/tasks/{id}",
 *     summary="Actualizar una tarea existente",
 *     tags={"Tareas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea (UUID)",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"project_id", "title", "status", "priority", "due_date"},
 *             @OA\Property(property="project_id", type="string", format="uuid"),
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="status", type="string"),
 *             @OA\Property(property="priority", type="string"),
 *             @OA\Property(property="due_date", type="string", format="date")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tarea actualizada correctamente"
 *     )
 * )
 */


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return response()->json($task);
    }

    /**
 * @OA\Delete(
 *     path="/api/tasks/{id}",
 *     summary="Eliminar una tarea",
 *     tags={"Tareas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea (UUID)",
 *         @OA\Schema(type="string", format="uuid")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Tarea eliminada correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Tarea no encontrada"
 *     )
 * )
 */

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}

