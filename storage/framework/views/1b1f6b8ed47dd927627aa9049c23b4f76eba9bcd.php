

<?php $__env->startPush('extra-links'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/calendrier.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/datepicker.css')); ?>">

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

        <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css' rel='stylesheet' />


        
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js'></script>

        
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/locales-all.min.js"></script>


<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        
        <div class="row w-100 mt-3 justify-content-between">


                <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">
    </li>
        <li class="nav-item mx-auto underline_hover" role="presentation">
            <a href="<?php echo e(route('home_manager')); ?> " class="nav-link d-flex align-items-center fs-4">
                <i class='bx bx-list-ul fs-2 mt-auto'></i><span>Revenir à la liste</span>
            </a>
        </li>
  </ul>

            <div class="col-md-10 m-50 my-2 mx-auto">
                <div id='planning_conge'></div>
            </div>

            
            

        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('extra-js'); ?>

<script>




            document.addEventListener('DOMContentLoaded', function() {
                var events = <?php echo json_encode($conges, JSON_HEX_TAG); ?>


                console.log(events);

                var calendarEl = document.getElementById('planning_conge');
                var calendar = new FullCalendar.Calendar(calendarEl,
                    {
                    // views : resourceTimeline,resourceTimelineWeek,listMonth,dayGridMonth,timeGridWeek


                        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                        initialView: 'dayGridMonth',
                        locale: '<?php echo e(app()->getLocale()); ?>',
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

                            var type_conge = info.event.extendedProps.type_conge.type_conge;
                            var j_utilise = info.event.extendedProps.j_utilise;
                            $(info.el).tooltip({
                                title: info.event.title + ' - ' + type_conge + ' - ' + j_utilise + ' jours',
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

                        // eventSources: [{

                        //     events: function(start, end, timezone, callback) {
                        //         $.ajax({
                        //             url     : "<?php echo e(route('calendrier_conge')); ?>",
                        //             type    : 'GET',
                        //             dataType: 'json',
                        //             data    : {
                        //                 test:'test_event',
                        //             },
                        //             success : function(doc) {
                        //                 var events = [];
                        //                 $(doc).find('event').each(function() {
                        //                     events.push({
                        //                         title    : $(this).attr('title'),
                        //                         start    : $(this).attr('start'),
                        //                         end      : $(this).attr('end'),
                        //                     });
                        //                 });
                        //                 callback(doc);
                        //                 console.log(doc);
                        //             }

                        //         });
                        //     }
                        //     }]

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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/manager/calendrier_conge.blade.php ENDPATH**/ ?>