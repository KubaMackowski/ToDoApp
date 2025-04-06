<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name">{{ __('Task Name') }}</x-input-label>
                            <x-text-input type="text" name="name" id="name" :value="old('name')" required placeholder="{{ __('Task Name') }}" class="mt-1 block w-full p-2 border rounded"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="description">{{ __('Description') }}</x-input-label>
                            <x-textarea name="description" id="description" rows="4" :value="old('description')" placeholder="{{ __('Task Description') }}"/>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="priority">{{ __('Priority') }}</x-input-label>
                            <x-select name="priority" id="priority" required :value="old('priority')" :options="App\Enums\TaskPriority::cases()"/>
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="status">{{ __('Status') }}</x-input-label>
                            <x-select name="status" id="status" :value="old('status')" required :options="App\Enums\TaskStatus::cases()"/>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="deadline">{{ __('Deadline') }}</x-input-label>
                            <x-date-input type="date" :value="old('deadline')" name="deadline" id="deadline" required/>
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="p-2 bg-blue-500 text-white rounded">{{ __('Create Task') }}</button>
                        </div>
                    </form>
                    <a href="{{ route('tasks.index') }}" class="p-2 bg-gray-500 text-white rounded">{{ __('Back to Task List') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
