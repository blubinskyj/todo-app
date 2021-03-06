<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTodoItemsRequest;
use App\Http\Requests\StoreTodoItemRequest;
use App\Http\Requests\UpdateTodoItemRequest;
use App\Http\Requests\UpdateTodoItemStatusRequest;
use App\Models\TodoItem;
use App\Models\TodoList;

class TodoItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:access,todoList']);
    }

    /**
     * @param TodoList $todoList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(GetTodoItemsRequest $request, TodoList $todoList)
    {
        $todoItems = $todoList->todoItems();
        if ($request->has(['sortField', 'sortOrder']))
            $todoItems->orderBy(
                $request->get('sortField'),
                $request->get('sortOrder')
            );
        return view('todo-item.index', [
            'todoList' => $todoList,
            'todoItems' => $todoItems->paginate(10)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(TodoList $todoList)
    {
        return view('todo-item.create', [
            'todoList' => $todoList
        ]);
    }

    /**
     * @param StoreTodoItemRequest $request
     * @param TodoList $todoList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTodoItemRequest $request, TodoList $todoList)
    {
        TodoItem::create(array_merge(['todo_list_id' => $todoList->id], $request->validated()));
        $request->session()->flash('userActionMessage', 'Todo item successfully created');
        return redirect()->route('todoItems.index', ['todoList' => $todoList->id]);
    }

    /**
     * @param TodoList $todoList
     * @param TodoItem $todoItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(TodoList $todoList, TodoItem $todoItem)
    {
        abort_if(\Auth::user()->cannot('access', [$todoItem, $todoList]), 403);
        return view('todo-item.edit', [
            'todoList' => $todoList,
            'todoItem' => $todoItem
        ]);
    }

    /**
     * @param UpdateTodoItemRequest $request
     * @param TodoList $todoList
     * @param TodoItem $todoItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTodoItemRequest $request, TodoList $todoList, TodoItem $todoItem)
    {
        abort_if(\Auth::user()->cannot('access', [$todoItem, $todoList]), 403);
        $todoItem->update($request->validated());
        $request->session()->flash('userActionMessage', 'Todo item successfully updated');
        return redirect()->route('todoItems.index', ['todoList' => $todoList->id]);
    }

    /**
     * @param UpdateTodoItemStatusRequest $request
     * @param TodoList $todoList
     * @param TodoItem $todoItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(UpdateTodoItemStatusRequest $request, TodoList $todoList, TodoItem $todoItem)
    {
        abort_if(\Auth::user()->cannot('access', [$todoItem, $todoList]), 403);
        $todoItem->status = $request->get('status');
        $todoItem->save();
        $request->session()->flash('userActionMessage', 'Todo item status updated');
        return redirect()->route('todoItems.index', ['todoList' => $todoList->id]);
    }

    /**
     * @param TodoList $todoList
     * @param TodoItem $todoItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TodoList $todoList, TodoItem $todoItem)
    {
        abort_if(\Auth::user()->cannot('access', [$todoItem, $todoList]), 403);
        $todoItem->delete();
        session()->flash('userActionMessage', 'Todo item successfully deleted');
        return redirect()->route('todoItems.index', ['todoList' => $todoList->id]);
    }
}
