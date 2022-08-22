

  <a class="btn" data-bs-toggle="collapse" href="#year_calendar_collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
    <i class='bx bx-calendar fs-3' style='color:#969696'  ></i>
  </a>

  <div class="collapse my-2" id="year_calendar_collapse">
    <div class="card card-body">
        <div class="container">
            <div id='year_calendar'></div>
        </div>
    </div>
  </div>


<div class="row">

    <div class="container col-lg-6 col-sm-12 col-md-12 mt-5">



        <table id="liste_en_attente" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Employe</th>
                    <th>Type</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Motif</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>



            </tbody>


        </table>

    </div>



    {{-- <div class="col-lg-6 col-sm-12 col-md-12">

        <div class="container">
            <div id='year_calendar'></div>
        </div>
    </div>  --}}
</div>


<!-- Vertically centered scrollable modal -->
<div class="modal fade " id="refuser_conge">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="conge_id">Conge id : <span id="refuser_conge_id"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('conge.refuser_demande') }}" method="POST">
          <div class="modal-body">
                @csrf
                <input type="hidden" name="conge_id" id="id_conge" readonly>
                <div class="form-group">
                    <label for="message">Motif</label>
                    <textarea class="form-control" name="message" id="message_refus" rows="3">

                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" id="btnConfirmRefus" class="btn btn-primary">confirmer</button>
            </div>
        </form>
        </div>
      </div>
</div>

