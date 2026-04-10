<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\Post;
use App\Http\Controllers\UserController;


Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function(){
    $posts = Post::all();

    return view('formtest',[
        'posts' => $posts,
    ]);
});

Route::post('/formtest', function(){
    Post::create([
        'description' => request('description'),
    ]);

    return redirect('/formtest');
});

Route::delete('/formtest/{id}', function ($id) {
    Post::findOrFail($id)->delete();

    return redirect('/formtest');
});

Route::get('/delete', function(){
    Post::truncate();  

    return redirect('/formtest');
});


//index
Route::get('/posts', function(){
    $posts = Post::all();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

//show
Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

//edit
Route::get('/posts/{post}/edit', function (Post $post) {
    return view('posts.edit', [
        'post' => $post,
    ]);
}
);

//update
Route::patch('/posts/{post}', function (Post $post) {
    $post->update([
        'description' => request('description'),
        'updated_at' => now(),
    ]);

    return redirect('/posts' . '/' . $post->id);
}
);


// DASHBOARD (default page)
Route::get('/users', [UserController::class, 'index'])->name('users.index');


// STORE USER
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// EDIT FORM
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// UPDATE USER
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// DELETE USER
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

use App\Models\User;
use Illuminate\Http\Request;

// View Route
Route::get('/user-registration', function () {
    $users = User::all();
    return view('user_registration', compact('users'));
});

// Store Route
Route::post('/register-user', function (Request $request) {
    $data = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'age' => 'required|numeric',
        'address' => 'required',
        'contact_number' => 'required',
    ]);
    User::create($data);
    return back()->with('success', 'SYSTEM_SYNC_COMPLETE');
});

// Delete Route
Route::delete('/delete-user/{id}', function ($id) {
    User::findOrFail($id)->delete();
    return back();
});