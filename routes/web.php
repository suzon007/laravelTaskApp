<?php
use Illuminate\Http\Request;
use App\Task;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * Show Task Dashboard
 */
 Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
     return view('tasks', [
       'tasks' => $tasks
     ]);
 });
/**
 * Add New Task
 */
 Route::post('/task', function (Request $request) {
   $validator = Validator::make($request->all(),[
    'name' => 'required|max:255'
   ]);

   if ($validator->fails()) {
     return redirect('/')
          ->withInput()
          ->withErrors($validator);
   }
     // Create table tasks

     $task = new Task;
     $task->name = $request->name;
     $task->save();

     return redirect('/');
 });


 /**
  * Delete Task
  */
 Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
 });