<div class="position-fixed bottom-0 top-75 end-0 translate-middle-y p-3 " style="z-index: 11">
    <div id="toast_accepter" class="toast hide bg-transparent border-success" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        {{-- <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_pqnfmone.json" background="transparent"  speed="0.6" class="w-25" style="" loop autoplay></lottie-player> --}}
        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_hlq6mcbz.json" background="transparent"  speed="0.6" class="w-25" style="" loop autoplay></lottie-player>
        <strong class="me-auto">Congé accepté</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">

      </div>
    </div>
    <div id="toast_refuser" class="toast hide bg-transparent border-danger" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_nvzik8vy.json" background="transparent"  speed="0.6" class="w-25" style="" loop autoplay></lottie-player>
        <strong class="me-auto">Congé rejeté</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">

      </div>
    </div>
  </div>

@push('extra-js')
<script>


    // modal refuser conge
    var refuser_conge_modal = new bootstrap.Modal(document.getElementById('refuser_conge'), {
        keyboard: false
    })


    var toast_accepter = new bootstrap.Toast(document.getElementById('toast_accepter'), {
        autohide: true,
        delay: 5000,
        animation: true,
        autohide: true,
        title: 'OK',
        body: 'Congé accepté',

    });
    var toast_refuser = new bootstrap.Toast(document.getElementById('toast_refuser'), {
        autohide: true,
        delay: 5000,
        animation: true,
        autohide: true,
        title: 'Not OK',
        body: 'Congé rejeté',

    });

    // accepter demande conge : refresh du datatable en ajax
    function accepter_conge(id){

        var url = "conge.accepter_demande";
        var conge_id = id;

        $.ajax({
                url: url,
                type: 'GET',
                data: {
                    conge_id: conge_id,
                    // action: action,
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // location.reload();
                    $('#toast_accepter .toast-body').html('');
                    $('#toast_refuser .toast-body').html('');
                    $('#toast_accepter .toast-body').html('Congé de '+ response.employe +' accepté');

                    toast_accepter.show();
                    $('#liste_en_attente').DataTable().ajax.reload();

                    // met à jour le nombre de congés en attente restant
                    var rows = $('#liste_en_attente').DataTable().rows().count();
                    console.log(rows-1);
                    if (rows-1 > 0) {
                        $('#nbr_en_attente').html(rows-1);
                    } else if(rows-1 <= 0) {
                        $('#nbr_en_attente').html('');
                        $('#nbr_en_attente').addClass('visually-hidden');
                    }

                    $('#liste_conge').DataTable().ajax.reload();

                },
                error: function (error) {
                    console.error(error);
                }
            });
    }


    function show_modal_refus(id){
        $('#refuser_conge_id').html('');
        $('#refuser_conge_id').html(id);
        $('#id_conge').val('');
        $('#id_conge').val(id);
        $('#message_refus').val('');
        refuser_conge_modal.show();
    }

    $('#refuser_conge').submit(function(e){
        // la page ne se recharge pas au submit
        e.preventDefault();
        var url = "{{ route('conge.refuser_demande') }}";
        // var data = $(this).serialize();
        var message = $('#message_refus').val();
        var conge_id = $('#id_conge').val();

        if(message == ''){
            alert('Veuillez saisir un message');
        }else{
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    conge_id: conge_id,
                    message: message,
                    // action: action,
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // location.reload();
                    $('#toast_accepter .toast-body').html('');
                    $('#toast_refuser .toast-body').html('');

                    $('#toast_refuser .toast-body').html('Congé de '+ response.employe +' rejeté');

                    toast_refuser.show();

                    $('#liste_en_attente').DataTable().ajax.reload();

                    // mettre à jour le nombre de congés en attente
                    var rows = $('#liste_en_attente').DataTable().rows().count();
                    console.log(rows-1);
                    if (rows-1 > 0) {
                        $('#nbr_en_attente').html(rows-1);
                    } else if(rows-1 <= 0) {
                        $('#nbr_en_attente').html('');
                        $('#nbr_en_attente').addClass('visually-hidden');
                    }

                    $('#liste_conge').DataTable().ajax.reload();
                    refuser_conge_modal.hide();
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }
    });


    $(document).ready(function () {

        var table = $('#liste_en_attente').DataTable({


            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },
            ajax: {
                url: "{{ route('home_manager') }}",
                data: function (d) {

                }

            },
            responsive: true,
            columns: [
                {
                    data: 'employe.nom_emp'||'employe.prenom_emp',
                    name: 'employe.nom_emp'||'employe.prenom_emp',
                    render: function (data, type, row) {
                        return row.employe.nom_emp + ' ' + row.employe.prenom_emp;
                    }


                },
                {data: 'type_conge.type_conge'},
                {data: 'debut'},
                {data: 'fin'},
                {data: 'motif'},

                {
                    data: 'action'
                }

            ],
            columnDefs:[
                {
                  "targets": [ 0 ],
                    "visible": true,
                    "searchable": true

                },
                {
                    "targets": [ 1 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 3 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 4 ],
                    "visible": true,
                    "searchable": true
                },
            ],

        });


         $('#btnSearch').on('click',function(e){
            e.preventDefault();
            table.draw();
        })
        //---------refresh datatable after search date to date---------------
        $('#refresh').on('click',function(e){
            $("input[name='debut']").val(" ");
            $("input[name='fin']").val(" ");
            e.preventDefault();
            table.draw();
        })
    });



    $('#ex1-tab-2').on('click', function () {
        $('#manager_card').addClass('visually-hidden');
    });

    $('#ex1-tab-1').on('click', function () {
        $('#manager_card').removeClass('visually-hidden');
    });



    // calendar
    var currentYear = new Date().getFullYear();

    // la variable $conges est retournée par php mais pas encore ajax
    var events = {!! json_encode($conges, JSON_HEX_TAG) !!};


    events.forEach(element => {
            if ((element.debut != null) && (element.fin != null)) {
                element.name=element.employe.nom_emp+' '+element.employe.prenom_emp;
                element.startDate = new Date(element.debut);
                element.endDate = new Date(element.fin);
            }

            if (element.etat_conge_id == 1) {
                element.color = '#85ea87';
            } else if (element.etat_conge_id == 2) {
                element.color = 'var(--bs-red)';
            } else if (element.etat_conge_id == 3) {
                element.color = '#ffa417';
            }

    });


    // events.forEach(element => {
    //     console.log(element);
    // });

    document.addEventListener('DOMContentLoaded', function() {

        // bootstrap year calendar
        var year_calendar = new Calendar('#year_calendar',{

            dataSource: events,
            enableContextMenu: false,
            contextMenuItems:[
                {
                    text: 'Aller à la date',
                    click: function(event) {
                        // console.log(event);

                    }
                },
            ],

            // pour la séléction longue
            // selectRange: function(e) {
            //     editEvent({ startDate: e.startDate, endDate: e.endDate });
            // },

            dayContextMenu: function(e) {
                $(e.element).popover('hide');
            },

            clickDay: function(e) {

            },


            mouseOnDay: function(e) {
                if(e.events.length > 0) {
                    var content = '';

                    for(var i in e.events) {
                        content += '<div class="event-tooltip-content">'
                                            + '<div class="event-name fw-bold" style="color:' + e.events[i].color + '">' + e.events[i].name + '</div>'
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
    });




</script>
@endpush
