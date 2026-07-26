<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH D:\07_ProjectKuliah\yuwaraja2026\vendor\filament\forms\resources\views/components/group.blade.php ENDPATH**/ ?>