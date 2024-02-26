<?php

use app\Http\Controllers\UserController;
use app\Http\Controllers\PostController;
use app\Http\Controllers\EventController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;





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

//basic routing
Route::get('/', function () {
    return view('welcome'); //menampilkan isi dari view (welcome.blade.php)
});

//menambahkan PageController pada route setelah didefinisikan
Route::get('/', [PageController::class, 'index']);

//menambahkan PageController pada route setelah didefinisikan
Route::get('/', [HomeController::class, 'index']);

Route::get('/hello', function () {
    return 'Hello World'; //menampilkan tulisan 'Hello World' langsung di browser
});

//menambahkan WelcomeController pada route setelah didefinisikan
Route::get('/hello', [WelcomeController::class, 'hello']);

Route::get('/world', function () {
    return 'World'; //menampilkan tulisan 'World' langsung di browser
});

Route::get('/about', function () {
    return 'NIM : 2241720010 <br>
    Nama : Maulita Yasmin Nadila'; //menampilkan tulisan 'NIM : 2241720010 Nama : Maulita Yasmin Nadila' lngsung di browser
});

//menambahkan PageController pada route setelah didefinisikan
Route::get('/about', [PageController::class, 'about']);

//menambahkan AboutController pada route setelah didefinisikan
Route::get('/about', [AboutController::class, 'about']);

//Route Parameters
Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' . $name; //menampilkan parameter berupa nama user pada $nama yang diinput dari url
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {     
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId; //menampilkan lebih dari satu parameter pada $postId dan $commentId yang diinput dari url
});

Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel Dengan ID ' . $id; //menampilkan parameter berupa id pada $id yang diinput dari url
});

//menambahkan PageController pada route setelah didefinisikan
Route::get('/articles/{id}', [PageController::class, 'articles']);

//menambahkan ArticlesController pada route setelah didefinisikan
Route::get('/articles/{id}', [ArticlesController::class, 'articles']);

//Optional Parameters
Route::get('/user/{name?}', function ($name=null) { 
    return 'Nama saya '.$name; //menampilkan parameter berupa nama user pada $nama yang diinput dari url bersifat opsional
}); 

Route::get('/user/{name?}', function ($name='John') { 
    return 'Nama saya '.$name; //menampilkan parameter berupa nama user pada $nama yang bersifat opsional
}); //jika nama diinput di url maka nama berubah menjadi apa yang diinput di url

//Route Name
Route::get('/user/profile', function() {     
    // --> merupakan fungsi anonim yang berarti belum ada implementasi atau logika yang dijalankan ketika route tersebut diakses.
})->name('profile'); 

//ex :
Route::get('/', function() {     
    return view('profile');
});
Route::get('/user/profile', function() {     
    $url  = route('user.profile'); //mengambil URL dari Route Name profile
    return 'The url is : '.$url;
})->name('user.profile'); 

//Route Group
Route::middleware(['first', 'second'])->group(function () {     
    Route::get('/', function () {         
        // Uses first & second middleware... 
    });  
    Route::get('/user/profile', function () {         
        // Uses first & second middleware...     
        }); 
    });  
    Route::domain('{account}.example.com')->group(function () {     
        Route::get('user/{id}', function ($account, $id) {         
            //     
        }); 
    });  

    //membuat file UserController, PostController, dan EventController dulu untuk menghindari eror
    Route::middleware('auth')->group(function () {  
        Route::get('/user', [UserController::class, 'index']);  
        Route::get('/post', [PostController::class, 'index']);  
        Route::get('/event', [EventController::class, 'index']);   
    }); 

//Route Prefixes
    Route::prefix('admin')->group(function(){
        Route::get('/user', [UserController::class, 'index']);  
        Route::get('/post', [PostController::class, 'index']);  
        Route::get('/event', [EventController::class, 'index']);
    });

//Redirect Route
    Route::redirect('/here', '/there'); 

//View Route
    Route::view('/welcome', 'welcome'); 
    Route::view('/welcome', 'welcome', ['name' => 'Taylor']); 

//Resource Controller
    Route::resource('photos', PhotoController::class);

    Route::resource('photos', PhotoController::class)->only(['index', 'show']); 
    Route::resource('photos', PhotoController::class)->except(['create', 'store', 'update', 'destroy']);



//Menampilkan View dari Controller
    Route::get('/greeting', [WelcomeController::class, 'greeting']);