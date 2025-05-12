<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Main Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12 dashboard-container">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="dashboard-card">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="dashboard-heading mb-6">{{ __('dashboard.system_management') }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Botón para Gestión de Productos (Ejemplo) -->
                            <div>
                                <a href="{{ route('product.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_products') }}
                                </a>
                            </div>

                            <!-- Botones para las otras entidades -->
                            <div>
                                <a href="{{ route('category.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_categories') }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('order.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_orders') }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('customer.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_customers') }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('warehouse.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_warehouses') }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('role.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.manage_roles') }}
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('im.index') }}" class="btn-primary w-full text-center">
                                    {{ __('dashboard.inventory_movements') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
