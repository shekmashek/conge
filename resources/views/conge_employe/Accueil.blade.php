<!DOCTYPE html>
<html>

<head>
    <title>Gestion de congé - Demande</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

    <!------------------------>

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
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-datepicker@1.8.0/dist/css/bootstrap-datepicker.standalone.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>


    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1">
                <div class="container-fluid">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center sticky-top">
                        <a href="/" class="d-block p-3 link-dark text-decoration-none">
                            <B style="color: gray;">UPSKILL CONGE</B>
                        </a>
                        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    <i class="bx bxs-home" id="icon_details"></i>
                                </a>
                            </li>
                            <li>
                                <a href="/" class="nav-link py-3 px-2">
                                    <i class="bx bxs-user" id="icon_details"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('historique_conge') }}" class="nav-link py-3 px-2">
                                    <i class="bx bxs-hourglass" id="icon_details"></i>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link py-3 px-2" href="#" data-bs-toggle="dropdown">
                                    <img src="{{ asset('assets/images/profile-img.jpg') }}" width="40" height="40" alt="Profile" class="rounded-circle">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                    <li class="dropdown-header">
                                      <h6>id: 1 | Utilisateur 1</h6>
                                    </li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                      
                                    <li>
                                      <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bx bxs-log-out" id="icon_details"></i>
                                        <span>Déconnexion</span>
                                      </a>
                                    </li>
                      
                                  </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-11">
                <div id="col_right_details">
                    <div class="row" style="margin-top: 20px; margin-bottom: 0px;">
                        <div class="col-lg-8">
                        </div>
                        <div class="col-lg-1">
                            <h5 class="card-title">Utilisateur 1</h5>
                        </div>
                        <div class="col-lg-3">
                            <button style="border-radius: 20px; margin-top:-5px;" class="btn btn-outline-danger" type="button" class="btn btn-primary" data-bs-toggle="modal" submit="Ajouter une absence" data-bs-target="#staticBackdrop"><i class='bx bx-plus'></i> Ajouter une absence</button>
                        </div>
                    </div>
                    <div class="row" style="padding: 10px;">
                        <div class="col-lg-1">
            
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="card" id="details_card">
                                    <div class="card-body">
                                      <h5 class="card-title" style="text-align: center"><i class='bx bxs-calendar bx-flip-horizontal' style='color:#f3552e'></i> Indemnité de congé</h5>
                                      <p class="card-text"  style="text-align: center">{{ $dateEmbauche }}</p>
                                      <hr>
                                      <div class="row"  style="text-align: center">
                                        <div class="col-lg-4">
                                            <label><b><p>19.5</p>ACQUIS</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><b><p>{{ $solde }}</p>SOLDE</b></label>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><b><p>17</p>PRIS</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="card details" style="border: none;">
                                <div class="card-body">
                                    <i class='bx bx-calendar' style='color:#ec2626;font-size:50px' ></i>
                                    <p class="header-paragraphe-details">Demande de congé en attente de vérification</p>
                                    <p class="body-paragraphe-details">Vos absences en attente</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="card" id="details_card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class='bx bxs-calendar-exclamation bx-tada' style='color:#ec2626;font-size:30px' ></i>Congés {{$moisJour}}</h5>
                                    <p class="card-text"><span class="reste_conge">{{$reste_conge}}</span> jours (<?php echo now()->format('Y')?>)</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div id="calendar" style="padding: 20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal Conge-->
        <div class="modal modal-conge" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <!-- Début mainForm -->
                    <form method="post" action="{{ route('insert_absence_employe') }}" id="mainForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"><i class='bx bxs-landmark' style='color:#e74b4b;font-size:30px'  ></i>Demande d'absence</h5>
    
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Selectionnez le type d'absence et ajoutez une description de votre demande</p>
                            <input type="hidden" name="event-index">
    
    
                            <div class="form-group row">
                                <label for="event-name"><i class='bx bx-list-check' ></i>Type d'absence</label>
                                <div class="col-sm-8">
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
                                <div class="col-sm-8">
                                    <textarea type="text" name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="event-location" class="col-sm-4 control-label"><i class='bx bxs-calendar-edit'></i>date de début</label>
                                <div class="col-sm-8">
                                    <input name="dateDebut" type="datetime-local" class="form-control" id="dateDebut">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="event-location" class="col-sm-4 control-label"><i class='bx bxs-calendar-edit'></i>date de fin</label>
                                <div class="col-sm-8">
                                    <input name="dateFin" type="datetime-local" class="form-control" id="dateFin">
                                </div>
                            </div>
                            
    
    
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-danger" id="ajaxSubmit">
                                Ajouter
                            </button>
                        </div>
                    </form>
                    <!-- Fin mainForm -->
                
                </div>
            </div>
        </div>
        <!--------end Modal conge----------------->
        <!-----Modal details absence ---->
        <div class="modal fade" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="event-index">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="event-title" class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input id="event-title" name="event-title" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="min-date" class="col-sm-4 control-label">Dates</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-daterange" data-provide="datepicker">
                                        <input id="min-date" name="event-start-date" type="text"
                                            class="form-control">
                                        <div class="input-group-prepend input-group-append">
                                            <div class="input-group-text">to</div>
                                        </div>
                                        <input name="event-end-date" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="save-event">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!------ end Modal absence ------>

    <div id="context-menu">
    </div>

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
                var date_fin = $('#dateFin').val();
                var motif = $('#description').val();
                console.log(type_motif_conge_id + "----" + date_debut + "---" + date_fin + "---" + motif);
                $.ajax({
                    url: $(this).attr('action'),

                    method: $(this).attr('method'),
                    data: {
                        //user_id: $('#user_id').val(),
                        type_conge_id: type_motif_conge_id,
                        debut: date_debut,
                        fin: date_fin,
                        motif: motif
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

        
    </script>


</body>

</html>
