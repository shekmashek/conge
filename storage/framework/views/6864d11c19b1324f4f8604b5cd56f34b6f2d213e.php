

<?php $__env->startPush('extra-links'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

<style>
    .show_hover:hover {
        opacity: 1!important;
    }
</style>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">
        </li>
    <li class="nav-item mx-2 position-relative" role="presentation">
      <a    class="nav-link active"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#tab_liste_employes"
            role="tab"
            aria-controls="tab_liste_employes"
            aria-selected="false">

    Listes des employés

    </a>
    </li>
    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link "
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            Ajouter employés
        </a>
    </li>

  </ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active"
         id="tab_liste_employes" role="tabpanel"
         aria-labelledby="tab_liste_employes">
            <?php echo $__env->make('rh.liste_employes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- include liste en attente -->
        </div>

        <div
        class="tab-pane fade"
        id="ex1-tabs-1"
        role="tabpanel"
        aria-labelledby="ex1-tab-1">
            <?php echo $__env->make('rh.ajouter_employes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- include liste employés -->
        </div>
  </div>
  <!-- Tabs content -->




</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/rh/menu_employes.blade.php ENDPATH**/ ?>