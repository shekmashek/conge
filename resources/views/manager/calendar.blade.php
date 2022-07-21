<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendar</title>
</head>

<body>
        <div class="container">
            <
        </div>
        <div id="dialog">
            <div id="dialog-body">
                <form id="dayClick" method="post" action="#">
                    @csrf
                    <div class="form-proup">
                        <label>Event title</label>
                        <input type="text" class="form-control" name="title" placeholder="Event title">
                    </div>
                    <div class="form-group">
                        <label>Start Date/time</label>
                        <input type="text" class="form-control" name="start" placeholder="start date & time">
                    </div>
                    <div class="form-group">
                        <label>Start Date/time</label>
                        <input type="text" class="form-control" name="end" placeholder="start date & time">
                    </div>
                    <div class="form-group">
                        <label>Background Color</label>
                        <input type="color" class="form-control" name="color" placeholder="start date & time">
                    </div>
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="form-control" name="textColor" placeholder="start date & time">
                    </div>
                </form>
            </div>
        </div>
    <script>
        jQuery(document).ready(function($) {
            /*  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }

              });*/

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                defaultView: 'month',
                showNonCurrentDates: false,
                yearColumns: 3,
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,month,basicDay,basicWeek'
                },

                dayClick: function(date, event, view) {
                    $('#dialog').dialog({
                        title: ['Add Event'],
                        width: 600,
                        height: 600,
                        modal: true,
                        autoResize:true,
                        show: {
                            effect: 'clip',
                            duration: 350
                        },
                        hide: {
                            effect: 'clip',
                            duration: 250
                        }
                    })

                }


            })
        });
    </script>
</body>

</html>
