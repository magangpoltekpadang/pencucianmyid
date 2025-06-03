<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white shadow-lg">
            <div class="p-4 border-b border-blue-700">
                <h1 class="text-xl font-bold">Sistem Cuci Mobil</h1>
            </div>

            <nav class="mt-4">
                <div class="px-4 py-2 text-sm font-medium text-blue-200">MAIN MENU</div>

                <a href="/"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>

                <a href="/vehicle-types"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-car mr-2"></i> Vehicle Types
                </a>
                <a href="/service-types"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-tools mr-2"></i> Service Types
                </a>
                <a href="/services"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-tools mr-2"></i> Service
                </a>
                <a href="/outlets"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-store mr-2"></i> Outlet
                </a>
                <a href="/payment-methodes"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-credit-card mr-2"></i> Payment Method
                </a>
                <a href="/staffs"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-users mr-2"></i> Staff
                </a>
                <a href="/shifts"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-clock mr-2"></i> Shift
                </a>
                <a href="/expenses"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-dollar-sign mr-2"></i> Expense
                </a>
                <a href="/transactions"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-exchange-alt mr-2"></i> Transaction
                </a>
                <a href="/roles"
                    class="flex px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 items-center">
                    <i class="fas fa-users mr-2"></i> Roles
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-black shadow-sm">
                <div class="flex items-center justify-between px-6 py-2">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
