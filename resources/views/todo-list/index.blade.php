<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="text-center mb-5">
        <a href="{{ route('todoLists.create') }}" class="mx-auto bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mb-4 ease-linear transition-all duration-150">Create</a>
        </div>
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            @foreach($todoLists as $todoList)
                <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p class="text-4xl text-center">{{ $todoList->name }}</p>
                    <a class="bg-yellow-500 text-white active:bg-yellow-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" href="{{ route('todoLists.edit', ['id' => $todoList->id]) }}">Edit</a>
                    <form class="inline-block" method="post" action=" {{route('todoLists.edit', ['id' => $todoList->id])}} ">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
