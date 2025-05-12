<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-6">Order #{{ $order->id }}</h1>

                    <div class="space-y-4">
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Order ID:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->id }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Customer ID:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->Customer_ID }} 
                                @if($order->customer)
                                    ({{ $order->customer->Name ?? 'N/A' }}) {{-- Assuming 'customer' relationship and 'Name' attribute --}}
                                @endif
                            </p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">User ID (Creator):</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->User_ID }}
                                @if($order->user)
                                    ({{ $order->user->name ?? 'N/A' }}) {{-- Assuming 'user' relationship and 'name' attribute --}}
                                @endif
                            </p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Status:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->Status }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Created At:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->created_at->format('F j, Y, g:i a') }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Updated At:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $order->updated_at->format('F j, Y, g:i a') }}</p>
                        </div>
                         @if($order->label_image_path)
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Label Image:</strong>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $order->label_image_path) }}" alt="Order Label" class="max-w-xs rounded shadow">
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <a href="{{ route('order.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-md transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                        <a href="{{ route('order.edit', $order->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
