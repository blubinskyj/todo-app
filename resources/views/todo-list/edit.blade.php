<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p>Update todo list with ID:{{ $todoList->id }}</p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="post" action="{{ route('todoLists.update', ['todoList' => $todoList->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$todoList->name" required autofocus />
                    </div>
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
