<div class="bg-white shadow-xl p-4 w-96">
    <h3 class="text-lg font-bold mb-4"><?php echo e($label['formTitle']); ?></h3>
    <form method="POST" action="<?php echo e($formActionURL); ?>" autocomplete="off">
        <?php echo csrf_field(); ?>
        <?php echo method_field($formActionMethod); ?>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" value="<?php echo e($data['product']['name'] ?? ''); ?>" required autofocus />
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Unit Barang</label>
            <select class="w-full border p-1 focus:outline-none focus:border-blue-800" name="unit_id" required>
                <option value="-">Pilih Unit Barang</option>
                <?php $__currentLoopData = $data['units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($unit['id']); ?>" <?php echo e($data['product']['unit_id'] == $unit['id'] ? 'selected':''); ?>><?php echo e($unit['name']); ?> (<?php echo e($unit['symbol']); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="block text-sm text-gray-600 mb-1">Harga</label>
            <input type="number" step="5" min="0" name="price" class="w-full text-right border p-1 focus:outline-none focus:border-blue-800" value="<?php echo e($data['product']['price'] ?? '0'); ?>" required />
        </div>
        <div class="flex justify-end gap-2">
            <a href="<?php echo e(route('master-products.index')); ?>" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm"><?php echo e($label['submitButton']); ?></button>
        </div>
    </form>
</div>
<?php /**PATH /home/kaspian/Project/laravel-practical-main/resources/views/master/products/form.blade.php ENDPATH**/ ?>