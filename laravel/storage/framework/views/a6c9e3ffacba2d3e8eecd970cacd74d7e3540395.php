<?php $__env->startSection('style'); ?>
    <style>
		.index_div{
			width: 1000px;
			height: 450px;			
			margin:0px auto;
			background: red;			
		}
		.index_btn{
			width: 150px;
			height: 150px;
			line-height: 150px;
			border-radius: 100%;
			border:solid #ccc 1px;
			margin-left: 80px;
			margin-top:150px;
			text-align: center;

		}
    </style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('common_content'); ?>
    <div class='index_div'>
       <span class='dib index_btn write_article_btn'>写文章</span>
       <span class='dib index_btn'>统计数据</span>
       <span class='dib index_btn'>留言</span>
       <span class='dib index_btn'>标签</span>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.Common.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>