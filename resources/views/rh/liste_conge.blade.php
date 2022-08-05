@push('extra-links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">


@endpush

<div class="container mt-5">

    {{-- --------------------------------------date to date search -------------------------------------------------- --}}

     <form action="{{route('conge.filtre')}}" method="GET">

                @csrf
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
                                    <button type="submit" class="btn " name="search" title="Search"><box-icon name='search-alt'></box-icon></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </form>

    {{-- --------------------------------------data table historique-------------------------------------------------- --}}

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
                <th>Employe</th>
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
</div>

{{-- ------------------------------------------------------------------------ --}}

@push('extra-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>


@endpush

@push('extra-js')
<script>
    $(document).ready(function () {
        var table = $('#liste_conge').DataTable({
            serverSide: true,
            sorting:false,
            processing: true,
            ajax:"{{ route('home_RH') }}",
            responsive: true,
            columns: [
                // { data: function (data) {
                //     return  data.employe.nom_emp+' '+data.employe.prenom_emp;
                // } }, // recherche non dispo
                { data: 'employe.nom_emp'},
                { data: 'type_conge.type_conge' },
                { data: 'debut' },
                { data: 'fin' },
                { data: 'j_utilise' },
                { data: 'motif' },
                { data: 'etat_conge.etat_conge' },
            ],

        });

    });




</script>
@endpush
