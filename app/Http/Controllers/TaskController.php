<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
      * Display a listing of the resource.
      */
    public function index(Request $request)
    {
        $search = $request->search;
        $tasks = Task::when($search, function($q, $search) {
                        $q->where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%');
                    })->get();
         return view('task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.form');
    }

     public function store(Request $request)
     {
        $request->validate([
            'title' => 'required',
            'description' => 'string',
        ]);

         $data = $request->all();
         $data['completed'] = $request->has('completed');

         Task::create($data);

         return redirect()->route('tasks.index')->with('success', 'Tarea creada exitosamente.');
     }

     public function edit(Task $task)
     {
        return view('task.form', compact('task'));
     }

    /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, Task $task)
     {
         $request->validate([
             'title' => 'required',
             'description' => 'string',
         ]);

         $data = $request->all();
         $data['completed'] = $request->has('completed');

         $task->update($data);

         return redirect()->route('tasks.index')->with('success', 'Tarea actualizada exitosamente.');
     }

    /**
      * Remove the specified resource from storage.
      */
     public function destroy(Task $task)
     {
         $task->delete();

         return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
     }
}
