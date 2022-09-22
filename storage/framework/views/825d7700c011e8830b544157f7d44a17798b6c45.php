

<?php $__env->startSection('content'); ?>
<div class="container">

    
<?php $__empty_1 = true; $__currentLoopData = $heureTravail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hT): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="d-flex">


            <form action="<?php echo e(route('updateTime')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3><?php echo e($hT->designation); ?></h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="id" value="<?php echo e($hT->id); ?>">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_debut" name="heure_debut" value="<?php echo e($hT->heure_debut); ?>" required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_fin" name="heure_fin" value="<?php echo e($hT->heure_fin); ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" id="btn_def_jour" class="btn btn-primary " name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <form action="<?php echo e(route('updateTime')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de pause </h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <input type="hidden" value="<?php echo e($hT->id); ?>" name="id">
                                <label for="debut_pause" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut_pause" name="debut_pause" value="<?php echo e($hT->debut_pause); ?>" required>
                                </div>
                                <label for="fin_pause" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin_pause" name="fin_pause" value="<?php echo e($hT->fin_pause); ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" id="btn_def_jour_pause" class="btn btn-primary" name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

</div>

<br>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
aucune heure définie
<?php endif; ?>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/referent/work_times.blade.php ENDPATH**/ ?>