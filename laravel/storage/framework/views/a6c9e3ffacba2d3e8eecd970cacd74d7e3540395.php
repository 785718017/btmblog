<?php $__env->startSection('style'); ?>
    <style>
		.index_div{
            width: 1000px;
            height: 450px;          
            margin:0px auto;
            margin-top: 50px;            
        }
        .index_btn{               
            width: 150px;
            height: 150px;
            line-height: 260px;
            border-radius: 100%;
            border:solid #ccc 1px;
            margin-left: 80px;
            margin-top:150px;
            text-align: center;
            color:#fff;
            font-size: 12px;
            cursor: pointer;
        }
        .write_div{
             background-color: #93d477;
        }
        .statistics_div{
             background-color: #3ec3be;
        }
        .message_div{
             background-color: #9087ed;
        }
        .tag_div{
             background-color: #dab517;
        }
        .write{    
            width: 150px;
            height: 150px;          
            background: url("<?php echo e(asset('image/admin/index_write.png')); ?>");
            background-size: 150px 150px;  
            color:#fff;                
        }
        .statistics{    
            width: 150px;
            height: 150px;          
            background: url("<?php echo e(asset('image/admin/index_write.png')); ?>");
            background-size: 150px 150px; 
            color:#fff;                 
        }
        .message{    
            width: 150px;
            height: 150px;          
            background: url("<?php echo e(asset('image/admin/index_message.png')); ?>");
            background-size: 150px 150px;   
            color:#fff;               
        }
        .tag{    
            width: 150px;
            height: 150px;          
            background: url("<?php echo e(asset('image/admin/index_tag.png')); ?>");
            background-size: 150px 150px; 
            color:#fff;            
        }
	</style>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('common_content'); ?>
    <div class='index_div'>
        <div class='index_btn dib write_div'>
            <a href="/Admin/Article/write"><span class='dib write'>写文章</span></a>
        </div>
        <div class='index_btn dib statistics_div'>
            <span class='dib statistics'>统计数据</span>
        </div>
        <div class='index_btn dib message_div'>
            <span class='dib message'>留言</span>
        </div>
        <div class='index_btn dib tag_div'>
            <a href="/Admin/Tags/index"><span class='dib tag'>标签</span></a>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.Common.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>