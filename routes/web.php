<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

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
});

Route::get('/create', function() {
    $user = new User;
    $user->name = 'Sabir';
    $user->email = 'sabir@gmail.com';
    $user->password = '123455';
    $user->save();
});

Route::get('/insert', function() {
    $user = User::findOrFail(1);
    $post = new Post(['title'=>"Title 2", "body"=>'This is the body 2']);
    $user->posts()->save($post);
    return "Data Inserted";
});

Route::get('/read', function() {
    $user = User::findOrFail(1);
    $userPosts = $user->posts;
    // ddd($userPosts);
    foreach($userPosts as $post){
       echo $post->title ."<br>";
    }
});

Route::get('/update', function() {
    $user = User::findOrFail(1);
    $post = $user->posts()->where('id', '1')->update(['title'=>'The New Title', 'body'=>'The New Body']);
    return "Data Updated";
});

Route::get('/delete', function(){
    $user = User::findOrFail(1);
    $post = $user->posts()->whereId(1)->delete();
    return "Data Deleted";
});
