<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;

    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_DONE = 'DONE';
    const STATUS_CANCELLED = 'CANCELLED';
    

    protected $fillable = [
        'todo_list_id',
        'text',
        'status',
        'status_set_at',
        'created_at',
        'updated_at'
    ];
}
