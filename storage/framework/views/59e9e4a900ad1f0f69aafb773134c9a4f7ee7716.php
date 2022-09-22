<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">


    </head>
    <body>


        <div class ="container">
            <div class = "row">
                <div class = "container-fluid">
                    <div class="form-group row">
                        <label for="date_debut" class="col-form-label col-sm-2">Date de début</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="debut" name="debut" placeholder="Date de début" required>
                        </div>
                        <label for="date_fin" class="col-form-label col-sm-2">Date de fin</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm" id="fin" name="fin"  placeholder="Date de fin" required>
                        </div>
                        <div class="col-sm-2">
                            <button id="btnSearch" class="btn" name="search" title="Search"><box-icon name='search-alt'></box-icon></button>
                            <button id="refresh" class="btn" name="refresh" title="refresh">refresh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <table id="liste_conge" class="table table-bordered table-striped" style="width:100%" >
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Type</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Durée(jour)</th>
                    <th>Motif</th>
                    <th>status</th>
                </tr>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
        <?php echo e(csrf_field()); ?>


        <?php $__env->startPush('extra-scripts'); ?>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
            <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
        <?php $__env->stopPush(); ?>
    </body>
</html>



<script>
    $(document).ready(function(){

        var date = new Date();

        $('input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        var _token = $('input[name="_token"]').val();

        fetch_data();

        function fetch_data(debut='' ,fin='', _token)
        {
            $.ajax({
                url:"<?php echo e(route('rh.historique.fetch_data')); ?>",
                method:"POST",
                data:{debut:debut,fin:fin, _token:_token},
                dataType:"json",
                success:function(data)
                {
                    var output = '';
                    output += '<tr>';
                    output += '<td>'+data.nom+'</td>';
                    output += '<td>'+data.prenom+'</td>';
                    output += '<td>'+data.type+'</td>';
                    output += '<td>'+data.debut+'</td>';
                    output += '<td>'+data.fin+'</td>';
                    output += '<td>'+data.duree+'</td>';
                    output += '<td>'+data.motif+'</td>';
                    output += '<td>'+data.status+'</td>';
                    output += '</tr>';
                    $('#liste_conge tbody').html(output);


                }
            })
        }

    });
</script>
<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/rh/historique.blade.php ENDPATH**/ ?>