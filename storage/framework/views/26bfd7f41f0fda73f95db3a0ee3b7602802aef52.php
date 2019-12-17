<script>
    function disable(num)
    {
        var x = document.getElementById(':'+num).checked;
        if(x)
        {
            document.getElementById(num).value = "-2";
            document.getElementById(num).style.display = 'none';
            document.getElementById(num).required = false;
        }
        else
        {
            document.getElementById(num).value = "";
            document.getElementById(num).required = true;
            document.getElementById(num).style.display = 'inline';
        }
    }
    </script>
<style>
          .card{
            /* height: 500px; */
            /* margin-top: 50px; */
            color: white;
            margin-bottom: auto;
            /* width: 400px; */
            background-color:rgba(0,0,0,0.7) !important;
            }
            table{
                color:white;
            }
            th{
                color:yellow;
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
<div class="col-12">
        <div class="card" style="margin-top:20px">
            <div class="card-body">
         <div class="row ">
                                <div class="col-md-12 text-md-left">
                                    <h4 >Update Marks </h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                <div class="table-responsive">
                        <form method= "POST" >
                                <?php echo csrf_field(); ?>
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead style="text-align:center;">
                        <tr>
                            
                            <th rowspan="2">Roll No</th>
                            <th rowspan="2">Student Name</th>
                            <th colspan="5" >Oral and Practical</th>
                        </tr> 
                        <tr>
                            <th>subject marks</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $orals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e($oral['rollno']); ?></td>
                                <td><?php echo e($oral['full_name']); ?></td>
                                <td><?php echo e($oral[$subject->subject.'_marks']); ?></td>
                                
                                <td><a href="<?php echo e(action('TeachersController@editOralPrac',[$oral['rollno'],$subject->subject] )); ?>" method="get" class="btn sub_btn" style="color:black;">Edit</a></td>
                            </tr>  
                            
                                    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <button type ="submit" class ="btn sub_btn" >Save<i class="fas fa-paper-plane"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\iars finmaster\resources\views/teacher/editoralprac.blade.php ENDPATH**/ ?>