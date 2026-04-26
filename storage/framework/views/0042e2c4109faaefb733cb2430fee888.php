<form method="POST" src="<?php echo e(route('sign-in.process')); ?>">
    <?php echo csrf_field(); ?>
    <div class="mb-2">
        <label class="block text-gray-600 mb-1">E-Mail</label>
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger-500"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <input type="email" name="email" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
    </div>
    <div class="mb-3">
        <label class="block text-gray-600 mb-1">Password</label>
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger-500"><?php echo e($message); ?></span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <input type="password" name="password" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 hover:bg-blue-700">
        Login
    </button>
</form>
<a href="/register" class="text-sm text-blue-600 mt-5">Belum punya akun ? Daftar</a><?php /**PATH /home/kaspian/Project/laravel-practical-main/resources/views/authentication/content-sign-in.blade.php ENDPATH**/ ?>