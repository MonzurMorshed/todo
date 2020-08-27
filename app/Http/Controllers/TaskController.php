<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use DB;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if($user['role'] == 'admin')
            //$tasks = Task::withTrashed()->get();
            $tasks = DB::table('tasks')
            ->leftJoin('users', 'tasks.user_id', '=', 'users.id')
            ->select('users.name as user','tasks.*')
            ->get();
        else
            $tasks = Task::where('user_id', $request->user()->id)->withTrashed()->get();

        return view('todos.index', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        Task::where('id',$request->id)->update(['name' => $request->name]);

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/');
    }

    public function restore($id)
    {
        Task::withTrashed()
        ->where('id', $id)
        ->restore();
        return redirect('/');
    }
}
