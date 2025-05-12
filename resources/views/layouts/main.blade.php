<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Final Evidence App')</title>

   
</head>
<body>
<a href="{{ route('dashboard') }}">
    <button type="button">Back to Dashboard</button>
</a>

    <nav>
        <ul>
            <li><a href="{{ route('warehouse.index') }}">Warehouse</a></li>
            <li><a href="{{ route('category.index') }}">Category</a></li>
            <li><a href="{{ route('product.index') }}">Product</a></li>
            <li><a href="{{ route('im.index') }}">Inventory Movement</a></li>
            <li><a href="{{ route('order.index') }}">Order</a></li>
            <li><a href="{{ route('role.index') }}">Role</a></li>
            <li><a href="{{ route('customer.index') }}">Customer</a></li>


            

        </ul>
    </nav>


    <main>
        @yield('content') 
    </main>

   
    <footer>
        <p>&copy; {{ date('Y') }} Final Evidence App</p>
    </footer>
    
</body>
</html>
