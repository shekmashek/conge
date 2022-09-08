@extends('layouts.app')
@push('extra-links')

        {{-- bootstrap Year calendar css --}}
        <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
@endpush

@push('extra-scripts')

        {{-- bootstrap Year calendar js --}}
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

@endpush

@push('extra-links')
        <link rel="stylesheet" href="{{ asset('css/calendrier.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">

        {{-- bootstrap.min.css est importé dans admin.blade.php --}}
        {{-- fullCalendar utilise les icons bootstraps --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css' rel='stylesheet' />


        {{-- utilisation de fullcalendar-scheduler pour avoir accés aux planning --}}
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js'></script>

        {{-- les langues pour le calendrier --}}
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/locales-all.min.js"></script>

        {{-- bootstrap modal --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

        {{-- datepicker --}}



@endpush


@section('content')
{{-- //--------------------------------------------- --}}

<!-- Modal -->
            <div class="modal fade " id="year_modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div id='year_calendar'></div>
                        </div>
                    </div>

                </div>
            </div>

{{-- //----------------------------------------------- --}}

    <div class="container-fluid">
        {{-- <a href="#" class="btn_creer text-center filter mt-4" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a> --}}
        <div class="row w-100 mt-3 justify-content-between">


                <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">
                </li>
                    <li class="nav-item mx-auto underline_hover" role="presentation">
                        <a href="{{ route('home_RH') }} " class="nav-link d-flex align-items-center fs-4">
                            <i class='bx bx-list-ul fs-2 mt-auto'></i><span>Revenir à la liste</span>
                        </a>
                    </li>
            </ul>

            <div class="col-md-10 m-50 my-2 mx-auto">
                <div id='planning_conge'></div>
            </div>


        </div>

    </div>

@endsection

@push('extra-js')

<script>
                var currentYear = new Date().getFullYear();
                var events = {!! json_encode($events, JSON_HEX_TAG) !!};
                var year_modal = new bootstrap.Modal(document.getElementById('year_modal'));

                    events.forEach(element => {
                        if ((element.start != null) && (element.end != null)) {
                            element.name=element.title;
                            element.startDate = new Date(element.start);
                            element.endDate = new Date(element.end);
                            element.color = element.backgroundColor;
                        }
                    });


            document.addEventListener('DOMContentLoaded', function() {


                var year_calendar = new Calendar('#year_calendar',{
                dataSource: events,
                enableContextMenu: true,
                contextMenuItems:[
                    {
                        text: 'Aller à la date',
                        click: function(event) {
                            // console.log(event);
                            calendar.gotoDate(event.startDate);
                            year_modal.hide();
                            calendar.select(event.startDate, [event.endDate]);
                        }
                    },
                ],

                dayContextMenu: function(e) {
                    $(e.element).popover('hide');
                },
                clickDay: function(e) {
                    calendar.gotoDate(e.date);
                    year_modal.hide();
                    calendar.select(e.date);
                },
                mouseOnDay: function(e) {
                    if(e.events.length > 0) {
                        var content = '';

                        for(var i in e.events) {
                            content += '<div class="event-tooltip-content">'
                                            + '<div class="event-name fw-bold" style="color:' + e.events[i].color + '">' + e.events[i].employe + '</div>'
                                            + '<div class="event-location">' + e.events[i].type_conge.type_conge + '</div>'
                                            + '<div class="event-location">' + e.events[i].etat_conge.etat_conge + '</div>'
                                        + '</div>';
                        }

                        $(e.element).popover({
                            trigger: 'manual',
                            container: 'body',
                            html:true,
                            content: content
                        });

                        $(e.element).popover('show');
                    }
                },
                mouseOutDay: function(e) {
                    if(e.events.length > 0) {
                        $(e.element).popover('hide');
                    }
                },
            });





                var calendarEl = document.getElementById('planning_conge');
                var calendar = new FullCalendar.Calendar(calendarEl,
                    {


                    // views : resourceTimeline,resourceTimelineWeek,listMonth,dayGridMonth,timeGridWeek

                        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                        initialView: 'dayGridMonth',
                        locale: '{{ app()->getLocale() }}',
                        firstDay: 0,
                        nowIndicator: true,

                                    // button personnaliser

                        customButtons: {
                            myCustomButton: {
                                // text: 'Année',
                                icon: "bi bi-calendar",
                                hint:"vue en année",
                                click: function() {
                                    $('#year_modal').modal('show');
                                }
                            }
                        },


                        headerToolbar: {
                                        right: 'prev,next today',
                                        center: 'title',
                                        left: 'dayGridMonth,timeGridWeek,listMonth,myCustomButton'

                                    },


                        views: {

                            listMonth: {

                                duration: { months: 3 },
                            },

                            timeGridWeek: {

                            },

                        },


                        // show the description of events when hovering over them
                        eventMouseEnter : function(info) {
                            var tipStart = info.event.start.toLocaleTimeString();
                            var tipEnd = info.event.end.toLocaleTimeString();
                            var etat_conge = info.event.extendedProps.etat_conge.etat_conge;
                            // console.log(tipStart);
                            $(info.el).tooltip({
                                title: info.event.extendedProps.employe +' '+ etat_conge + ' ' + tipStart + ' - ' + tipEnd,
                                placement: 'top',
                                trigger: 'hover',
                                container: 'body',
                            });

                            $(info.el).tooltip('show');

                        },

                        // hide the description of events when no longer hovering over them
                        eventMouseLeave : function(info) {
                            $(info.el).tooltip('hide');
                        },


                        events: events,

                    }
                );




            calendar.render();



        //This checks the browser in use and populates da var accordingly with the browser
        // Ca marche sur Chrome
        var mousewheelevt=(/Firefox/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";
        // var mousewheelevt=(/Chrome/i.test(navigator.userAgent))? "DOMMouseScroll" : "mousewheel";


        function preventDefault(e) {
            e.preventDefault();
        }



        function preventDefaultForScrollKeys(e) {
            if (keys[e.keyCode]) {
                preventDefault(e);
                return false;
            }
        }

            // modern Chrome requires { passive: false } when adding event
            var supportsPassive = false;
        try {
            window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
                get: function () { supportsPassive = true; }
            }));
        } catch(e) {}

            var wheelOpt = supportsPassive ? { passive: false } : false;
            var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

        // call this to Disable
        function disableScroll() {
            window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
            window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
            window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
            window.addEventListener('keydown', preventDefaultForScrollKeys, false);

        }

        // call this to Enable
        function enableScroll() {
            window.removeEventListener('DOMMouseScroll', preventDefault, false);
            window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
            window.removeEventListener('touchmove', preventDefault, wheelOpt);
            window.removeEventListener('keydown', preventDefaultForScrollKeys, false);

        }


        //binds the scroll event to the calendar's DIV you have made
        calendar.el.addEventListener(mousewheelevt, function(e){
                var evt = window.event || e; //window.event para Chrome e IE || 'e' para FF
                var delta;
                delta = evt.detail ? evt.detail*(-120) : evt.wheelDelta;
                if(mousewheelevt === "DOMMouseScroll"){
                    delta = evt.originalEvent.detail ? evt.originalEvent.detail*(-120) : evt.wheelDelta;
                }

                // If the current view if on timeGridWeek, we want to scroll the calendar
                if(delta > 0 && calendar.view.type !== 'timeGridWeek'){
                    calendar.next();
                    $('.tooltip').hide();
                } else if (calendar.view.type === 'timeGridWeek') {
                    enableScroll();
                }
                if(delta < 0 && calendar.view.type !== 'timeGridWeek'){
                    calendar.prev();
                    $('.tooltip').hide();
                } else if (calendar.view.type === 'timeGridWeek') {
                    enableScroll();
                }

        });


        //hover event to disable or enable the window scroll
        calendar.el.addEventListener('mouseover', function() {
            // disable_scroll();
            disableScroll();

        });
        calendar.el.addEventListener('mouseout', function() {
            // enable_scroll();
            enableScroll();

        });


        //binds to the calendar's div the mouseleave event
        calendar.el.addEventListener("mouseleave", function()
        {
            // console.log('mouse leave');
            enableScroll();
        });

        //binds to the calendar's div the mouseenter event
        calendar.el.addEventListener("mouseenter", function()
        {
            // console.log('mouse enter');
            disableScroll();
        });


});


</script>

@endpush
