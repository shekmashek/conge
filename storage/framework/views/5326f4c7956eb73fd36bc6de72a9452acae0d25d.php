<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>Conge.mg</title>
</head>
<style>
    .pass{
        margin-top: 250px;
        color: gray;
    }
    .pass h2{
        font-size: 30px;
    }
    p{
        font-size: 15px;
    }
    .form-control:focus{
       border: #7367f0 1px solid;
       box-shadow: 0 5px 30px rgba(0, 0, 0, .1);

    }
    @media  screen and (max-width: 990px){
        .img{
            /* width: 500px; */
            display: none;

        }

        .pass{
            position: relative;
            padding: 100px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
            margin-top: 50px;
            margin-left: 15%;
            /* background: #000; */
            /* position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%); */
        }
        body{
            margin: 0;
            padding: 0;
        }
        .soratra{

            margin-top: -100px;
        }
    }
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 mt-5">
                <div class="row">
                    <div class="col-lg-8 mt-0">

                    </div>
                </div>
                <div class="img" style="margin-top: 5%;margin-left:10%">
                    <img class="img-fluid forgot"  src="<?php echo e(asset('images/forgot-password-v2.9faba3c1.svg')); ?>" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-4 form" style="padding-right: 120px;">
                <form method="POST" action="<?php echo e(route('password.email')); ?>">
                <?php echo csrf_field(); ?>
                    <div class="pass">
                        <h2>Mot de passe oubliés? <span style="font-size:25px">🔒</span> </h2>
                        <p>Entrez votre email et nous vous enverrons des instructions pour réinitialiser votre mot de passe</p>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Adresse e-Mail')); ?></label>
                            <input type="text" class="form-control index <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="off" autofocus>
                            <?php $__errorArgs = ['email'];
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
                        <button type="submit" role="button" class="btn btn-block mt-4" style="background-color: #7367f0;color: white;width: 100%;">Envoyer le lien de réinitialisation</button>

                    </div>
                    <div class="mt-3 soratra" style="text-align: center;"><a href="/sign-in"  style="text-decoration: none;color:#7367f0;font-size: 15px;"> Retour à la connexion</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>