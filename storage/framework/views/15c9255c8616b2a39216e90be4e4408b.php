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
                    <?php $__currentLoopData = config('menu'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a 
                        href="<?php echo e(route($menu['urlPage'])); ?>" 
                        target="<?php echo e($menu['isNewTab'] ? '_blank':''); ?>" 
                        class="block p-2 <?php echo e(request()->routeIs($menu['urlPage']) && (route($menu['urlPage']) === url()->current()) ? "bg-gray-400 hover:bg-gray-500":"block p-2 hover:bg-gray-700"); ?>"
                    >
                        <?php echo e($menu['label']); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>
            </aside>
            <div class="flex-1 flex flex-col">
                <header class="bg-white shadow p-2 flex justify-between">
                    <h1 class="text-xl text-white">Sistem Aplikasi Mini</h1>
                    <div class="relative">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-2 bg-gray-100 px-2 py-1 hover:bg-gray-200 focus:outline-none">
                            <span class="text-gray-700 text-sm font-medium">
                                Hi, <?php echo e($metadata['user_name']); ?>

                            </span>
                        </button>

                        <div id="profileDropdown" class="hidden absolute right-0 mt-0.5 w-20 bg-gray-100 border border-gray-400">
                            <a href="#" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Profile</a>
                            <a href="?page=sign-out" class="block p-1 hover:bg-gray-100 text-gray-700 text-sm">Keluar</a>
                        </div>
                    </div>
                </header>
                <main class="p-2 flex-center">
                    <?php if(session('success')): ?>
                        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 text-sm">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 text-sm">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo $__env->make($subview, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </main>
            </div>
        </div>
        <script src="assets/js/general.js"></script>
    </body>
</html> <?php /**PATH /Users/mekari/Downloads/laravel-practical-main/resources/views/index-with-auth.blade.php ENDPATH**/ ?>