<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo e(asset('css/manager_interface.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/calendar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/general.css')); ?>">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    
    <link rel="stylesheet" href="<?php echo e(asset('components/css/sidebars.css')); ?>">

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- extra links -->
    <?php echo $__env->yieldPushContent('extra-links'); ?>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    
                    <img class="img-fluid" src="<?php echo e(asset('img/logos_all/iconConge.webp')); ?>" alt="logo" style="max-width: 40px">
                                        <span>Conge.mg</span>
                <header class="header">
                    <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-0">
                        <div class="container-fluid d-none">
                            <div class="left_menu ms-2">
                                <a href="<?php echo e(route('accueil_perso')); ?>">
                                    <p class="titre_text m-0 p-0">

                                    </p>
                                </a>
                            </div>
                        </div>
                    </nav>
                </header>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="dropdownMenuProfil" class="nav-link " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                data-bs-auto-close="outside" aria-expanded="false" v-pre>
                                    
                                    <i class='bx bx-user-circle icon_creer_admin fs-3'></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" id="dropdownMenuProfilContent"
                                aria-labelledby="navbarDropdown" >
                                    
                                    <?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>


                            </li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>


        <?php if(session('info')): ?>
        <div class="alert fade show text-center align-items-center">
            <span class="d-flex align-items-center justify-content-center text-info bg-info bg-opacity-10 p-2 rounded-3 text-info">
                    <span><?php echo e(session('info')); ?></span>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
        <div class="alert fade show text-center align-items-center">
            <span class="d-flex align-items-center justify-content-center text-success bg-success bg-opacity-10 p-2 rounded-3 text-success">
                    <span><?php echo e(session('success')); ?></span>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert fade show text-center align-items-center">
            <span class="align-items-center bg-danger bg-opacity-10 d-flex justify-content-center p-2 rounded-3 text-danger">
                    <span><?php echo e(session('error')); ?></span>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </span>
        </div>
        <?php endif; ?>
        <main class="py-4 ">
            <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


            <?php echo $__env->yieldContent('content'); ?>


        </main>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

<script src="<?php echo e(asset('components/js/sidebars.js')); ?>"></script>

<?php echo $__env->yieldPushContent('extra-scripts'); ?>
<?php echo $__env->yieldPushContent('extra-js'); ?>

</html>

<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/layouts/app.blade.php ENDPATH**/ ?>