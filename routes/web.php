<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Livewire\Acl\Acl;
use App\Http\Livewire\FileUploader;
use App\Http\Livewire\Posts;
use App\Http\Livewire\PostComments;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\PermissionDummydataController;

// Models


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /*
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    */
    Route::get('leave-impersonation', [ImpersonationController::class, 'leave'])
        ->name('leave-impersonation');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Dashboard'), route('dashboard'));
        });

    Route::get('/test', [HomeController::class, 'test'])
        ->name('test')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Test'), route('test'));
        });

    Route::get('/posts', Posts::class)
        ->name('posts')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Posts'), route('posts'));
        });

    Route::get('/post-comments', PostComments::class)
        ->name('post-comments')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('PostComments'), route('post-comments'));
        });
    Route::get('/fileuploads', FileUploader::class)
        ->name('file-uploads')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('FileUploader'), route('file-uploads'));
        });
    Route::get('/todos', [HomeController::class, 'todos'])
        ->name('todos')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Todos'), route('todos'));
        });

    Route::get('/companies', [HomeController::class, 'companies'])
        ->name('companies')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Companies'), route('companies'));
        });

    Route::get('/orders', [HomeController::class, 'orders'])
        ->name('orders')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Orders'), route('orders'));
        });

    Route::get('/acl', Acl::class)
        ->name('acl')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Acl'), route('acl'));
        });

    Route::get('/roles', 'PermissionController@createData')
        ->name('dummydata')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('dashboard')->push(__('Permission DummyData'), route('dummydata'));
        });;
});

/*
 *
 * Route::group(['middleware' => 'role:developer'], function() {

   Route::get('/admin', function() {

      return 'Welcome Admin';

   });

});
 */
/*
 * Sample Breadcrumb
 * Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });
 */
