# 🧪 Prueba Técnica – Junior Santamaría

API RESTful desarrollada en Laravel para la gestión de Proyectos y Tareas. Incluye filtros dinámicos, validaciones estrictas, auditoría con `owen-it/laravel-auditing`, documentación Swagger (`L5-Swagger`) y monitoreo con Laravel Telescope.

---

## ✅ Requisitos del sistema

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Laravel 11 o 12
- Node.js (opcional, solo si usas Vite)

---

## 🚀 Instalación paso a paso

```bash
git clone https://github.com/juniorferxd/laravel-mid-level-project-task-api-Junior.git
cd laravel-mid-level-project-task-api-Junior
composer install
cp .env.example .env
```

Edita `.env`:

```env
DB_DATABASE=midlevel_api
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

Accede a la app desde:

```
http://localhost:8000
```

---

## 📚 Cómo levantar Swagger

```bash
php artisan l5-swagger:generate
```

Accede a la documentación:

```
http://localhost:8000/api/documentation
```

---

## 🔍 Cómo ver Telescope

Telescope ya está instalado. Accede desde:

```
http://localhost:8000/telescope
```

Te permitirá monitorear:

- Consultas SQL
- Excepciones
- Logs
- Eventos
- Auditorías de modelos

---

## 🎯 Cómo probar filtros dinámicos

### /api/projects

```
GET /api/projects?status=active&name=Plan&from=2025-01-01&to=2025-12-31
```

### /api/tasks

```
GET /api/tasks?status=done&priority=high&due_date=2025-05-10&project_id=UUID
```

Puedes probarlo con Postman o directamente en Swagger.

---

## 📘 Cómo ver logs de auditoría

Las acciones de **crear, actualizar y eliminar** en Proyectos y Tareas son auditadas automáticamente con:

```
owen-it/laravel-auditing
```

Consulta los registros en la tabla `audits`.

También puedes ver auditorías en Telescope bajo la sección `Models`.


## 📬 Repositorio

[🔗 https://github.com/juniorferxd/laravel-mid-level-project-task-api-Junior](https://github.com/juniorferxd/laravel-mid-level-project-task-api-Junior)
