@push('extra-links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">


@endpush

<div class="container mt-5">

    {{-- --------------------------------------date to date search -------------------------------------------------- --}}

                <br>
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
                                    <button id="refresh" class="btn" name="refresh" title="refresh"><box-icon name='refresh'></box-icon></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    {{-- --------------------------------------data table historique php-------------------------------------------------- --}}

    {{-- <table id="liste_conge" class="table table-striped" style="width:100%">
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

            @forelse ($conges as $conge)
            <tr>
                <td>{{ $conge->employe->nom_emp.' '.$conge->employe->prenom_emp }}</td>
                <td>{{ $conge->type_conge->type_conge }}</td>
                <td>{{ date('d M Y - H:i', strtotime($conge->debut)) }}</td>
                <td>{{ date('d M Y - H:i',strtotime($conge->fin)) }}</td>
                <td>{{ $conge->j_utilise }}</td>
                <td>{{ $conge->motif }}</td>
                <td> --}}

                    {{-- Il est nécessaire d'écrire explicitement la relation entre
                    conge->etat_conge pour faire comprendre au js que cette relation exite
                    sur l'objet

                    --}}
{{--
                    @if ($conge->etat_conge->id == 3)
                    <div class="form-check form-switch">
                        <span><i class='bx bx-loader bx-spin fs-5' style='color:#ffa417'></i></span>
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                    </div>
                    @elseif ($conge->etat_conge_id == 2)

                    <div class="form-check form-switch">
                        <i class='bx bx-x-circle fs-5' style='color:var(--bs-red)'></i>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Refusé</label>
                    </div>
                    @elseif ($conge->etat_conge_id == 1)
                    <div class="form-check form-switch">
                        <span><i class='bx bx-check-circle fs-5' style='color:#85ea87' ></i></span>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Accordé</label>
                    </div>
                    @endif
                </td>
            </tr>
            @empty
                <span>Aucun congé enregistré</span>
            @endforelse --}}

            {{-- // form date to date --}}

            {{-- <form action="{{ route('rh.liste_conge') }}" method="GET"> --}}

{{--
      </tbody>

    </table> --}}

    {{-- --------------------------------------test data table historique ajax -------------------------------------------------- --}}

    <table id="liste_conge" class="table table-bordered table-striped" style="width:100%" >
        <thead>
            <tr>
                {{-- <th>Nom</th> --}}
                {{-- <th>Prenom</th> --}}
                <th class="align-middle text-center">Employe </th>
                <th class="align-middle text-center">Type</th>
                <th class="align-middle text-center">Début</th>
                <th class="align-middle text-center">Fin</th>
                <th class="align-middle text-center">Durée(jour)</th>
                <th class="align-middle text-center">Motif</th>
                <th class="align-middle text-center">status</th>
            </tr>

        </thead>
        <tbody>

        </tbody>

    </table>
</div>

{{-- ------------------------------------------------------------------------ --}}

@push('extra-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>


<style>
    .bx-check-circle:before {
    padding: 5px;
}
    .bx-loader:before {
    padding: 5px;
}
    .bx-x-circle:before {
    padding: 5px;
}
</style>

@endpush

@push('extra-js')


<script>
    $(document).ready(function () {

        var table = $('#liste_conge').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('history_RH') }}",
                data: function (d) {
                    d.debut = $("input[name='debut']").val();
                    d.fin = $("input[name='fin']").val();
                }
            },
            responsive: true,

            columns: [
                    {
                        data:'employe',
                        // className: 'align-middle text-center'
                    },
                // { data: 'employe.nom_emp'},
                // { data: 'employe.prenom_emp'},
                {
                    data: 'type_conge.type_conge' ,
                    className: 'align-middle text-center'
                },
                {
                    data: 'debut' ,
                    className: 'align-middle text-center'
                },
                {
                    data: 'fin' ,
                    className: 'align-middle text-center'
                },
                {
                    data: 'j_utilise',
                    className: 'align-middle text-center'
                },
                {
                    data: 'motif' ,
                    className: 'align-middle text-center'
                },
                {
                    data: 'etat_conge.etat_conge',
                    render : function(data, type, row){
                        if (row.etat_conge_id == 3) {
                            return '<div class="form-check form-switch ">'+
                                '<span><i class="bx bx-loader bx-spin fs-5" style="color:#ffa417"></i></span>'+
                                '<label class="form-check-label" for="flexSwitchCheckDefault"> En attente</label>'+
                            '</div>';
                        } else if (row.etat_conge_id == 1) {
                            return '<div class="form-check form-switch">'+
                                '<span><i class="bx bx-check-circle fs-5" style="color:#85ea87"></i></span>'+
                                '<label class="form-check-label" for="flexSwitchCheckDefault"> Accordé</label>'+
                            '</div>';
                        } else if (row.etat_conge_id == 2) {
                            return '<div class="form-check form-switch">'+
                                '<i class="bx bx-x-circle fs-5" style="color:var(--bs-red)"></i>'+
                                '<label class="form-check-label" for="flexSwitchCheckDefault"> Refusé</label>'+
                            '</div>';
                        }
                    }

                }


            ],
            columnDefs: [
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

                },
                // {
                //     "targets": [ 7 ],
                //     "visible": true,
                //     "searchable": true,


                // }

            ],





        });


         $('#btnSearch').on('click',function(e){

            e.preventDefault();
            table.draw();


        })


        //---------refresh datatable after search date to date---------------

        $('#refresh').on('click',function(e){
            $("input[name='debut']").val(" ");
            $("input[name='fin']").val(" ");

            e.preventDefault();
            table.draw();
        })

    });




</script>
@endpush
