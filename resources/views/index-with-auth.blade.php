<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Laravel Praktikal</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <aside class="bg-gray-800 w-40 text-white">
                <div class="p-2 text-xl font-bold border-b border-gray-700">
                    Mini Aplikasi
                </div>
                <nav>
                    @foreach (config('menu') as $menu)
                    <a 
                        href="{{ route($menu['urlPage']) }}" 
                        target="{{ $menu['isNewTab'] ? '_blank':'' }}" 
                        class="block p-2 {{ request()->routeIs($menu['urlPage']) && (route($menu['urlPage']) === url()->current()) ? "bg-gray-400 hover:bg-gray-500":"block p-2 hover:bg-gray-700" }}"
                    >
                        {{ $menu['label'] }}
                    </a>
                    @endforeach
                </nav>
            </aside>
            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow p-2 flex justify-between">
                    <h1 class="text-xl text-white">Sistem Aplikasi Mini</h1>
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-2 py-1 hover:bg-gray-200 focus:outline-none">
                            <span class="text-gray-700 text-sm font-medium">
                                Hi, {{ $metadata['user_name'] }}
                            </span>
                        </button>

                        <div id="profileDropdown" class="hidden absolute right-0 mt-0.5 w-20 bg-gray-100 border border-gray-400">
                            <a href="#" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Profile</a>
                            <a href="?page=sign-out" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Keluar</a>
                        </div>
                    </div>
                </header>
                <main class="p-2 flex-center">
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @include($subview)
                </main>
            </div>
        </div>
        <script src="assets/js/general.js"></script>
    </body>
</html> 