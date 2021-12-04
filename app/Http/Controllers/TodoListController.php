<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoListRequest;
use App\Http\Requests\UpdateTodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $todoLists = TodoList::where('user_id', \Auth::user()->id)->paginate(20);
        return view('todo-list.index', [
            'todoLists' => $todoLists
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('todo-list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTodoListRequest $request)
    {
        $data = $request->validated();
        TodoList::create(array_merge($data, ['user_id' => \Auth::user()->id]));
        return redirect()->route('todoLists.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TodoList $todoList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TodoList $todoList)
    {
        return view('todo-list.edit', [
            'todoList' => $todoList
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTodoListRequest $request
     * @param TodoList $todoList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTodoListRequest $request, TodoList $todoList)
    {
        $todoList->update($request->validated());
        return redirect()->route('todoLists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TodoList $todoList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TodoList $todoList)
    {
        abort_if(\Auth::user()->cannot('delete', $todoList), 403);
        $todoList->delete();
        return redirect()->route('todoLists.index');
    }
}
