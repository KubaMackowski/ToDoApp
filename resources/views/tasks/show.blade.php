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
                    @if (isset($taskToken) && !$taskToken->isExpired() && auth()->hasUser())
                        <div class="mt-4">
                            <input type="text" id="public-link" value="{{ route('tasks.public', ['token' => $taskToken->token]) }}" readonly class="w-full p-2 border rounded">
                            <button onclick="copyToClipboard()" class="mt-2 p-2 bg-blue-500 text-white rounded">{{ __('Copy Link') }}</button>
                        </div>
                    @elseif(auth()->hasUser())
                        <div class="mt-4">
                            <form action="{{ route('tasks.generateToken', $task) }}" method="GET">
                                <button type="submit" class="p-2 bg-green-500 text-white rounded">{{ __('Generate Public Link') }}</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("public-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Copied the link: " + copyText.value);
        }
    </script>
</x-app-layout>
