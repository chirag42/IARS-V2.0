<!DOCTYPE html>
<style>

#mySidenav a {

  position: absolute;
  left: -110px;
  transition: 0.3s;
  padding: 10px;
  width: 170px;
  text-decoration: none;
  font-size: 20px;
  color: white;
  border-radius: 0 5px 5px 0;
}

#mySidenav a:hover {
  left: 0;
}

#dashboard{
  top: 150px;
  background-color:rgba(0,0,0,0.7) !important;
}

#put {
  top: 330px;
  background-color:rgba(0,0,0,0.7) !important;
}

#check {
  top: 390px;
  background-color:rgba(0,0,0,0.7) !important;
}

#about {
  top: 210px;
  background-color:rgba(0,0,0,0.7) !important;
}
#contact {
  top: 270px;
  background-color:rgba(0,0,0,0.7) !important;
}
span{
     color: #FFC312;
     
}
</style>
 
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'IARS')); ?></title>

    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="https://kit.fontawesome.com/ee8f29eb14.js"></script>

   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

</head>
      <?php echo $__env->make('inc.pracnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div id="mySidenav" class="sidenav">
              <?php if(Auth::guard('teacher')->check()): ?>
                <a href="/teacher" id="dashboard">Dashboard<span><i class="fas fa-tachometer-alt float-right" style="margin-top:5px"></i></span></a>
              <?php elseif(Auth::guard()->check()): ?>
              <a href="/home" id="dashboard">Dashboard<span><i class="fas fa-tachometer-alt float-right" style="margin-top:5px"></i></span></a>
              <?php endif; ?>
                <a href="/about" id="about">About Us<span><i class="fas fa-address-card float-right"  style="margin-top:5px"></i></span></a>
                <a href="#" id="contact">Contact <span><i class="fas fa-phone float-right"  style="margin-top:5px"></i></span></a>
                <?php if(Auth::guard('teacher')->check()): ?>
                <a href="/teacher/putmarks" id="put">Put Marks<span><i class="far fa-check-circle float-right"  style="margin-top:5px"></i></span></a>
                <a href="/teacher/checkstatus" id="check">Status<span><i class="fas fa-search float-right"  style="margin-top:5px"></i></span></a>
                <?php endif; ?>
                
        </div>
             <?php echo $__env->yieldContent('content'); ?>
    
</html>
<?php /**PATH C:\xampp\htdocs\iars finmaster\resources\views/layouts/app1.blade.php ENDPATH**/ ?>