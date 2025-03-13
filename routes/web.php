<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [UserController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [UserController::class, 'dashboard']);
Route::get('/thank-you', [EventController::class, 'index']);


// ditambahkan tanggal 25/12/2024 (afri)
Route::get('/home', [UserController::class, 'home'])->middleware(['auth', 'verified'])->name('home');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Arahkan kembali ke halaman utama setelah logout
})->name('logout');

// ---------------------------------------


Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/merchant', ItemController::class);
    Route::put('/merchant/{item}', [ItemController::class, 'update'])->name('merchant.update'); 
    Route::resource('/comment', CommentController::class);

    Route::resource('/topic', TopicController::class);
    Route::resource('/relawan', RelawanController::class);


    Route::resource('/relawan', RelawanController::class);
    Route::get('/relawan/daftar/{event}', [RelawanController::class, 'daftar'])->name('relawan.daftar');
    Route::resource('/event', EventController::class);
    Route::get('/donasi/{event}', [DonasiController::class, 'create'])->name('donasi');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::prefix('event')->name('event.')->group(function () {
            Route::get('/', [AdminController::class, 'eventindex'])->name('index');
            Route::get('/{event}', [AdminController::class, 'eventShow'])->name('show');
            Route::get('/{event}/edit', [AdminController::class, 'eventEdit'])->name('edit');
            Route::put('/{event}/approve', [AdminController::class, 'approveEvent'])->name('approve');
            Route::put('/{event}/reject', [AdminController::class, 'rejectEvent'])->name('reject');
            Route::put('/{event}', [AdminController::class, 'eventUpdate'])->name('update');
            Route::delete('/{event}', [AdminController::class, 'eventDestroy'])->name('destroy');
        });
    });
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'eventindex'])->name('index');

    // Route::resource('/event', EventController::class);  // Admin bisa akses halaman event juga , mungkin?? masih dicoba
});

// Relawan Routes
Route::middleware(['auth', 'role:relawan'])->group(function () {

    // Route::resource('/event', EventController::class);  // Masih dicoba juga
});

Route::middleware(['auth', 'role:admin|relawan'])->group(function () {});



Route::post('/create-transaction', [DonasiController::class, 'createTransaction']);
Route::post('/notification-handler', [DonasiController::class, 'handleNotification']);



// Route::resource('/event', EventController::class);

// Route Afri
Route::get('/about-us', function () {
    return view('aboutUs');
})->name('aboutUs');

Route::get('/login', function () {
    return view('loginPage');
})->name('loginPage');

Route::get('/register', function () {
    return view('registerPage');
})->name('registerPage');

Route::get('/profileUser', function () {
    return view('profileUser');
})->name('profileUser');

Route::get('/userInfo', function () {
    return view('userInfo');
})->name('userInfo');

Route::get('/category', function () {
    return view('category');
})->name('category');

Route::get('/listEvent', function () {
    return view('listEvent');
})->name('listEvent');

Route::get('/eventDetail', function () {
    return view('eventDetail');
})->name('eventDetail');

Route::get('/registEvent', function () {
    return view('registEvent');
})->name('registEvent');

Route::get('/paygate', function () {
    return view('paygate');
})->name('paygate');

Route::get('/createEvent', function () {
    return view('createEvent');
})->name('createEvent');

Route::get('/registRelawan', function () {
    return view('registRelawan');
})->name('registRelawan');

Route::get('/forgetpw', function () {
    return view('forgetpw');
})->name('forgetpw');


Route::post('/payment', [ItemController::class, 'createPayment'])->name('payment.create');


require __DIR__ . '/auth.php';
