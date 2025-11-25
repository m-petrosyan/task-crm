@php use App\Enums\StatusEnum; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket #') . $ticket->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">&larr;
                    Back to List</a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="mb-4 p-4 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $ticket->subject }}</h1>
                            <p class="text-gray-500 dark:text-gray-400">
                                Created {{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <select name="status" onchange="this.form.submit()"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach(StatusEnum::cases() as $status)
                                        @php $val = $status->value ?? $status->name; @endphp
                                        <option value="{{ $val }}" {{ $ticket->status == $val ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', strtolower($val))) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold mb-2">Message</h3>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded border dark:border-gray-600">
                                {{ $ticket->text }}
                            </div>

                            @if($ticket->getMedia('attachments')->count() > 0)
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold mb-2">Attachments</h3>
                                    <ul class="list-disc pl-5">
                                        @foreach($ticket->getMedia('attachments') as $media)
                                            <li>
                                                <a href="{{ $media->getUrl() }}" target="_blank"
                                                   class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    {{ $media->file_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded border dark:border-gray-600">
                                <h3 class="text-lg font-semibold mb-4">Customer Info</h3>
                                <p><strong>Name:</strong> {{ $ticket->customer->name }}</p>
                                <p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
                                <p><strong>Phone:</strong> {{ $ticket->customer->phone }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
