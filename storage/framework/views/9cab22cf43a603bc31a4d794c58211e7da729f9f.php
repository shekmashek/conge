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

<div class="comtainer mt-5">
    <table id="liste_conge" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Employe</th>
                <th>Type</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée(j)</th>
                <th>Motif</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>

</div>

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
        var table = $('#liste_conge').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },

            ajax: {
                url: "<?php echo e(route('listeConge')); ?>",
                type: 'GET',
                data: function (d) {

                }
            },
            columns: [
                {
                    data: 'employe.nom_emp'||'employe.prenom_emp',
                    name: 'employe.nom_emp'||'employe.prenom_emp',
                    render: function (data, type, row) {
                        return row.employe.nom_emp + ' ' + row.employe.prenom_emp;
                    }


                },
                {data: 'type_conge.type_conge'},
                {data: 'debut'},
                {data: 'fin'},
                {data: 'j_utilise'},
                {data: 'motif'},
                {
                    data: 'etat_conge.etat_conge',
                    render: function (data, type, row) {
                        if (row.etat_conge.id == 1) {
                            return '<div class="input-group border-0 d-flex justify-content-around">'+
                                '<span class="input-group-text border-0 bg-transparent"><i class="bx bx-check-circle fs-5" style="color:#85ea87" ></i></span>'+
                                '<label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label>'+
                                '</div>'
                        } else if (row.etat_conge.id == 2) {
                            return '<div class="input-group d-flex justify-content-around"><span class="input-group-text border-0 bg-transparent"><i class="bx bx-x-circle fs-5 " style="color:var(--bs-red)"></i></span><label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label></div>';
                        } else if (row.etat_conge.id == 3) {
                            return '<div class="input-group d-flex justify-content-around"><span class="input-group-text border-0 bg-transparent"><i class="bx bx-loader bx-spin fs-5" style="color:#ffa417"></i></span><label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label></div>'
                        }
                    }
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
                    "searchable": true
                },
                {
                    "targets": [ 4 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 5 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 6 ],
                    "visible": true,
                    "searchable": true
                }
            ]

        });

        new $.fn.dataTable.FixedHeader( table );


    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/manager/liste_conge.blade.php ENDPATH**/ ?>