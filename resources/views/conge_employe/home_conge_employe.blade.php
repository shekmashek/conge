@extends('layouts.app')

@push('extra-links')

<link rel="stylesheet" href="{{ asset('css/conge_employe/accueil.css') }}">
<script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css" />

@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5" style=" height: 400px;">
            <div class="row" style="margin: 20px;" >
                <div class="col-md-11">
                    <h2 style="text-decoration: underline">Compteurs</h2>
                    {{-- <h3>{{ Auth::user()->id  }}</h3> --}}
                    <table class="table" style="margin-left: 20px;">
                        <thead class="table table-primary">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Solde actuel</th>
                            <th scope="col">Acquis</th>
                        </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <th scope="row">Congé payé</th>
                                <td><a href="#">30</a></td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th scope="row">Congé exceptionnel</th>
                                <td><a href="#">10</a></td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th scope="row">Congé maladie</th>
                                <td><a href="#">30</a></td>
                                <td>0</td>
                            </tr>
                            @for ($i = 0; $i < 4; $i++)
                                <tr>
                                    <th scope="row">...</th>
                                    <td><a href="#">...</a></td>
                                    <td>...</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <div class="card" style="border-radius:5px;border: none;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                        <div class="card-body">
                            <h2 class="card-title" style="text-align:left;text-decoration: underline">Suivi personnel</h2>
                            <hr>
                            {{-- <p style="color: cornflowerblue !important;"><i class="bx bx-history"></i> <a href="#historique2" style="text-decoration: none; color: cornflowerblue;">Historique de mes demandes</a> </p> --}}
                            <p style="color: cornflowerblue !important;" class="d-flex align-items-center">
                                <i class="bx bx-history fs-2"></i>
                                <button id="historique2_button" type="button" class="btn btn-primary bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#historique2">
                                    Historique de mes demandes
                                </button>
                            </p>
                            <p style="color: cornflowerblue !important;" class="d-flex align-items-center"><i class="bx bx-list-ul fs-2"></i> <a href="#derniere_action" style="text-decoration: none; color: cornflowerblue;">Dernières actions</a> </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-4" style="border: 1px solid transparent"></div>
                <div class="col-md-4" style="border: 1px solid transparent"></div>
                <div class="col-md-4" style="border: 1px solid transparent">
                    <button style="border-radius: 20px; margin-top:-5px;" class="btn btn-outline-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" submit="Ajouter une absence" data-bs-target="#staticBackdrop"><i class='bx bx-plus'></i>Demander un congé</button>
                </div>
            </div>
            <div class="row" style="padding: 20px;">
                <h1 style="text-decoration:underline">Calendrier annuel des congés</h1>
                {{-- <div data-provide="calendar"></div> --}}
                <div id="calendar" style="padding: 10px; border: 1px solid lightgray">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Conge-->
