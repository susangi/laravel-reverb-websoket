<?php

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Events\ChatTriggerEvent;
use App\Events\OrderDeliveredEvent;
use App\Events\OrderDispatchedEvent;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/broadcast', function() {
    sleep(3);
    event(new OrderDispatchedEvent(auth()->user(), Order::find(1)));
    sleep(5);
    event(new OrderDeliveredEvent(auth()->user(), Order::find(1)));
});

Route::get('orders/{order}', function () {
        
});

require __DIR__.'/auth.php';
