<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-6">Edit Order #{{ $order->id }}</h1>

                    <form action="{{ route('order.update', $order->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="Customer_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                            <select name="Customer_ID" id="Customer_ID" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a Customer</option>
                                @foreach ($customer as $cust)
                                    <option value="{{ $cust->id }}" {{ old('Customer_ID', $order->Customer_ID) == $cust->id ? 'selected' : '' }}>
                                        {{ $cust->id }} - {{ $cust->Name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="User_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User (Order Creator)</label>
                            <select name="User_ID" id="User_ID" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a User</option>
                                @foreach ($user as $usr)
                                    <option value="{{ $usr->id }}" {{ old('User_ID', $order->User_ID) == $usr->id ? 'selected' : '' }}>
                                        {{ $usr->id }} - {{ $usr->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="Status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <input type="text" name="Status" id="Status" value="{{ old('Status', $order->Status) }}" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('order.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                                Update Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
