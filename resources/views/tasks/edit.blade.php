<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $task->name }}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                            <x-textarea name="description" id="description" rows="4" value="{{ $task->description }}"></x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="priority" :value="__('Priority')"/>
                            <x-select id="priority" name="priority" required :options="App\Enums\TaskPriority::cases()" :value="$task->priority" />
                            <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')"/>
                            <x-select id="status" name="status" required :options="App\Enums\TaskStatus::cases()" :value="$task->status" />
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="deadline" :value="__('Deadline')"/>
                            <x-date-input id="deadline" name="deadline" value="{{ $task->deadline }}" required />
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="p-2 bg-blue-500 text-white rounded">{{ __('Update Task') }}</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-500 text-white rounded">{{ __('Delete Task') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
