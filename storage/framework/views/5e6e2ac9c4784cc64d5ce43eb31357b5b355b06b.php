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


    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link "
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            Historique
        </a>

  </ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
    <div
      class="tab-pane fade show active"
      id="ex1-tabs-1"
      role="tabpanel"
      aria-labelledby="ex1-tab-1">


        <?php echo $__env->make('rh.historique', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- include historique -->

    </div>



  </div>
  <!-- Tabs content -->




</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/rh/viewHistorique.blade.php ENDPATH**/ ?>