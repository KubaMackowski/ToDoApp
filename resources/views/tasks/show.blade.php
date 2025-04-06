<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">{{ $task->name }}</h3>
                    <p>{{ $task->description }}</p>
                    <p><strong>{{ __('Priority:') }}</strong> {{ ucfirst($task->priority->value) }}</p>
                    <p><strong>{{ __('Status:') }}</strong> {{ ucfirst(str_replace('_', ' ', $task->status->value)) }}</p>
                    <p><strong>{{ __('Deadline:') }}</strong> {{ $task->deadline }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
