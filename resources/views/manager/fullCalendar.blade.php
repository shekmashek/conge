<?php
$json_motif_conge = json_encode($type_conges);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
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
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="row col-md-4">
                <h1>Bonjour</h1>
            </div>
            <div class="row col-md-8">
                <div class="jumbotron">
                    <h1 class="text-center">Calendrier d'abscence</h1>
                </div>

                <div class="container">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <div id="createEventModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Demande de conge</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="modalBody" class="modal-body">
                        <div class="card-body">

                            <form action="{{ route('insererConge') }}" method="post" accept-charset="UTF-8">
                                @csrf
                                <!--<a class="btn btn-secondary" href="{{ route('formHeure') }}">
                                    Heure</a>

                                <a class="btn btn-secondary" href="{{ route('formDemiJourne') }}">
                                    Demi-journe</a>
                                <a class="btn btn-secondary" href="{{ route('formJour') }}">
                                    Jours</a>-->

                                <div class="form-row">
                                    <div class="value">
                                        <label>motif</label>
                                        <div class="input-group">
                                            <div class="rs-select2 js-select-simple select--no-search">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="motif">
                                                    <option selected>...</option>
                                                    @foreach ($type_conges as $type_conge)
                                                        <option value={{ $type_conge['id'] }}>
                                                            {{ $type_conge['nom_motif'] }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row m-b-55">

                                    <div class="value">
                                        <label>Description</label>
                                        <div class="row row-refine">

                                            <div class="col-9">
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                                        name="description"></textarea>
                                                    <label for="floatingTextarea2">Commentaires</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Heure
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Demi-journe
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Jour
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label><b>Heure du debut</b></label>
                                    <input type="datetime-local" name="dateDebut" />
                                </div>
                                <br>

                                <div class="form-group">
                                    <label><b>Heure de fin</b></label>
                                    <input type="datetime-local" name="dateFin" />
                                </div>
                                <br>
                                <br>

                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button type="submit" class="btn btn-success" id="submitButton">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {




            var SITEURL = "{{ url('/') }}";

            //logBtn.addEventListener('click', fetchData);



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                }
            });



            var calendar = $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'year,month,basicWeek,basicDay'
                },
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    /*var title = prompt('Event Title:');

                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        console.log(start);
                        console.log(end);
                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },

                            type: "POST",
                            success: function(data) {
                                displayMessage("Event Created Successfully");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });

                    }*/
                    $('#createEventModal').modal('show');
                },
                eventClick: function(event) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#fullCalModal').modal();
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },
                eventClick: function(event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event Deleted Successfully");
                            }
                        });
                    }
                }

            });

            //dropdown motif conge
            var type_motifs = <?php echo $json_motif_conge; ?>;
            console.log(type_motifs[0]['id']);
            $(".fc-right").append(function() {


                var html = '';
                var startSelect = '<select>';
                var endSelect = '</select>';
                for (var i = 0; i < type_motifs.length; i++) {
                    html += '<option value=' + type_motifs[i]['id'] + '>' + type_motifs[i]['nom_motif'] +
                        '</option>';
                }
                return startSelect + html + endSelect;
            });



            $(".select_month").on("change", function(event) {
                $('#calendar').fullCalendar('changeView', 'month', this.value);
                $('#calendar').fullCalendar('gotoDate', "2018-" + this.value + "-1");
            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Congés');
        }
    </script>

</body>

</html>
