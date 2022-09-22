<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/mahafaly.css')); ?>">
    <title>Conge.mg</title>
</head>
<body>
    <div class="col-3 d-flex flex-row padding_logo" style="margin-left: 50px;">

    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 tt">
                <div class="img">
                    <img class="img-fluid" style="width: 600px; height: auto" src="<?php echo e(asset('images/izi.png')); ?>" alt="logo">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form ">
                    <h2>Bienvenue chez Conge.mg <span>👋</span> </h2>
                    <p>Veuillez vous connecter à votre compte et commencer l'aventure</p>
                    <form id="form_add_contact" method="POST" action="<?php echo e(route('login')); ?>" class="h-50">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class=" invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mot de passe</label>

                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password"  class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                            <span class="input-group-text" style="height: 35px;"><i class="fa-solid fa-eye align-middle" onclick="affiche()" ></i></span>

                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" >Mot de passe oublie?</a>
                        <button type="submit" id="tes"    class=" btn btn-info btn-block mt-2" style="width:100%;background-color: #7367f0;color: white;"> Se connecter</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    function affiche(){

        var input = document.getElementById("password");
        if (input.type === "password") {
            input.type = 'text'
        } else {
            input.type = 'password'
        }
    }
</script>
</html>
<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/auth/connexion.blade.php ENDPATH**/ ?>