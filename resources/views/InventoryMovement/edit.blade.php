<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Inventory Movement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-6">Edit Movement #{{ $IM->id }}</h1>

                    <form action="{{ route('im.update', $IM->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="Product_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product</label>
                            <select name="Product_ID" id="Product_ID" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a Product</option>
                                @foreach ($product as $prod)
                                    <option value="{{ $prod->id }}" {{ old('Product_ID', $IM->Product_ID) == $prod->id ? 'selected' : '' }}>
                                        {{ $prod->id }} - {{ $prod->Name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="Movement_Type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Movement Type</label>
                            <input type="text" name="Movement_Type" id="Movement_Type" value="{{ old('Movement_Type', $IM->Movement_Type) }}" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100"
                                   placeholder="e.g., Purchase, Sale, Adjustment">
                        </div>

                        <div>
                            <label for="Quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                            <input type="number" name="Quantity" id="Quantity" value="{{ old('Quantity', $IM->Quantity) }}" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        </div>
                        
                        <div>
                            <label for="User_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User (Recorded by)</label>
                            <select name="User_ID" id="User_ID" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a User</option>
                                @foreach ($UserID as $user)
                                    <option value="{{ $user->id }}" {{ old('User_ID', $IM->User_ID) == $user->id ? 'selected' : '' }}>
                                        {{ $user->id }} - {{ $user->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('im.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                                Update Movement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
