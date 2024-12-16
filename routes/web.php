    <?php

    use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
    use App\Http\Controllers\UserController;
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

    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::get('/register',[AuthController::class,'registerForm'])->name('get.register');
    Route::post('/register',[AuthController::class,'register'])->name('post.register');
    Route::post('/login',[AuthController::class,'checklogin'])->name('post.login');


    Route::middleware(['auth:sanctum','role:2'])->group(function () {
    Route::get('user/dashboard', [PostController::class, 'index'])->name('user.dashboard');
    Route::get('user/post/create',[PostController::class,'create'])->name('posts.create');
    Route::post('user/post/store',[PostController::class,'store'])->name('posts.store');
    Route::get('user/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('user/post/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
    Route::post('user/post/update/{id}',[PostController::class,'update'])->name('posts.update');
    Route::get('user/post/destroy/{id}',[PostController::class,'destroy'])->name('posts.destroy');

    Route::get('user/comment', [CommentController::class, 'index'])->name('user.comment');
    Route::post('comment/store',[CommentController::class,'store'])->name('comment.store');
    Route::post('comment/update/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('comment/destroy/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('user/logout', [AuthController::class, 'userLogout'])->name('user.logout');
    
    });

    Route::middleware(['auth:sanctum','role:1'])->group(function () {
    Route::get('admin/dashboard',[UserController::class,'index'])->name('admin.dashboard');
    Route::get('admin/user/create',[UserController::class,'create'])->name('users.create');
    Route::get('admin/user/edit/{id}',[UserController::class,'edit'])->name('users.edit');
    Route::post('admin/user/update/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('user/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });




