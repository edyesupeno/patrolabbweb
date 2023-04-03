<?php

use App\Models\AuditLog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ApiDocsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\CheckPointController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AsetPatroliController;
use App\Http\Controllers\AiMasterDataController;
use App\Http\Controllers\AsetLocationController;
use App\Http\Controllers\ProjectModelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard'); })->name('home');

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('super-admin')) {
        return redirect()->route('admin.dashboard');
    }
})->middleware(['auth', 'verified']);
//Route::get('/dashboard',[SuperAdminController::class,'dashboard'])->middleware(['auth', 'verified','role:super-admin'])->name('dashboard');
//admin route
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'verified', 'role:super-admin']], function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resources([
        'user' => UserController::class,
        'wilayah' => WilayahController::class,
        'area' => AreaController::class,
        'check-point' => CheckPointController::class,
        'guard' => GuardController::class,
        'ai-master' => AiMasterDataController::class,
        'aset' => AsetController::class,
        'hak-akses' => HakAksesController::class,
        'project-model' => ProjectModelController::class,
        'aset-location' => AsetLocationController::class,
        'aset-patroli' => AsetPatroliController::class,
        'shift'=>ShiftController::class,
        'audit-log' => AuditLogController::class

    ]);

    //Route
    Route::get('/project-by-wilayah/{id}', [ProjectModelController::class, 'by_wilayah'])->name('project-by-wilayah');

    //Route Data Table
    Route::get('user-datatable', [UserController::class, 'datatable'])->name('user.datatable');
    Route::get('wilayah-datatable', [WilayahController::class, 'datatable'])->name('wilayah.datatable');
    Route::get('area-datatable', [AreaController::class, 'datatable'])->name('area.datatable');
    Route::get('check-point-datatable', [CheckPointController::class, 'datatable'])->name('check-point.datatable');
    Route::get('aset-location-datatable', [AsetLocationController::class, 'datatable'])->name('aset-location.datatable');
    Route::get('ai-master-datatable', [AiMasterDataController::class, 'datatable'])->name('ai-master.datatable');
    Route::get('aset-datatable', [AsetController::class, 'datatable'])->name('aset.datatable');
    Route::get('project-datatable', [ProjectModelController::class, 'datatable'])->name('project.datatable');
    Route::get('aset-location-datatable', [AsetLocationController::class, 'datatable'])->name('aset-location.datatable');
    Route::get('hak-akses-datatable', [HakAksesController::class, 'datatable'])->name('hak-akses.datatable');

    //Guard
    Route::get('guard-datatable', [GuardController::class, 'datatable'])->name('guard.datatable');

    //Audit Log
    Route::get('audit-log-datatable', [AuditLogController::class, 'datatable'])->name('audit-log.datatable');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';