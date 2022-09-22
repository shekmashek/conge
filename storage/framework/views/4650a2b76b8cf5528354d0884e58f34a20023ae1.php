
<div class="d-flex flex-column flex-shrink-0 bg-transparent mt-5" style="width: 4.5rem;">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center ms-1">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['isManager'])): ?>
            
        <li class="nav-item mb-1">


            <a href="<?php echo e(route('home_manager')); ?>" class="nav-link rounded-3
            <?php if(Route::currentRouteName() == 'home_manager'): ?>
                active
                btn_active
            <?php endif; ?>
            py-3 border-bottom" aria-current="page" title="Gérer les congés" data-bs-toggle="tooltip" data-bs-placement="right">

                <i class='bx bx-calendar-minus fs-3'></i>
            </a>
          </li>


        <li class="nav-item mb-1">


            <a href="<?php echo e(route('manager.liste_employes')); ?>" class="nav-link rounded-3
            <?php if(Route::currentRouteName() == 'manager.liste_employes'): ?>
                active
                btn_active

            <?php endif; ?>
            py-3 border-bottom" aria-current="page" title="Gérer l'équipe" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bx-group fs-3'></i>
            </a>
          </li>


        <?php endif; ?>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isManager')): ?>
        
        
        <li class="nav-item mb-1">


          <a href="<?php echo e(route('stats_conges_manager')); ?>" class="nav-link rounded-3
          <?php if(Route::currentRouteName() == 'stats_conges_manager'): ?>
              active
              btn_active
          <?php endif; ?>
          py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

              <i class='bx bxs-bar-chart-square fs-3'></i>
          </a>
        </li>
      <?php endif; ?>

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isReferent')): ?>




      <li class="nav-item mb-1">

        <a href="<?php echo e(route('home_referent')); ?>" class="nav-link rounded-3 link_perso btn_perso_hover
        <?php if(Route::currentRouteName() == 'home_referent'): ?>
            active
            btn_active

        <?php endif; ?>
        py-3 border-bottom" aria-current="page"  data-bs-toggle="tooltip" data-bs-placement="right">

        <i class='bx bx-calendar-minus fs-3' ></i>
        </a>
      </li>

        <li class="nav-item mb-1">
        <a href="<?php echo e(route('edit_work_times')); ?>" class=" rounded-3 link_perso btn_perso_hover
        <?php if(Route::currentRouteName() == 'edit_work_times'): ?>
            active
            btn_active

            <?php endif; ?>
        nav-link py-3 border-bottom" title="Seetings" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-wrench fs-3'></i>
        </a>
        </li>

            
            
        <li class="nav-item mb-1">
            <a href="#" class="nav-link rounded-3 link_perso btn_perso_hover
            <?php if(Route::currentRouteName() == 'liste_employes'): ?>
                active
                btn_active
            <?php endif; ?>
            py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bxs-bar-chart-square fs-3'></i>
            </a>
        </li>

      <?php endif; ?>


      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isRH')): ?>
      
        <li class="nav-item">
            <a href="<?php echo e(route('home_RH')); ?>" class="nav-link rounded-3 link_perso btn_perso_hover
            <?php if(Route::currentRouteName() == 'home_RH'): ?>
                active
                btn_active
            <?php endif; ?>
            py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class='bx bx-calendar-minus fs-3'></i>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="<?php echo e(route('employes')); ?>" class="nav-link rounded-3 link_perso btn_perso_hover
            <?php if(Route::currentRouteName() == 'employes'): ?>
                active
                btn_active
            <?php endif; ?>
            py-3 border-bottom" aria-current="page" title="Liste employés" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class='bx bxs-user' style="font-size: x-large;"></i>
            </a>
        </li>

        <?php endif; ?>

    </ul>

</div>


<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>