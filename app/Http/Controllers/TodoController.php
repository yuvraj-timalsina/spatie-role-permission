<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:todo-index|todo-create|todo-edit|todo-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:todo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:todo-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:todo-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::latest('updated_at')->get();
        return view('todo.index', compact('todos'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTodoRequest $request
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $data = $request->safe()->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('todo');
            if ($todo->image != null && \Storage::disk('public')->exists($todo->image)) {
                $todo->deleteImage();
            }
        }
        $todo->update($data);

        flasher('Todo has been updated successfully!', 'success');
        return to_route('todos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTodoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $data = $request->safe()->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('todo');
        }

        Todo::create($data);

        flasher('Todo has been saved successfully!', 'success');
        return to_route('todos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->deleteImage();
        $todo->delete();
        flasher('Todo has been deleted successfully!', 'error');
        return to_route('todos.index');
    }
}
