<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function get()
    {
        return auth()->user()->tasks;
    }

    public function toggle(Task $task)
    {
        $task->is_done = !$task->is_done;
        $task->save();

        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function completed()
    {
        return auth()->user()->tasks()->where('is_done', true)->get();
    }

    public function create(Request $request)
    {
        return Task::create([
            'description' => $request->get('task'),
            'is_done' => false,
            'user_id' => auth()->user()->id
        ]);
    }
}
