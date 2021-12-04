<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function todoItems()
    {
        return $this->hasMany(TodoItem::class);
    }
}