<div class="modal modal-conge" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Début mainForm -->
            <form method="post" action="{{ route('insert_absence_employe') }}" id="mainForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Demande de congé</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Selectionnez le type d'absence et ajoutez une description de votre demande</p>
                    <input type="hidden" name="event-index">
                    <div class="form-group row">
                        <label for="event-name"><i class='bx bx-list-check' ></i>Type d'absence</label>
                        <div class="col-sm-12">
                            <select class="form-select" aria-label="Default select example"
                                name="type_motif_conge_id" id="type_motif_conge_id">
                                @foreach ($type_conges as $type_conge)
                                    <option value="{{ $type_conge['id'] }}">{{ $type_conge['type_conge'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="event-name"><i class='bx bxs-message-edit' ></i>Motif</label>
                        <div class="col-sm-12">
                            <textarea type="text" name="description" class="form-control" id="description"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="event-location" class="col-sm-4 control-label"><i class='bx bxs-calendar-edit'></i>Date de début</label>
                        <div class="col-sm-8" id="datyapresselectiontype1">
                            <input name="debut" type="date" class="form-control" id="dateDebut">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input testee" type="radio" name="tpsdebut" id="debut1" value="08:00" {{ old('tpsdebut') == '08:00' ? 'checked' : '' }}>
                                <label class="form-check-label" for="debut1">Matin</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tpsdebut" id="debut2" value="13:00" {{ old('tpsdebut') == '13:00' ? 'checked' : '' }}>
                                <label class="form-check-label" for="debut2">Après-midi</label>
                            </div>
                        </div>
                        <div class="col-sm-8" id="dateavectime">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="event-location" class="col-sm-4 control-label"><i class='bx bxs-calendar-edit'></i>Date de fin</label>
                        <div class="col-sm-8" id="datyapresselectiontype2">
                            <input name="fin" type="date" class="form-control" id="dateFin">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tpsfin" id="fin1" value="12:00" {{ old('tpsfin') == '12:00' ? 'checked' : '' }}>
                                <label class="form-check-label" for="fin1">Matin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tpsfin" id="fin2" value="17:00" {{ old('tpsfin') == '17:00' ? 'checked' : '' }}>
                                <label class="form-check-label" for="fin2">Après-midi</label>
                            </div>
                        </div>
                        <div class="col-sm-8" id="dateavectime">
                        </div>
                    </div>
                    <div id="date_conge_error" class="alert d-none text-danger m-0 mt-1 p-0" role="alert"></div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary" id="ajaxSubmit">Demander</button>
                </div>
            </form>
            <!-- Fin mainForm -->
        </div>
    </div>
</div>

<!-- Modal mon historique de congé -->
{{-- <div id="historique2" class="modalDialoggg">
    <div>
        <a href="#close" title="Close" class="close"><i class="bx bx-x"></i></a>
        <h4>Historique des demandes de <span style="text-decoration: underline">{{ $historiquesCongeEmp[0]->nom_emp.' '.$historiquesCongeEmp[0]->prenom_emp }}</span></h4>
        <hr>
            <table id="myTable" class="table caption-top">
                <thead class="table table-primary">
                </thead>
                <tbody class="table table-light">
                </tbody>
            </table>
    </div>
</div> --}}


<div class="modal fade " id="historique2" tabindex="-1" aria-labelledby="historique2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
      <div class="modal-content" style="min-height: 500px">
        <div class="modal-header">
            <h4>Historique des demandes de <span style="text-decoration: underline">{{ $historiquesCongeEmp[0]->nom_emp.' '.$historiquesCongeEmp[0]->prenom_emp }}</span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table id="myTable" class="table caption-top">
                <thead class="table table-primary">
                </thead>
                <tbody class="table table-light">
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

<!-- Modal Dernières actions-->
<div id="derniere_action" class="modalDialoggg">
    <div>
        <a href="#close" title="Close" class="close "><i class="bx bx-x position-fixed fs-2"></i></a>
        <h4>Dernières actions</h4>
        <hr>
        <ul class="list-group list-group-flush" >
            <li class="list-group-item" style="color:black">
                <b>16/08/2022 14:27</b>
                <br>
                ... a validé votre demande du <b>05/09/2022</b> au <b>09/09/2022</b>
            </li>
            <li class="list-group-item" style="color:black">
                <b>16/08/2022 14:27</b>
                <br>
                Vous avez posé une demande du <b>05/09/2022</b> au <b>09/09/2022</b>
            </li>
            <li class="list-group-item" style="color:black">
                <b>16/08/2022 14:27</b>
                <br>
                La journée du <b>05/09/2022</b> a été corrigée
            </li>
            <li class="list-group-item" style="color:black">
                <b>16/08/2022 14:27</b>
                <br>
                La journée du <b>06/09/2022</b> a été corrigée
            </li>
            <li class="list-group-item" style="color:black">
                <b>16/08/2022 14:27</b>
                <br>
                La journée du <b>07/09/2022</b> a été corrigée
            </li>
        </ul>
    </div>
</div>

@endsection

@push('extra-js')

<script>

    // Modal historique congé.
        var historique2 = document.getElementById('historique2')
        var historique2_button = document.getElementById('historique2_button')

        historique2.addEventListener('shown.bs.modal', function () {
            historique2_button.focus()
        })

    var result = "";
    let calendar = null;
    function dateDiff(date1, date2)
    {
        var diff = {};                           // Initialisation du retour
        var tmp = date2 - date1;

        tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
        diff.sec = tmp % 60;                    // Extraction du nombre de secondes

        tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
        diff.min = tmp % 60;                    // Extraction du nombre de minutes

        tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
        diff.hour = tmp % 24;                   // Extraction du nombre d'heures

        tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
        diff.day = tmp;

        return diff;
    }
    $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/getListCongesEmpJson",
                dataType: 'json',
                async: false,
                success: function (data) {
                    console.log("Tafiditra ato");
                    console.log(data);
                    $('#myTable tr').empty();
                    var header = '';
                    header += '<tr>';
                    header += '<th scope="col">Du</th>';
                    header += '<th scope="col">Au</th>';
                    header += '<th scope="col">Durée</th>';
                    header += '<th scope="col">Fait le</th>';
                    header += '<th scope="col">Statut</th>';
                    header += '</tr>';
                    $('#myTable thead').append(header);
                    var historiqueCongeEmp = '';
                    $.each(data, function (key, value) {
                        historiqueCongeEmp += '<tr>';
                        historiqueCongeEmp += '<td>' + value.debut + '</td>';
                        historiqueCongeEmp += '<td>' + value.fin + '</td>';
                        historiqueCongeEmp += '<td>' + value.duree_conge/1440 + ' jours</td>';
                        historiqueCongeEmp += '<td>' + value.created_at + '</td>';
                        historiqueCongeEmp += '<td>Approuvée par ...</td>';
                        historiqueCongeEmp += '</tr>';
                    });
                    $('#myTable tbody').append(historiqueCongeEmp);
                }
            });
    $(document).ready(function () {
        $('input[type="date"]').change(function(){
            var currentDate = new Date();
            var inputDateDebut = new Date(document.querySelector('#dateDebut').value);
            var inputDateFin = new Date(document.querySelector('#dateFin').value);
            diffDebut = dateDiff(currentDate, inputDateDebut);
            diffFinCurrentDate = dateDiff(currentDate, inputDateFin);
            diffFinDateDebut = dateDiff(inputDateDebut, inputDateFin);
            // alert(diff.day);
            if (diffDebut.day>=0 && diffFinCurrentDate.day >=0 && diffFinDateDebut.day >=0) {
                console.log('Ary enao mafy a');
                $('#date_conge_error').addClass('d-none');

            }
            if (diffFinCurrentDate.day < 0 || diffFinDateDebut.day < 0) {
                console.log('tena tsy mety a');
                $('#date_conge_error').html('Veuillez vérifier votre date!');
                // document.getElementById("date_conge_error").style.color = "red";
                $('#date_conge_error').removeClass('d-none');
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#mainForm').on('submit', function (e) {
            e.preventDefault();
            var type_motif_conge_id = $('#type_motif_conge_id').val();
            var date_debut = $('#dateDebut').val();
            var tmpdebut = $("input[name='tpsdebut']:checked").val();
            var debut = date_debut + ' ' +tmpdebut;
            var date_fin = $('#dateFin').val();
            var tmpfin = $("input[name='tpsfin']:checked").val();
            var fin = date_fin + ' ' +tmpfin;
            var motif = $('#description').val();

            console.log(tmpdebut);
            // console.log("Type de conge= "+type_motif_conge_id);
            // console.log("date debut= "+debut);
            // console.log("date fin= "+fin);
            // console.log("motif= "+motif);
            $.ajax({
                url: '{{ route('insert_absence_employe') }}',
                method: 'POST',
                data: {
                    //user_id: $('#user_id').val(),
                    type_conge_id: type_motif_conge_id,
                    date_debut: debut,
                    date_fin: fin,
                    debut:date_debut,
                    fin:date_fin,
                    motif: motif,
                },
                success: function(response) {
                    // alert(response);
                    result = response.data;
                    reste_conge=response.reste_conge;
                    result.forEach(element => {
                        if (element.debut != null && element.fin != null) {
                            element.startDate = new Date(element.debut);
                            element.endDate = new Date(element.fin);
                            element.name = element.motif;
                        }
                    });
                    console.log(result);
                    //ajax via calendar apres insertion absence
                    calendar = new Calendar('#calendar', {
                        dataSource: result
                    });
                    $('.reste_conge').html(reste_conge);
                }
            });
        });

        var liste_conges = <?php echo $conges; ?>;
        liste_conges.forEach(element => {
            if (element.debut != null && element.fin != null) {
                element.startDate = new Date(element.debut);
                element.endDate = new Date(element.fin);
                element.name = element.motif;
            }
        });
        function editEvent(event) {
            $('#event-modal input[name="event-index"]').val(event ? event.id : '');
            $('#event-modal input[name="event-title"]').val(event ? event.title : '');
            $('#event-modal input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
            $('#event-modal input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
            $('#event-modal').modal();
        }
        function deleteEvent(event) {
            var dataSource = calendar.getDataSource();
            calendar.setDataSource(dataSource.filter(item => item.id !== event.id));
        }
        function saveEvent() {
            var event = {
                id: $('#event-modal input[name="event-index"]').val(),
                title: $('#event-modal input[name="event-title"]').val(),
                startDate: $('#event-modal input[name="event-start-date"]').datepicker('getDate'),
                endDate: $('#event-modal input[name="event-end-date"]').datepicker('getDate')
            }
            var dataSource = calendar.getDataSource();
            if (event.id) {
                for (var i in dataSource) {
                    if (dataSource[i].id == event.id) {
                        dataSource[i].name = event.title;
                        dataSource[i].startDate = event.startDate;
                        dataSource[i].endDate = event.endDate;
                    }
                }
            } else {
                var newId = 0;
                for (var i in dataSource) {
                    if (dataSource[i].id > newId) {
                        newId = dataSource[i].id;
                    }
                }
                newId++;
                event.id = newId;
                dataSource.push(event);
            }
            calendar.setDataSource(dataSource);
            $('#event-modal').modal('hide');
        }
        $(function(){
            var currentYear = new Date().getFullYear();
            var options_french_date = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
            calendar = new Calendar('#calendar', {
                language: 'fr',
                enableContextMenu: true,
                enableRangeSelection: true,
                contextMenuItems: [{
                        text: 'Update',
                        click: editEvent
                    },
                    {
                        text: 'Delete',
                        click: deleteEvent
                    }
                ],
                selectRange: function(e) {
                    editEvent({
                        startDate: e.startDate,
                        endDate: e.endDate
                    });

                },
                mouseOnDay: function(e){
                    // console.log("Date: "+e.date.toLocaleDateString("fr-Fr", options_french_date) + " (" + e.events.length + " events)");
                    let etat = "";
                    if (e.events.length > 0) {
                        var content = '';
                        for (var i in e.events) {
                            if (e.events[i].etat_conge_id == 2) {
                                etat ='Non accordé <i class="bx bx-x-circle" style="color: red; font-weight: bold;"></i>';
                            } else if (e.events[i].etat_conge_id == 1) {
                                etat = 'Accordé <i class="bx bx-check-circle" style="color:green; font-weight: bold;"></i>';
                            } else {
                                etat = 'En attente <i class="bx bx-loader-circle bx-spin bx-rotate-90" style="color:#BDB76B; font-weight: bold;"></i>';
                            }
                            content += '<br><div class="event-tooltip-content">' +
                                '<b>Date: </b> Du <strong>'+e.events[i].startDate.toLocaleDateString("fr-Fr", options_french_date)+ '</strong> au <strong>' + e.events[i].endDate.toLocaleDateString("fr-Fr", options_french_date)+
                                '</strong><div class="event-name" style="color:' + e.events[i].couleur +
                                '"><b>Motif:</b>' + e.events[i].motif + '</div>' +
                                // '<div class="event-location"><b>Durée de l&#39;absence: </b>' + e.events[i].duree_conge+'minutes'+ '</div>' +
                                '<div class="event-location"><b>Etat: </b>' + etat + '</div>' +
                                '</div>';
                        }
                        // content +='<div class="event-tooltip-content">'+
                        //     '<b>Date: </b>'+e.date.toLocaleDateString("fr-Fr", options_french_date)+
                        //     '</div>';
                        $(e.element).popover({
                            trigger: 'manual',
                            // container: 'body',
                            html: true,
                            content: content
                        });
                        $(e.element).popover('show');
                    }
                },
                mouseOutDay: function(e) {
                    if (e.events.length > 0) {
                        $(e.element).popover('hide');
                    }
                },
                dayContextMenu: function(e) {
                    console.log(e);
                    $(e.element).popover('hide');

                },
                dataSource: liste_conges
            });
            $('#save-event').click(function() {
                saveEvent();
            });
        });
    });
</script>

@endpush
