<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Master Pelanggan</h2>
        <a href="<?php echo e(route('master-customers.create')); ?>" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
            + Tambah
        </a>
    </div>

    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200 border">
                <th class="text-center p-2">No.</th>
                <th class="text-center p-2">Nama</th>
                <th class="text-center p-2">E-Mail</th>
                <th class="text-center p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($data['customers'])): ?>
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data pelanggan</td>
                </tr>
            <?php else: ?>
                <?php $__currentLoopData = $data['customers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center"><?php echo e($i+1); ?></td>
                    <td class="py-2 border-x p-2"><?php echo e($customer['name']); ?></td>
                    <td class="py-2 border-x p-2"><?php echo e($customer['email']); ?></td>
                    <td class="py-2 border-x p-2 text-center">
                        <a href="<?php echo e(route('master-customers.edit', ['customer' => $customer['id']])); ?>">Edit</a> |
                        <a onclick="
                            event.preventDefault();
                            if(confirm('Apakah anda yakin ingin menghapus data : <?php echo e($customer['name']); ?>?')){
                                document.getElementById('form-submit-delete-<?php echo e($customer['id']); ?>').submit()
                            }
                        ">
                            Hapus
                        </a>

                        <form id="form-submit-delete-<?php echo e($customer['id']); ?>" class="hidden" method="post" action="<?php echo e(route('master-customers.destroy', ['customer' => $customer['id']])); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>
    <p class="text-xs mt-3">Total Data : <?php echo e($data['customers']->count()); ?></p>
</div>
<?php /**PATH /home/kaspian/Project/laravel-practical-main/resources/views/master/customers/index.blade.php ENDPATH**/ ?>