<div class="bg-white shadow-xl p-4 w-96">
    <h3 class="text-lg font-bold mb-4"><?php echo e($label['formTitle']); ?></h3>
    <form method="POST" action="<?php echo e($formActionURL); ?>" autocomplete="off">
        <?php echo csrf_field(); ?>
        <?php echo method_field($formActionMethod); ?>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="<?php echo e($data['user']['name'] ?? ''); ?>" required autofocus />
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">E-Mail</label>
            <input type="email" name="email" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="<?php echo e($data['user']['email'] ?? ''); ?>" required />
        </div>
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Password <span class="text-xs">(Kosongi jika tidak ingin merubah password)</span></label>
            <input type="password" name="password" class="w-full border p-1 focus:outline-none focus:border-blue-800" <?php echo e(isset($data) ? '':'required'); ?> />
        </div>
        <div class="flex justify-end gap-2">
            <a href="<?php echo e(route('master-users.index')); ?>" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm"><?php echo e($label['submitButton']); ?></button>
        </div>
    </form>
</div>
<?php /**PATH /Users/mekari/Downloads/laravel-practical-main/resources/views/master/users/form.blade.php ENDPATH**/ ?>