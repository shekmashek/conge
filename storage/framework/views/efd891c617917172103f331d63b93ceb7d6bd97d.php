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
<div class="container mt-5">
    <table id="liste_employe_manager" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nom Prenom(s)</th>
                <th>Département/Service</th>
                <th>Date d'embauche</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('extra-scripts'); ?>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>


<?php $__env->stopPush(); ?>

<?php $__env->startPush('extra-js'); ?>
<script>



    $(document).ready(function () {


        var table = $('#liste_employe_manager').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },

            ajax: {
                url: "<?php echo e(route('manager.liste_employes')); ?>",
                type: 'GET',
                data: function (d) {

                }
            },
            columns: [
                {
                    data: 'nom_prenom',
                },
                {
                    data: 'service.departement.nom_departement',
                    render: function (data, type, row) {
                        return row.service.departement.nom_departement + ' / ' + row.service.nom_service;
                    }
                },
                {
                    data: 'contrat.date_embauche',
                    // render: function (data, type, row) {
                    //     // tranfrom date to dd/mm/yyyy
                    //     var date = new Date(row.contrat.date_embauche);
                    //     return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                    // }
                },

                {
                    data: 'actions',
                },
            ],
            columnDefs:[
                {
                  "targets": [ 0 ],
                    "visible": true,
                    "searchable": true

                },
                {
                    "targets": [ 1 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 3 ],
                    "visible": true,
                    "searchable": false
                },

            ]

        });

        new $.fn.dataTable.FixedHeader( table );


    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/manager/liste_employe_manager.blade.php ENDPATH**/ ?>