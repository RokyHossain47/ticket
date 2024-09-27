<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/tt', function () {
    if (Artisan::output() === null) {
        Artisan::call('queue:work');
        return 'Queue worker started.';
    }

    return 'Command not available.';
});


Route::get('/dashboard', function () {
    return view('backend/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');
    Route::get('/open-ticket', [TicketController::class, 'open_ticket'])->name('open-ticket');


    Route::get('/edit-ticket/{id}', [TicketController::class, 'edit'])->name('edit-ticket');
    Route::post('/store-ticket/{action}/{id}', [TicketController::class, 'store'])->name('store-ticket');
    Route::get('/delete-ticket/{id}', [TicketController::class, 'delete'])->name('delete-ticket');

    Route::get('/view/{id}', [TicketController::class, 'view'])->name('view-ticket');


    Route::post('/send-message/{ticket_id}', [TicketController::class, 'send_message'])->name('send-message');


    
    
});

Broadcast::routes(['middleware' => ['auth']]);

Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    return (int) $user->id === (int) Ticket::find($ticketId)->user_id; // Adjust this logic as necessary
});

require __DIR__.'/auth.php';
