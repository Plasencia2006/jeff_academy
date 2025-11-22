<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ObservacionController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\PagoStripeController;
use App\Http\Controllers\ReporteController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');

Route::get('/noticias', [HomeController::class, 'noticias'])->name('noticias.index');
Route::get('/noticias/{id}', [HomeController::class, 'noticiaShow'])->name('noticias.show');

Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');

Route::get('/planes', [HomeController::class, 'planes'])->name('planes');

Route::get('/inscripcion', [HomeController::class, 'inscripcion'])->name('inscripcion');

/*
|--------------------------------------------------------------------------
| Sistema de Registro (Personalizado)
|--------------------------------------------------------------------------
*/

Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');
Route::post('/registro/login', [RegistroController::class, 'login'])->name('registro.login');

Route::middleware(['web'])->group(function () {
    Route::get('/platform', [RegistroController::class, 'platform'])->name('platform');
    Route::post('/registro/logout', [RegistroController::class, 'logout'])->name('registro.logout');
    Route::get('/mis-datos', [RegistroController::class, 'misDatos'])->name('registro.mis-datos');
    Route::get('/elegir-plan', [RegistroController::class, 'elegirPlan'])->name('registro.elegir-plan');
});

/*
|--------------------------------------------------------------------------
| Autenticación nativa (Laravel)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::post('/login', [HomeController::class, 'doLogin'])->name('do.login');

    Route::get('/register', [HomeController::class, 'register'])->name('register');
    Route::post('/register', [HomeController::class, 'doRegister'])->name('do.register');
});

Route::post('/logout', [HomeController::class, 'logout'])->name('logout')->middleware('auth');

Route::delete('/eliminar-cuenta', [RegistroController::class, 'eliminarCuenta'])
    ->name('registro.eliminar-cuenta')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard según rol
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin'  => redirect('/admin/dashboard'),
            'coach'  => redirect('/coach/dashboard'),
            'player' => redirect('/player/dashboard'),
            default  => redirect('/')
        };
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Rutas ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Usuarios
    Route::post('/usuarios', [AdminController::class, 'storeUsuario'])->name('admin.usuarios.store');
    Route::put('/usuarios/{id}', [AdminController::class, 'updateUsuario'])->name('usuarios.update');
    Route::put('/usuarios/{id}/toggle', [AdminController::class, 'destroyUsuario'])->name('usuarios.toggle');
    Route::put('/usuarios/{id}/password', [AdminController::class, 'updatePassword'])->name('usuarios.password');

    // Inscripciones
    Route::post('/inscripciones', [AdminController::class, 'storeInscripcion'])->name('admin.inscripciones.store');

    // Entrenamientos
    Route::post('/entrenamientos', [AdminController::class, 'storeEntrenamiento'])->name('admin.entrenamientos.store');

    // Noticias
    Route::post('/noticias', [AdminController::class, 'storeNoticia'])->name('admin.noticias.store');
    Route::delete('/noticias/{id}', [AdminController::class, 'destroyNoticia'])->name('admin.noticias.destroy');
    Route::put('/noticias/{id}', [AdminController::class, 'updateNoticia'])->name('admin.noticias.update');

    // Pagos
    Route::post('/confirmar-pago', [AdminController::class, 'confirmarPago'])->name('admin.confirmar-pago');
    Route::post('/registrar-pago-manual', [AdminController::class, 'registrarPagoManual'])->name('admin.registrar-pago-manual');

    // Planes
    Route::post('/planes', [AdminController::class, 'storePlan'])->name('admin.planes.store');
    Route::put('/planes/{plan}', [AdminController::class, 'updatePlan'])->name('admin.planes.update');
    Route::delete('/planes/{plan}', [AdminController::class, 'destroyPlan'])->name('admin.planes.destroy');
    Route::get('/planes', [AdminController::class, 'planes'])->name('admin.planes');

    // Disciplinas
    Route::post('/disciplinas', [AdminController::class, 'storeDisciplina'])->name('admin.disciplinas.store');
    Route::put('/disciplinas/{disciplina}', [AdminController::class, 'updateDisciplina'])->name('admin.disciplinas.update');
    Route::delete('/disciplinas/{disciplina}', [AdminController::class, 'destroyDisciplina'])->name('admin.disciplinas.destroy');

    // Reportes
    Route::post('/reportes/generar', [AdminController::class, 'generarReporte'])->name('admin.reportes.generar');

    // Perfil admin
    Route::put('/perfil/update', [AdminController::class, 'updateProfile'])->name('admin.perfil.update');
});

/*
|--------------------------------------------------------------------------
| Rutas COACH
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:coach'])->prefix('coach')->group(function () {

    Route::get('/dashboard', [AsistenciaController::class, 'index'])->name('coach.dashboard');

    // Asistencias
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('coach.asistencias.store');
    Route::get('/asistencias/lista', [AsistenciaController::class, 'lista'])->name('coach.asistencias.lista');

    // Observaciones
    Route::post('/observaciones', [ObservacionController::class, 'store'])->name('coach.observaciones.store');

    // Entrenamientos
    Route::get('/entrenamientos', [EntrenamientoController::class, 'index'])->name('coach.entrenamientos.index');
});

/*
|--------------------------------------------------------------------------
| Rutas PLAYER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:player'])->prefix('player')->group(function () {

    Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('player.dashboard');

    Route::get('/asistencias', [AsistenciaController::class, 'listarPlayer'])->name('player.asistencias');
    Route::get('/entrenamientos', [EntrenamientoController::class, 'playerEntrenamientos'])->name('player.entrenamientos');
    Route::get('/observaciones', [ObservacionController::class, 'playerObservaciones'])->name('player.observaciones');
});


Route::get('/crear-admin', [HomeController::class, 'crearAdmin']);
