<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-4">
                            <div class="mb-2">
                                <label for="priority" class="block">{{ __('Priority') }}</label>
                                <select name="priority" id="priority" class="p-2 border rounded">
                                    <option value="">{{ __('Priority') }}</option>
                                    @foreach(App\Enums\TaskPriority::cases() as $priority)
                                        <option value="{{ $priority->value }}" {{ request('priority') == $priority->value ? 'selected' : '' }}>
                                            {{ ucfirst($priority->value) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="status" class="block">{{ __('Status') }}</label>
                                <select name="status" id="status" class="p-2 border rounded">
                                    <option value="">{{ __('Status') }}</option>
                                    @foreach(App\Enums\TaskStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ request('status') == $status->value ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="deadline_from" class="block">{{ __('Deadline From') }}</label>
                                <input type="datetime-local" name="deadline_from" id="deadline_from" value="{{ request('deadline_from') }}" class="p-2 border rounded">
                            </div>
                            <div class="mb-2">
                                <label for="deadline_to" class="block">{{ __('Deadline To') }}</label>
                                <input type="datetime-local" name="deadline_to" id="deadline_to" value="{{ request('deadline_to') }}" class="p-2 border rounded">
                            </div>
                            <div class="content-center">
                                <button type="submit" class="p-2 bg-blue-500 rounded">{{ __('Filter') }}</button>
                            </div>
                        </form>
                        <a href="{{ route('tasks.create') }}" class="p-2 bg-green-500 text-white rounded">{{ __('Add Task') }}</a>
                    </div>
                    <ul id="taskList">
                        @foreach($tasks as $task)
                            <li class="task-item p-4 border-b flex justify-between items-center">
                                <div>
                                    <h3 class="font-bold text-lg">{{ $task->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ __('Priority:') }} {{ ucfirst($task->priority->value) }}</p>
                                    <p class="text-sm text-gray-600">{{ __('Status:') }} {{ ucfirst($task->status->value) }}</p>
                                    <p class="text-sm text-gray-600">{{ __('Deadline:') }} {{ $task->deadline }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 hover:underline">{{ __('View') }}</a>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-yellow-500 hover:underline">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        {{ $tasks->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
