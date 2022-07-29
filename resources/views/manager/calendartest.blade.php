<?php
//$json_motif_conge = $conges;
//var_dump($json_motif_conge);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar scroll</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <div class="row">
        <div class="row col-md-7">
            <div class="row col-md-3">

            </div>
            <div class="cards col-md-7">

                <div class="card my_card">
                    <div class="card-header">
                        <h5 style="text-align:center"><i class='bx bxs-calendar bx-flip-horizontal'
                                style='color:#f3552e'></i> Indemnité de congé</h5>
                    </div>
                    <div class="card-body mycard-body">

                        <label>
                          <b>  <p>19.5</p>
                            ACQUIS</b>
                        </label>
                        <label>
                            <b>
                            <p>10</p>
                            SOLDE
                            </b>
                        </label>
                        <label>
                            <b>
                            <p>17</p>
                            PRIS
                            </b>
                        </label>


                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-4">

            <button class="btn btn-outline-danger" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"><i class='bx bx-plus'></i> Ajouter une absence</button>
            <br>
            <br>
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Modal Conge-->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form method="post" action="{{ route('insert_absence') }}" id="mainForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Demande d'absence</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Selectionnez le type d'absence et ajoutez une description de votre demande</p>
                        <input type="hidden" name="event-index">

                        <div class="form-group row">
                            <label for="event-name">Type d'absence</label>
                            <div class="col-sm-8">
                                <select name="type_motif_conge_id" id="type_motif_conge_id">
                                    @foreach ($type_conges as $type_conge)
                                        <option value="{{ $type_conge['id'] }}">{{ $type_conge['nom_motif'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="event-name">Description</label>
                            <div class="col-sm-8">
                                <textarea type="text" name="description" class="form-control" id="description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="event-location" class="col-sm-4 control-label">date de début</label>
                            <div class="col-sm-8">
                                <input name="dateDebut" type="datetime-local" class="form-control" id="dateDebut">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="event-location" class="col-sm-4 control-label">date de fin</label>
                            <div class="col-sm-8">
                                <input name="dateFin" type="datetime-local" class="form-control" id="dateFin">
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger" id="ajaxSubmit">
                            Ajouter
                        </button>
                    </div>
                </form>
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
            $('#mainForm').on('submit', function(e) {
                e.preventDefault();
                var type_motif_conge_id = $('#type_motif_conge_id').val();
                var start = $('#dateDebut').val();
                var end = $('#dateFin').val();
                var title = $('#description').val();
                console.log(type_motif_conge_id + "----" + start + "---" + end + "---" + title);
                $.ajax({
                    url: $(this).attr('action'),

                    method: $(this).attr('method'),
                    data: {
                        //user_id: $('#user_id').val(),
                        type_motif_conge_id: type_motif_conge_id,
                        start: start,
                        end: end,
                        title: title
                    },
                    success: function(response) {


                        test_e = response.data;
                        test_e.forEach(element => {
                            if (element.start != null && element.end != null) {
                                element.startDate = new Date(element.start);
                                element.endDate = new Date(element.end);
                                element.name = element.title;

                            }
                        });
                        console.log(test_e);
                        //ajax via calendar apres insertion absence
                        calendar = new Calendar('#calendar', {

                            dataSource: test_e

                        });
                    }

                });

            });

        });

        /*--------------------------------------------end ajax insertion ajax ---------------------------------------*/

        var liste_conges = <?php echo $conges; ?>;
        liste_conges.forEach(element => {
            if (element.start != null && element.end != null) {
                element.startDate = new Date(element.start);
                element.endDate = new Date(element.end);
                element.name = element.title;

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
                            if (e.events[i].etat_conge == 0) {
                                etat =
                                    'non accordé <i class="bx bx-loader-circle bx-spin bx-rotate-90" style="color:green"></i>';

                            } else {
                                etat = 'accordé <i class="bx bx-check"></i>';
                            }

                            content += '<br><div class="event-tooltip-content">' +
                                '<div class="event-name" style="color:' + e.events[i].color +
                                '"><b>Motif:</b> ' + e
                                .events[i].title + '</div>' +
                                '<div class="event-location"><b>Durée de l&#39;absence: </b>' + e
                                .events[i]
                                .dure_conge + 'heure(s)</div>' +
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
