<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>LARAVEL PRAKTIKAL</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg p-4 w-96">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-600"><?php echo e($titlePage); ?></h2>

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
        </div>
    </body>
</html><?php /**PATH /home/kaspian/Project/laravel-practical-main/resources/views/index-non-auth.blade.php ENDPATH**/ ?>