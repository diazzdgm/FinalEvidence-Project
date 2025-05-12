<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 mb-6">{{ $product->Name }}</h1>

                    <div class="space-y-4">
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">ID:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->id }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Name:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->Name }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Description:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->Description }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Unit Price:</strong>
                            <p class="text-gray-800 dark:text-gray-200">${{ number_format($product->Unit_Price, 2) }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Stock:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->Stock }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Warehouse:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->Warehouse }} {{-- Consider showing Warehouse Name --}}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Category ID:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->Category_ID }} {{-- Consider showing Category Name --}}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Created At:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->created_at->format('F j, Y, g:i a') }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-600 dark:text-gray-400">Updated At:</strong>
                            <p class="text-gray-800 dark:text-gray-200">{{ $product->updated_at->format('F j, Y, g:i a') }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <a href="{{ route('product.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-md transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                        <a href="{{ route('product.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
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
