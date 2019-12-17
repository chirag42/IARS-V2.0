<style>
       .card{
            color: white;
            height: 140px;
            margin-top: 50px;
            /* margin-left: 60px; */
            margin-bottom: auto;
            width: 300px;
            background-color:rgba(0,0,0,0.7) !important;
            }
        .card-footer{
            background-color:rgba(0,0,255,0.6) !important;
        }
        .card-footer:hover{
            color:yellow;
        }
        .card:hover{
            color:blue;
        }
        .social_icon span{
            font-size: 60px;
            margin-right: 10px;
            color: #FFC312;
            }
        .social_icon{
            position: absolute;
            right: 200px;
            top: 20px;
        }
</style>
<?php $__env->startSection('content'); ?>
<div class="container" style="margin-right:20px;margin-top:20px"> 
    <div class="row">
        <div class="col-lg-12">
            
            <h1 style="color:blue"><i class="fas fa-tachometer-alt" style="color: blue;"></i> <strong>Teacher's Dashboard</strong></h1>
            
            <hr  style="border: solid #FFC312">
        </div>
    </div>
    
    <div class="row">
            <a href="/teacher/editmarkslist">
                <div class="col-lg-3 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                                 <div class="card-title text-right">
                                    <div class="social_icon">
                                        <span><i class="fas fa-user"></i></span>
                                    </div>
                                    <h4>Edit UT</h4>
                                </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left">View</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </a>
                
            <a href="/teacher/selectsubject/1">
                <div class="col-lg-3 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                                 <div class="card-title text-right">
                                    <div class="social_icon">
                                    <span><i class="far fa-arrow-alt-circle-right"></i></span>
                                    </div>
                                    <h4>Edit Term Work</h4>
                                </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left">View</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="/teacher/selectsubject/2">
                <div class="col-lg-3 col-md-6">
                    <div class="card ">
                        <div class="card-body">
                                 <div class="card-title text-right">
                                    <div class="social_icon">
                                    <span><i class="far fa-arrow-alt-circle-right"></i></span>
                                    </div>
                                    <h4> Edit Oral and Practical</h4>
                                </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left">View</span>
                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </a>
      
</div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Internal-Assesment-master\resources\views/Teacher/editmarksdash.blade.php ENDPATH**/ ?>