<!DOCTYPE html>
<html>

<head>
    <title>Gestion de congé - Demande</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/assets/images/favicon.png') }}" rel="icon">
     <link href="{{ asset('/assets/images/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/styleConge.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-datepicker@1.8.0/dist/css/bootstrap-datepicker.standalone.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/LeftMenuButtons.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

</head>
<style>
    body {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    .modalDialoggg {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.6);
        width: 100%;
        height: 100%;
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 200ms ease-in;
        -moz-transition: opacity 200ms ease-in;
        transition: opacity 200ms ease-in;
        pointer-events: none;
    }

    .modalDialoggg:target {
        opacity:1;
        pointer-events: auto;
    }

    .modalDialoggg > div {
        width: 60% !important;
        position: relative;
        margin: 10% auto;
        border-radius: 10px !important;
        /* border: 1px solid rgba(0, 0, 0, .2); */
        background: #fff;
        padding: 20px;
        padding-bottom: 100px;
        outline: 0;
        /* padding: 5px 20px 13px 20px; */
        /* background: -moz-linear-gradient(#fff, #999); */
        /* background: -webkit-linear-gradient(#fff, #999); */
        /* background: -o-linear-gradient(#fff, #999); */
    }

    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .close:hover {
        background: #00d9ff;
    }
</style>
<body>
    {{-- <script>
        function changeSatus() {
            if (type_motif_conge_id.value == 8) {
                $("#datyapresselectiontype1").replaceWith('<div class="col-sm-8" id="dateavectime1"><input type="datetime-local" name="debut"/></div>');
                $("#datyapresselectiontype2").replaceWith('<div class="col-sm-8" id="dateavectime2"><input type="datetime-local" name="fin"/></div>');
            }
            else{

            }
        }
    </script> --}}
    <div class="container-fluid">
        <div class="row justify-content-center" style="height:100%; display: flex; ">
            <div class="col-md-1">
                <div id="leftSideMenu" class="leftSideMenuNav" style="background-color: white">
                    <a href="javascript:void(0)" class="closeButton" onclick="closeLeftMenu()"><h1><i class="bx bx-x"></i></h1></a>
                    <br>
                    <br>
                    <button type="button" class="btn btn-default disabled">UPSKILL CONGE</button>
                    <button type="button" class="list-group-item list-group-item-action">Conge employé</button>
                    <button type="button" class="list-group-item list-group-item-action">Historique</button>
                    <button type="button" class="list-group-item list-group-item-action"><a href="{{ route('logout') }}">Déconnexion</a></button>
                </div>
                <span style="cursor: pointer" onclick="openLeftMenu()"><h1 style="font-weight: bold">☰</h1></span>
            </div>
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row" style="margin: 20px; border-left:1px solid grey" >
                            <h2 style="text-decoration: underline">Compteurs</h2>
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
                        <hr>
                        <div class="row" style="margin: 20px;border-left: 1px solid grey">
                            <div class="col-md-12">
                                <div class="card" style="border-radius:10px;
                                    border: none;
                                    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                    <div class="card-body">
                                        <h2 class="card-title" style="text-align:left;text-decoration: underline">Suivi personnel</h2>
                                        <hr>
                                        <p style="color: cornflowerblue !important;"><i class="bx bx-history"></i> <a href="#historique2" style="text-decoration: none; color: cornflowerblue;">Historique des demandes</a> </p>
                                        <p style="color: cornflowerblue !important;"><i class="bx bx-list-ul"></i> <a href="#derniere_action" style="text-decoration: none; color: cornflowerblue;">Dernières actions</a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                    <div class="col-md-7" style="background: transparent;padding-left:1%; border-left: 1px solid grey">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-4" style="border: 1px solid transparent"></div>
                            <div class="col-md-4" style="border: 1px solid transparent"></div>
                            <div class="col-md-4" style="border: 1px solid transparent">
                                <button style="border-radius: 20px; margin-top:-5px;" class="btn btn-outline-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" submit="Ajouter une absence" data-bs-target="#staticBackdrop"><i class='bx bx-plus'></i>Demander un congé</button>
                            </div>
                        </div>
                        <div class="row" style="padding: 20px;">
                            <h1 style="text-decoration:underline">Calendrier annuel des congés</h1>
                            <div id="calendar" style="padding: 20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Historique-->
    <div id="historique2" class="modalDialoggg" style="overflow-y:scroll;">
        <div>
            <a href="#close" title="Close" class="close"><i class="bx bx-x"></i></a>
            <h4>Historique des demandes de <span style="text-decoration: underline">{{ $historiques[0]->nom_emp.' '.$historiques[0]->prenom_emp }}</span></h4>
            <hr>
                <table id="myTable" class="table caption-top">
                    <thead class="table table-primary">
                    <tr>
                        <th scope="col">Du</th>
                        <th scope="col">Au</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Fait le</th>
                        <th scope="col">Statut</th>
                    </tr>
                    </thead>
                    <tbody class="table table-secondary">
                        @foreach ($historiques as $historique)
                        <tr>
                            <td>{{ $historique->debut }} <br> <small>Matin</small></td>
                            <td>{{ $historique->fin }} <br> <small>Après midi</small></td>
                            <td>{{ number_format($historique->duree_conge/1440,2,'.',',') }} jours</td>
                            <td>{{ $historique->created_at }}</td>
                            <td>Approuvée par ...</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <!-- Modal Dernières actions-->
    <div id="derniere_action" class="modalDialoggg">
        <div style="background-color: #CFE2FF;color:black">
            <a href="#close" title="Close" class="close"><i class="bx bx-x"></i></a>
            <h4>Dernières actions</h4>
            <hr>
            <ul class="list-group list-group-flush" >
                <li class="list-group-item" style="background-color: #CFE2FF;color:black">
                    <b>16/08/2022 14:27</b>
                    <br>
                    ... a validé votre demande du <b>05/09/2022</b> au <b>09/09/2022</b>
                </li>
                <li class="list-group-item" style="background-color: #CFE2FF;color:black">
                    <b>16/08/2022 14:27</b>
                    <br>
                    Vous avez posé une demande du <b>05/09/2022</b> au <b>09/09/2022</b>
                </li>
                <li class="list-group-item" style="background-color: #CFE2FF;color:black">
                    <b>16/08/2022 14:27</b>
                    <br>
                    La journée du <b>05/09/2022</b> a été corrigée
                </li>
                <li class="list-group-item" style="background-color: #CFE2FF;color:black">
                    <b>16/08/2022 14:27</b>
                    <br>
                    La journée du <b>06/09/2022</b> a été corrigée
                </li>
                <li class="list-group-item" style="background-color: #CFE2FF;color:black">
                    <b>16/08/2022 14:27</b>
                    <br>
                    La journée du <b>07/09/2022</b> a été corrigée
                </li>
            </ul>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function () {
            var cur_value = $('#type_motif_conge_id').find(":selected").text();
            console.log(cur_value);
        });
    </script> --}}
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
                            <label for="event-name"><i class='bx bxs-message-edit' ></i>Description</label>
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary" id="ajaxSubmit">Demander</button>
                    </div>
                </form>
                <!-- Fin mainForm -->
            </div>
        </div>
    </div>
