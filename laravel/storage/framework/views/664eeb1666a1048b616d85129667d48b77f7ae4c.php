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
        <?php $__env->startSection('style_src'); ?>

            <?php echo $__env->yieldSection(); ?>
        <script type="text/javascript" src="<?php echo e(asset('/js/jquery-1.8.3.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('/js/common.js')); ?>"></script>
        <?php $__env->startSection('script_src'); ?>

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
                <div class='common_show_content'>
                    <?php $__env->startSection('common_content'); ?>
                        
                    <?php echo $__env->yieldSection(); ?>
                </div>
            </div>
        </div>
    </body>
    <?php $__env->startSection('script'); ?>

        <?php echo $__env->yieldSection(); ?>
</html>
