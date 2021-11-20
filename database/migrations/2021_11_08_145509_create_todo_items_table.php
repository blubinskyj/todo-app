<?php

use App\Models\TodoItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_list_id');
            $table->foreign('todo_list_id')->references('id')->on('todo_lists');
            $table->string('text', 255)->nullable(false);
            $table->string('status', 50)->nullable(false)->default(TodoItem::STATUS_IN_PROGRESS);
            $table->dateTime('status_set_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_items');
    }
}
