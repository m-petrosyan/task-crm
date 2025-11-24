@php use App\Enums\StatusEnum; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">

                    <div class="mb-6 flex flex-wrap gap-4">
                        <form method="GET" class="flex flex-wrap gap-4 w-full">
                            <select name="status"
                                    class="border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">{{ __('All Statuses') }}</option>
                                @foreach(StatusEnum::cases() as $status)
                                    @php $val = $status->value ?? $status->name; @endphp
                                    <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', strtolower($val))) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="date" name="date" value="{{ request('date') }}"
                                   class="border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search email/phone"
                                   class="border-gray-700 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-white focus:bg-white active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Filter
                            </button>
                            @if(request()->getQueryString())
                                <button type="button" onclick="location.href='{{ url()->current() }}'"
                                        class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Clear
                                </button>
                            @endif
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Customer
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $ticket->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-100">{{ Str::limit($ticket->subject, 30) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        <div class="text-sm font-medium text-gray-100">{{ $ticket->customer->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $ticket->customer->email }}</div>
                                        <div class="text-sm text-gray-400">{{ $ticket->customer->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $ticket->status === 'new' ? 'bg-green-900 text-green-200' : '' }}
                                            {{ $ticket->status === 'in_progress' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                            {{ $ticket->status === 'processed' ? 'bg-gray-700 text-gray-300' : '' }}">
                                            {{ str_replace('_', ' ', $ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-gray-400">{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tickets->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
