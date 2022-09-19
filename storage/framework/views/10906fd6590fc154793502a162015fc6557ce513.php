

    <div class="p-3 pt-2">
        <div class="card-title">
            <div class="row px-3 mt-2">
                <div class="col-7">
                    <span class="titre_card_profil"><img src="<?php echo e(asset('img/logos_all/iconConge.webp')); ?>" alt="logo_mini"
                        title="logo conges.mg" width="30px" height="30px">Conges.mg</span>
                </div>
                <div class="col-5 text-center">
                    <div class="logout">
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" text-center"><?php echo app('translator')->get('translation.SeDéconnecter'); ?></a>
                        <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row ps-4">
                <div class="col-2 ps-4">
                    <span>
                        <div style="display: grid; place-content: center">
                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                            </div>
                        </div>
                    </span>
                </div>
                <div class="col-10 ps-4">
                    <h6 class="mb-0 "><?php echo e(Auth::user()->name); ?></h6>
                    <h6 class="mb-0 text-muted text_mail"><?php echo e(Auth::user()->email); ?></h6>
                    <p id="nom_etp" class="mt-2"></p>
                </div>
            </div>
            <div class="row role_liste mt-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <input type="text" value="<?php echo e(Auth::user()->id); ?>" id="id_user" hidden>
                            <span class="text-muted p-0 test_font"><?php echo app('translator')->get('translation.ConnéctéEnTantQue'); ?> :</span>
                        </div>
                        <div class="col p-0">
                            <select name="" id="liste_role" class="form-control" style="height: 30px;font-size:12px;width:150px;margin-left:-20px;margin-top:-03px;">

                            </select>
                            
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row mt-5">
                        <div class="d-flex flex-row py-0 justify-content-center">
                            <a href="<?php echo e(url('politique_confidentialite')); ?>" target="_blank">
                                <p class="m-0 test_font2"><?php echo app('translator')->get('translation.PolitiqueDeConfidentialité'); ?></p>
                            </a>
                            &nbsp;-&nbsp;
                            <a href="<?php echo e(route('condition_generale_de_vente')); ?>" target="_blank">
                                <p class="m-0 test_font2"><?php echo app('translator')->get('translation.ConditionsDUtilisation'); ?></p>
                            </a>
                        </div>
                        <div class="d-flex flex-row py-0 justify-content-center">
                            <a href="<?php echo e(url('contacts')); ?>" target="_blank">
                                <p class="m-0 test_font2"><?php echo app('translator')->get('translation.Contactez-nous'); ?></p>
                            </a>
                            &nbsp;-&nbsp;
                            <a href="<?php echo e(url('info_legale')); ?>" target="_blank">
                                <p class="m-0 test_font2"><?php echo app('translator')->get('translation.InformationLégales'); ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/layouts/profile.blade.php ENDPATH**/ ?>