<?php


use App\Task;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// origin route is '/'
Route::get('/welcome', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
    // Show tasks dashboard!
    Route::get('/', function(){
    	$tasks = Task::orderBy('created_at', 'asc')->get();

    	return view('tasks', [
    		'tasks' => $tasks
    	]);
    });

    Route::post('/task', function(Request $request){
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|max:255'
    	]);
    	// Do not understand the things after return redirect('/') ...
    	if ($validator->fails()){
    		return redirect('/')
	    		-> withInput()
	    		-> withErrors($validator);
    	}
    	// Create the tasks
    	$task = new Task;
    	$task->name = $request->name;
    	$task->save();

    	return redirect('/');

    });

    Route::delete('/task/{task}', function(Task $task){
    	$task->delete();
    	return redirect('/');

    });
});
