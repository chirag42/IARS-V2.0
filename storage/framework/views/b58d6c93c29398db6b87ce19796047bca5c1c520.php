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
                                    <h4 >Edit Term Work Marks</h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                     <form  action="<?php echo e(action('TeachersController@updateterm',[$student['rollno'],$subject])); ?>" enctype="multipart/form-data" method="POST">
                     <?php echo csrf_field(); ?>
                    
                    <div class="form-group">
                        <p>Roll No.: <?php echo e($student['rollno']); ?></p>
                    </div>
                    
                    <div class="form-group">
                        <p>Full Name: <?php echo e($student['full_name']); ?> </p>
                    </div> 
                    <?php if($subject!='AOA'): ?>
                        <div class="form-group">
                            <label>Attendance</label><input type="text" name="Attendance" class="form-control" value="<?php echo e($student[$subject.'_attendance']); ?>" placeholder="Enter Attendance in %">
                        </div>
                        <div class="form-group">
                            <label>File Marks</label><input type="text" name="File" class="form-control" value="<?php echo e($student[$subject.'_file']); ?>" placeholder="Enter File Marks">
                        </div>
                        <div class="form-group">
                            <label>Mini Project</label><input type="text" name="Mini" class="form-control" value="<?php echo e($student[$subject.'_mini']); ?>" placeholder="Enter Mini Project Marks">
                        </div>
                        <div class="form-group">
                            <label>Total</label><input type="text" name="Total" class="form-control" value="<?php echo e($student[$subject.'_term']); ?>" placeholder="Enter File Marks">
                        </div>
                    <?php else: ?>
                        <div class="form-group">
                            <label>Attendance</label><input type="text" name="Attendance" class="form-control" value="<?php echo e($student[$subject.'_attendance']); ?>" placeholder="Enter Attendance in %">
                        </div>
                        <div class="form-group">
                            <label>File Marks</label><input type="text" name="File" class="form-control" value="<?php echo e($student[$subject.'_file']); ?>" placeholder="Enter File Marks">
                        </div>
                        
                        <div class="form-group">
                            <label>Total</label><input type="text" name="Total" class="form-control" value="<?php echo e($student[$subject.'_term']); ?>" placeholder="Enter Total Term Work /25">
                        </div>
                    <?php endif; ?>
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

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Internal-Assesment-master\resources\views/teacher/editterm.blade.php ENDPATH**/ ?>