<!--------end Modal conge----------------->
    <script>
        /*----------------------------------------------ajax insertion absence---------------------------------------*/
        var test_e = "";
        let calendar = null;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* Début formulaire ajout d'absence à remplir */
            $('#mainForm').on('submit', function(e) {
                e.preventDefault();
                /* Liste des input à remplir */
                var type_motif_conge_id = $('#type_motif_conge_id').val();
                var date_debut = $('#dateDebut').val();
                var tmpdebut = $("input[name='tpsdebut']:checked").val();
                var debut = date_debut + ' ' +tmpdebut;
                var date_fin = $('#dateFin').val();
                var tmpfin = $("input[name='tpsfin']:checked").val();
                var fin = date_fin + ' ' +tmpfin;
                var motif = $('#description').val();

                console.log("Type de conge= "+type_motif_conge_id);
                console.log("date debut= "+debut);
                // console.log("tmpdebut= "+tmpdebut);
                console.log("date fin= "+fin);
                // console.log("tmpfin= "+tmpfin);
                console.log("motif= "+motif);
                $.ajax({
                    url: '{{ route('insert_absence_employe') }}',
                    method: 'POST',
                    data: {
                        //user_id: $('#user_id').val(),
                        type_conge_id: type_motif_conge_id,
                        debut: debut,
                        fin: fin,
                        motif: motif,


                    },
                    success: function(response) {
                        test_e = response.data;
                        reste_conge=response.reste_conge;
                        test_e.forEach(element => {
                            if (element.debut != null && element.fin != null) {
                                element.startDate = new Date(element.debut);
                                element.endDate = new Date(element.fin);
                                element.name = element.motif;

                            }
                        });
                        console.log(test_e);
                        //ajax via calendar apres insertion absence
                        calendar = new Calendar('#calendar', {
                            dataSource: test_e
                        });
                        $('.reste_conge').html(reste_conge);
                    }
                });
            });
            /* Fin formulaire ajout d'absence à remplir */
        });

            /*--------------------------------------------end ajax insertion ajax ---------------------------------------*/

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


        $(function() {
            var currentYear = new Date().getFullYear();

            calendar = new Calendar('#calendar', {

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
                /*-------------pop up apres positionnement du calendrier sur la date  d'absence*-------------*/
                //apostrophe &#39; ou  &apos;
                mouseOnDay: function(e) {
                    let etat = "";
                    if (e.events.length > 0) {
                        var content = '';
                        //console.log(e.events);
                        for (var i in e.events) {
                            if (e.events[i].etat_conge_id == 2) {
                                etat ='Non accordé <i class="bx bx-x-circle" style="color: red; font-weight: bold;"></i>';
                            } else if (e.events[i].etat_conge_id == 1) {
                                etat = 'Accordé <i class="bx bx-check-circle" style="color:green; font-weight: bold;"></i>';
                            } else {
                                etat = 'En attente <i class="bx bx-loader-circle bx-spin bx-rotate-90" style="color:#BDB76B; font-weight: bold;"></i>';
                            }

                            content += '<br><div class="event-tooltip-content">' +
                                '<div class="event-name" style="color:' + e.events[i].color +
                                '"><b>Motif:</b> ' + e.events[i].motif + '</div>' +
                                '<div class="event-location"><b>Durée de l&#39;absence: </b>' + e.events[i].duree_conge+'minutes'+ '</div>' +
                                '<div class="event-location"><b>Validation: </b>' + etat + '</div>' +
                                '</div>';
                        }

                        $(e.element).popover({
                            trigger: 'manual',
                            container: 'body',
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
                /*------------- end pop up apres positionnement du calendrier sur la date  d'absence*-------------*/
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

        function openLeftMenu() {
            document.getElementById("leftSideMenu").style.width = "200px";
        }
        function closeLeftMenu() {
            document.getElementById("leftSideMenu").style.width = "0";
            console.log('okQuitter');
        }

    </script>
</body>
</html>

