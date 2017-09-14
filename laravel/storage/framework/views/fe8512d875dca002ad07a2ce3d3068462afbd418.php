<?php $__env->startSection('style'); ?>
    <script>

    </script>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('common_content'); ?>
    <div>
        
        <div>
            <div>写文章</div>
            <div>标签管理</div>

        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.Common.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>