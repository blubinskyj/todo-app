<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="text-center mb-5">
            <a href="{{ route('todoItems.create', ['todoList' => $todoList->id]) }}" class="mx-auto bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mb-4 ease-linear transition-all duration-15gr">Create</a>
        </div>
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg text-blue-600">{{ Session::get('userActionMessage') }}</div>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form class="mb-2" method="get" action="{{ route('todoItems.index', ['todoList' => $todoList->id]) }}">
                <lable for="sortFieldInput">Sort by field</lable>
                <select class="rounded" name="sortField" id="sortFieldInput">
                    <option value="text">Name</option>
                    <option value="status">Status</option>
                    <option value="created_at">Time</option>
                </select>
                <lable for="sortOrderInput">Sort order</lable>
                <select class="rounded" name="sortOrder" id="sortOrderInput">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <div class="mb-2">

                </div>
                <div class="mb-2">

                </div>
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-15">Apply</button>
            </form>
            @foreach($todoItems as $todoItem)
                <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p class="text-4xl text-center">{{ $todoItem->text }}</p>
                    <p class="text-4xl text-center">Status: {{ $todoItem->status }}</p>
                    @if($todoItem->status === \App\Models\TodoItem::STATUS_DONE)
                    <p>Done at {{ $todoItem->status_set_at }}</p>
                    @endif
                    <a
                        class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        href="{{ route('todoItems.edit', ['todoList' => $todoList->id, 'todoItem' => $todoItem->id]) }}">Edit</a>
                    <form class="inline-block" method="post" action=" {{ route('todoItems.destroy', ['todoList' => $todoList->id, 'todoItem' => $todoItem->id]) }} ">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Delete</button>
                    </form>
                    <form class="inline-block" method="post" action=" {{ route('todoItems.updateStatus', ['todoList' => $todoList->id, 'todoItem' => $todoItem->id]) }} ">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ \App\Models\TodoItem::STATUS_DONE }}">
                        <button class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Set Done</button>
                    </form>
                    <form class="inline-block" method="post" action=" {{ route('todoItems.updateStatus', ['todoList' => $todoList->id, 'todoItem' => $todoItem->id]) }} ">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="{{ \App\Models\TodoItem::STATUS_CANCELLED }}">
                        <button class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Set Cancelled</button>
                    </form>
                </div>
            @endforeach
            {{ $todoItems->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
