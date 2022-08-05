@extends('layouts.app')

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


@endpush


@section('content')

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

            {{-- afficher les details d'un event --}}
            {{-- <div id="detail_offcanvas" class="offcanvas offcanvas-end" tabindex="-1"
             data-bs-scroll="true" data-bs-backdrop="true" aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header" id="event_header">


                <h5 id="event_title"></h5>
                <span class="input-group-text border-0 bg-light fs-2" id="event_to_pdf"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Télécharger en pdf">

                </span>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>


              <div class="mb-1 rounded-3 divider"></div>

              <div class="offcanvas-body" id="offcanvas_body">

                <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_projet"><i class='bx bxs-briefcase text-secondary'></i></span>
                    <span type="text" id="event_project"
                    class="form-control mt-1 border-0 bg-light"
                    aria-label="projet" aria-describedby="basic-addon_projet"></span>


                    <input type="text" id="event_type_formation"
                    class="form-control border-0 background_purple fw-bolder rounded"
                    placeholder="Type de formation"
                    aria-label="type_formation" aria-describedby="basic-addon_projet" readonly>
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="addon-wrapping"><i class='bx bxs-buildings text-secondary'></i></span>

                    <span id="event_entreprise" class="form-control border-0 border-bottom mt-1" ></span>
                  </div>
                <div class="input-group mb-4" id="event_sessions">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_sessions"><i class='bx bxs-calendar-event text-secondary' ></i></span>
                    <input type="text" id="event_nbr_session"
                    class="form-control border-0 border-bottom d-block w-auto marge_left-30"
                    placeholder="Nombre session" aria-label="nbr_session"
                    aria-describedby="basic-addon_sessions">

                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_lieu"><i class='bx bxs-map text-secondary' ></i></span>
                    <input type="text" id="event_lieu" class="form-control border-0 border-bottom"
                    placeholder="lieu" aria-label="Place"
                    aria-describedby="basic-addon_lieu">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_of_formateur"><i class='bx bxs-chalkboard text-secondary' ></i></span>
                    <input type="text" id="event_OF" class="form-control border-0 border-bottom"
                    placeholder="OF" aria-label="OF"
                    aria-describedby="basic-addon_of_formateur">

                    <span type="text" id="event_formateur" class="form-control border-0 border-bottom mt-1 hover_purple"
                        aria-label="Formateur"
                        aria-describedby="basic-addon_of_formateur">
                    </span>
                </div>


                <div class="accordion mt-5 input-group" id="materiel_accordion_container">
                    <label for="materiel_button">
                        <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_materiel"><i class='bx bxs-wrench text-secondary'></i></span>
                    </label>
                    <div class="accordion-item width_80 border-0">

                        <h2 class="form-control accordion-header border-0 border-bottom" id="materiel_heading">
                            <button class="accordion-button p-2 collapsed" id="materiel_button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#materiel_collapse" aria-expanded="false" aria-controls="materiel_collapse">
                              Materiel nécessaire
                            </button>
                        </h2>

                          <div id="materiel_collapse" class="accordion-collapse collapse border-bottom mb-2" aria-labelledby="headingThree"
                                data-bs-parent="#materiel_accordion_container">
                            <div class="accordion-body padding_0">
                                <div class="accordion accordion-flush px-2" id="materiel_accordion">

                                </div>
                            </div>
                          </div>

                    </div>
                </div>


                <div class="accordion mt-5 input-group" id="accordion_container">
                    <label for="container_button">
                        <span class="input-group-text border-0 bg-light fs-2" id="basic-addon_participants"><i class='bx bxs-group text-secondary' ></i></span>
                    </label>
                    <div class="accordion-item border-0 width_80">
                        <h2 class="accordion-header border-0 border-bottom" id="headingTwo">
                            <button class="accordion-button p-2 collapsed" id="container_button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Participants
                            </button>
                        </h2>

                          <div id="collapseTwo" class="accordion-collapse collapse border-bottom" aria-labelledby="headingTwp" data-bs-parent="#accordion_container">
                            <div class="accordion-body padding_0">
                                <div class="accordion accordion-flush px-2" id="accordionExample">

                                </div>
                            </div>
                          </div>

                    </div>
                </div>

              </div>
            </div> --}}

        </div>



    </div>

@endsection

@push('extra-js')

<script>
            document.addEventListener('DOMContentLoaded', function() {

                var events = {!! json_encode($events, JSON_HEX_TAG) !!};

                var calendarEl = document.getElementById('planning_conge');
                var calendar = new FullCalendar.Calendar(calendarEl,
                    {


                    // views : resourceTimeline,resourceTimelineWeek,listMonth,dayGridMonth,timeGridWeek

                        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                        initialView: 'dayGridMonth',
                        locale: '{{ app()->getLocale() }}',
                        firstDay: 0,
                        nowIndicator: true,
                        headerToolbar: {
                                        right: 'prev,next today',
                                        center: 'title',
                                        left: 'dayGridMonth,timeGridWeek,listMonth'

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
                            // console.log(tipStart);
                            $(info.el).tooltip({
                                title: info.event.extendedProps.employe + ' ' + tipStart + ' - ' + tipEnd,
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
