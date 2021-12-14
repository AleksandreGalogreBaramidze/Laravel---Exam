<?php

use App\Http\Controllers\TodoListController;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;


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

Route::redirect('/', 'todo', 301);

Route::resource('/todo', TodoListController::class);

Route::get('/delete_completed', function(){

    $completedTodos = Todo::where('completed', "1")->get();
    
    foreach($completedTodos as $todo){
        $todo->delete();
    }
    
    return redirect('/todo')->with('status', "Todo's Deleted Successfully");
});