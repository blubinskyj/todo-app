<?php

namespace App\Policies;

use App\Models\TodoItem;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoItemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function access(User $user, TodoItem $todoItem, TodoList $todoList)
    {
        return $todoItem->todo_list_id === $todoList->id;
    }
}
