<style>
    nav{
        margin-top:0px;
    }

</style>
    <nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
            
        <div class="row">
                <div class="col-sm-1">
                    <img src="https://ves.ac.in/vesit/wp-content/uploads/sites/3/2018/07/Logo.png" width="42" height="72" alt="Institute of Technology Logo"  data-scale="1"  /> 
                </div>
                <div class="col-md-11">
                    <a href="https://ves.ac.in/vesit/"  title="Institute of Technology">
                        <h3 style="color: blue;margin-left:5px">VIVEKANAND EDUCATION SOCIETY'S<br><i>Institute of Technology</i></h3>
                    </a>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(Auth::guard('teacher')->check()): ?>
                            <li class="nav-item">
                                <a class="nav-link" style="color:blue" href="/teacher">Dashboard</a>
                            </li>
                            <?php if(!Auth::guard('teacher')->check()): ?>
                                <li class="nav-item">
                                  <a class="nav-link" style="color:blue" href="/teacher/entermarks">Enter Marks</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" style="color:blue" href="/teacher/checkstatus">Check Status</a>
                            </li>
                            <li>
                            <a id="navbarDropdown" style="color:blue" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::guard('teacher')->user()->name); ?> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>
                                <a class="dropdown-item" href="/home/profile">
                                    <?php echo e(__('Edit Profile')); ?>

                                </a>
                            </li>
                        
                        <?php elseif(Auth::guard('admin')->check()): ?>
                            <li class="nav-item">
                                <a class="nav-link" style="color:blue" href="">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" style="color:blue" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <?php echo e(Auth::guard('admin')->user()->name); ?><span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <?php echo e(__('Logout')); ?>

                                                </a>
                                                <a class="dropdown-item" href="/teacher/profile">
                                                    <?php echo e(__('Edit Profile')); ?>

                                                </a>
                       
                        <?php elseif(Auth::guard()->check()): ?>

                            <li class="nav-item">
                                <a class="nav-link" style="color:blue" href="/home">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color:blue" href="/home/marks">Check Marks</a>
                            </li>
                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" style="color:blue" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <?php echo e(__('Logout')); ?>

                                                </a>
                                                <a class="dropdown-item" href="/teacher/profile">
                                                    <?php echo e(__('Edit Profile')); ?>

                                                </a>
                       
                <?php else: ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" style="color:blue" href="">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color:blue" href="">About</a>
                        </li>
                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle"  id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font color="blue">Login</font></a>
                                    <div class="dropdown-menu bg-primary" aria-labelledby="dropdown01" >
                                        <a class="dropdown-item" href="<?php echo e(route('login')); ?>">Student</a>
                                        <a class="dropdown-item" href="/login/teacher">Teacher</a>
                                        <a class="dropdown-item" href="/login/admin">Admin</a>
                                    </div>
                                </li>
                                
                                <?php if(Route::has('register')): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font color="blue">Register</font></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown02">
                                        <a class="dropdown-item" href="<?php echo e(route('register')); ?>">Student</a>
                                        <a class="dropdown-item" href="/register/teacher">Teacher</a>
                                    </div>
                                </li>
                                <?php endif; ?>
                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </div>
                                        </li>

                                        <?php endif; ?>
                                        <?php endif; ?>
                                         
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                                    </ul>
                                </div>
                            </nav>
                            <?php /**PATH C:\xampp\htdocs\iars finmaster\resources\views/inc/pracnav.blade.php ENDPATH**/ ?>