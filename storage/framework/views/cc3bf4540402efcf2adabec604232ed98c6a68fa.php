

<?php $__env->startPush('extra-links'); ?>

        
        <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-scripts'); ?>

        
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', 'Accueil referent'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">


    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link active"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            heure de travail
        </a>
    </li>
</ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">

    <div class="tab-pane fade show active" id="tab_liste_attente" role="tabpanel" aria-labelledby="tab_liste_attente">

        reférent connécté

        
        
    </div>

  </div>
  <!-- Tabs content -->




</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/referent/home.blade.php ENDPATH**/ ?>