<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-6">Edit Product: {{ $product->Name }}</h1>

                    <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="Name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="Name" id="Name" value="{{ old('Name', $product->Name) }}" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        </div>

                        <div>
                            <label for="Description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="Description" id="Description" rows="3" required
                                      class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">{{ old('Description', $product->Description) }}</textarea>
                        </div>

                        <div>
                            <label for="Unit_Price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit Price</label>
                            <input type="number" name="Unit_Price" id="Unit_Price" value="{{ old('Unit_Price', $product->Unit_Price) }}" step="0.01" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        </div>

                        <div>
                            <label for="Stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                            <input type="number" name="Stock" id="Stock" value="{{ old('Stock', $product->Stock) }}" required
                                   class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        </div>

                        <div>
                            <label for="Warehouse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Warehouse</label>
                            <select name="Warehouse" id="Warehouse" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a Warehouse</option>
                                @foreach ($WH as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ old('Warehouse', $product->Warehouse) == $warehouse->id ? 'selected' : '' }}>
                                        {{ $warehouse->id }} - {{ $warehouse->Name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="Category_ID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="Category_ID" id="Category_ID" required
                                    class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900 dark:text-gray-100">
                                <option value="">Select a Category</option>
                                @foreach ($CatID as $category)
                                    <option value="{{ $category->id }}" {{ old('Category_ID', $product->Category_ID) == $category->id ? 'selected' : '' }}>
                                        {{ $category->id }} - {{ $category->Name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('product.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
