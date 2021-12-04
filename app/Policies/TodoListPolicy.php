<?php

namespace App\Policies;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoListPolicy
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

    public function access(User $user, TodoList $todoList)
    {
        return $todoList->user_id === $user->id;
    }

    public function update(User $user, TodoList $todoList)
    {
        return $this->access(user: $user, todoList: $todoList);
    }

    public function delete(User $user, TodoList $todoList)
    {
        return $this->access(user: $user, todoList: $todoList);
    }
}
