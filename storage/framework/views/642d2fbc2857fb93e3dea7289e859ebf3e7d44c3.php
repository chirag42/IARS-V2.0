<style>
  .card{
            color:white;
            height: 300px;
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

<script type="text/javascript">
    function populate(){
        document.getElementById('sub').options.length = 0;
        document.getElementById('sub').disabled = false;
        var users = <?php echo json_encode($details); ?>;
        var div = document.getElementById('div').value;
        for(i = 0; i<users.length; i++){
            
            if(div == users[i]['division_id']){
                var newOption = document.createElement("option");
                newOption.value = users[i]['subject']['id'];
                newOption.innerHTML = users[i]['subject']['subject'];
                sub.options.add(newOption);
            }
        }
    }
</script>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 40px">
                <div class="card-body">
                        <div class="row ">
                                <div class="col-md-12 text-md-left">
                                    <h4 >Enter/Check Status</h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                    <form method="POST" action = "<?php echo e(action('TeachersController@status')); ?>" >
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Test No:</label>
                            <div class="col-md-4">
                                <select name="test_no">
                                   <option value="1">Test 1</option>
                                   <option value="2">Test 2</option>
                                </select>
                            </div>
                    </div>
                <div class="form-group row">    
                    <label class="col-md-4 col-form-label text-md-right">Select Class:</label>
                        <div class="col-md-4">  
                            <select id="div" name="division_id" onchange = "populate()">
                                <option value="">Select Class:</option>
                               <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value = "<?php echo e($detail->division_id); ?>" ><?php echo e($detail->division->class); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Select Subject:</label>
                      <div class="col-md-4">
                         <select id = "sub" name="subject_no">
                         <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($detail->subject->id); ?>"><?php echo e($detail->subject->subject); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                      </div>
                </div> 
                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-4">
                            <button type ="submit" class ="btn sub_btn" >Submit<i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
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
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Internal-Assesment-master\resources\views/Teacher/checkstatus.blade.php ENDPATH**/ ?>