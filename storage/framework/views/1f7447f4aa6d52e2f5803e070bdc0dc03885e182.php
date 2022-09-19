<?php $__env->startPush('extra-links'); ?>

        
        <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-scripts'); ?>

        
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">
        </li>
    <li class="nav-item mx-2 position-relative" role="presentation">
      <a    class="nav-link "
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#tab_liste_attente"
            role="tab"
            aria-controls="tab_liste_attente"
            aria-selected="false">

    Demandes en attentes

    <?php if($nbr_en_attente > 0): ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo e($nbr_en_attente); ?>

            <span class="visually-hidden"><?php echo e(__('en attente')); ?></span>
        </span>
    <?php endif; ?>


    </a>
    </li>
    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link active"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            Historique
        </a>

        <li class="nav-item mx-2 position-absolute end-0" role="presentation">
            <a href="<?php echo e(route('rh.calendrier')); ?> " class="d-flex nav-link align-items-center">
                <i class='bx bxs-calendar-check fs-2' ></i>
                <span>
                    Calendrier
                </span>
            </a>
        </li>
  </ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
    <div
      class="tab-pane fade show active"
      id="ex1-tabs-1"
      role="tabpanel"
      aria-labelledby="ex1-tab-1">

        <?php echo $__env->make('rh.liste_conge', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <div class="tab-pane fade " id="tab_liste_attente" role="tabpanel" aria-labelledby="tab_liste_attente">

        <?php echo $__env->make('rh.liste_en_attente', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

  </div>
  <!-- Tabs content -->




</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/rh/recherche_conges.blade.php ENDPATH**/ ?>