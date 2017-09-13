<!DOCTYPE html>
<html>
    <head>
        <title>半透明的博客-<?php echo e($page_title); ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/Admin/Common.css')); ?>">
        <style type="text/css">
            *{               
                margin: 0px;
                padding: 0px;
            }
            body{
                font-family: "Microsoft Yahei","Hiragino Sans GB","Helvetica Neue","WenQuanYi Micro Hei","\5B8B\4F53";
            }
        </style>
        <?php $__env->startSection('style'); ?>

            <?php echo $__env->yieldSection(); ?>
    </head>
    <body>
        
        <div class='common_top'>
            
            <?php echo $__env->make('admin/Common/top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class='common_body'>
            
            <div class='common_sidebar'>
                <?php echo $__env->make('admin/Common/sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            
            <div class='common_content'>
                <?php $__env->startSection('common_content'); ?>
                    
                <?php echo $__env->yieldSection(); ?>
            </div>
        </div>
    </body>
</html>
