<style>
  .card{
            color:white;
            height: 550px;
            margin-top: 50px;
            margin-left: 70px;
            margin-bottom: auto;
            width: 600px;
            background-color:rgba(0,0,0,0.7) !important;
            }
            .sub_btn{
            color: black;
            background-color: #FFC312;
            width: 90px;
            margin-top: 10px;
            }
            
            .sub_btn:hover{
            color: black;
            background-color: white;
            }
          
</style>



<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 40px;">
                <div class="card-body">
                        <div class="row ">
                                <div class="col-md-12 text-md-left">
                                    <h4 >Edit OralPractical Marks</h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                     <form  action="<?php echo e(action('TeachersController@updateOralPrac',[$oral['rollno'],$subject])); ?>" enctype="multipart/form-data" method="POST">
                     <?php echo csrf_field(); ?>
                    
                    <div class="form-group">
                        <p>Roll No.: <?php echo e($oral['rollno']); ?></p>
                    </div>
                    
                    <div class="form-group">
                        <p>Full Name: <?php echo e($oral['full_name']); ?> </p>
                    </div> 

                    <div class="form-group">
                        <label>Marks: </label><input type="text" name="Marks" class="form-control" value="<?php echo e($oral[$subject.'_marks']); ?>" placeholder="Enter Marks">
                    </div>
                    <button type ="submit" class ="btn sub_btn" >Save<i class="fas fa-paper-plane"></i></button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

        
<?php $__env->stopSection(); ?>
<?php if($errors->any()): ?>    
    <ul>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Internal-Assesment-master\resources\views/teacher/re_edit_oralprac.blade.php ENDPATH**/ ?>