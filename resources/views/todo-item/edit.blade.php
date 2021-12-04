<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p>Edit todo Item with ID: {{ $todoItem->id }}</p>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="post" action="{{ route('todoItems.update', ['todoList' => $todoList->id, 'todoItem' => $todoItem->id]) }}">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-label for="text" :value="__('Text')" />

                        <x-input id="text" class="block mt-1 w-full" type="text" name="text" :value="$todoItem->text" required autofocus />
                    </div>
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
