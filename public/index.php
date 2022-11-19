<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\TareaController;
use MVC\Router;

$router = new Router();

//Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Create account
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

//Forgot my password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

//Set new passoword
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

//Confirm account
$router->get('/mensaje', [LoginController::class, 'mensaje']); // Una vez llenado el formulario de registro
$router->get('/confirmar', [LoginController::class, 'confirmar']); // Cuando visita el url con el token

//PRIVATE ZONE - PROJECTS
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-proyecto', [DashboardController::class, 'crearProyecto']);
$router->post('/crear-proyecto', [DashboardController::class, 'crearProyecto']);
$router->get('/proyecto', [DashboardController::class, 'proyecto']);
$router->get('/perfil', [DashboardController::class, 'perfil']);
$router->post('/perfil', [DashboardController::class, 'perfil']);
$router->get('/cambiar-contraseña', [DashboardController::class, 'cambiarPassword']);
$router->post('/cambiar-contraseña', [DashboardController::class, 'cambiarPassword']);

//API for "tareas"
$router->get('/api/tareas', [TareaController::class, 'index']); //Query "tareas" from actual project
$router->post('/api/tarea', [TareaController::class, 'crear']);
$router->post('/api/tarea/actualizar', [TareaController::class, 'actualizar']);
$router->post('/api/tarea/eliminar', [TareaController::class, 'eliminar']);

// Checks and validates routes. Set controller functions
$router->comprobarRutas();