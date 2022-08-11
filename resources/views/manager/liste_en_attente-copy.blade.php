

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


<div class="comtainer mt-5">


    <table id="liste_en_attente" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Employe</th>
                <th>Type</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée(j)</th>
                <th>Motif</th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>



        </tbody>


    </table>

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
                <button type="submit" class="btn btn-primary">confirmer</button>
            </div>
        </form>
        </div>
      </div>
</div>


@push('extra-js')
<script>

    // modal refuser conge
    var refuser_conge_modal = new bootstrap.Modal(document.getElementById('refuser_conge'), {
        keyboard: false
    })

    // datatable
    $(document).ready(function () {
        var table = $('#liste_en_attente').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },

            ajax: {
                url: "{{ route('CongeEnAttente') }}",
                type: 'GET',
                data: function (d) {

                }
            },
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
                {data: 'j_utilise'},
                {data: 'motif'},
                {
                    data: 'etat_conge.etat_conge',
                    render: function (data, type, row) {
                        if (row.etat_conge.id == 1) {
                            return '<div class="input-group border-0 d-flex justify-content-around">'+
                                '<span class="input-group-text border-0 bg-transparent"><i class="bx bx-check-circle fs-5" style="color:#85ea87" ></i></span>'+
                                '<label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label>'+
                                '</div>'
                        } else if (row.etat_conge.id == 2) {
                            return '<div class="input-group d-flex justify-content-around"><span class="input-group-text border-0 bg-transparent"><i class="bx bx-x-circle fs-5 " style="color:var(--bs-red)"></i></span><label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label></div>';
                        } else if (row.etat_conge.id == 3) {
                            return '<div class="input-group d-flex justify-content-around"><span class="input-group-text border-0 bg-transparent"><i class="bx bx-loader bx-spin fs-5" style="color:#ffa417"></i></span><label class="form-control border-0 bg-transparent show_hover" for="flexSwitchCheckDefault">'+row.etat_conge.etat_conge+'</label></div>'
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return '<div class="dropdown dropstart"  data-conge-id="'+row.id+'">'+
                                    '<button class="btn fs-3" type="button" id="etat_actions" data-bs-toggle="dropdown" aria-expanded="false">'+
                                        '<i class="bx bx-dots-vertical-rounded"></i>'+
                                    '</button>'+
                                    '<ul class="dropdown-menu dropdown-start" aria-labelledby="etat_actions">'+
                                    '<li><button class="dropdown-item" type="button">Accepter</button></li>'+
                                    '<li><button class="dropdown-item" type="button">Refuser</button></li>'+
                                    '</ul>'+
                                '</div>'
                    }
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
                {
                    "targets": [ 5 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 6 ],
                    "visible": true,
                    "searchable": true
                }
            ]

        });

        new $.fn.dataTable.FixedHeader( table );


    });


    $('#ex1-tab-2').on('click', function () {
        $('#manager_card').addClass('visually-hidden');
    });

    $('#ex1-tab-1').on('click', function () {
        $('#manager_card').removeClass('visually-hidden');
    });



    // calendar
    var currentYear = new Date().getFullYear();

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
            enableContextMenu: true,
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



    // accepter/refuser
    $('.dropdown-item').on('click', function () {
        var conge_id = $(this).closest('div').data('conge-id');
        var action = $(this).text();

        if (action == 'Accepter') {
            alert('Accepter id '+conge_id);
            var url = "conge.accepter_demande";
        } else if (action == 'Refuser') {
            alert('Refuser');
            // var url = "conge.refuser_demande";
            var conge_id_modal = $('#refuser_conge_id').text(conge_id);
            var id_conge_modal = $('#id_conge');
            id_conge_modal.val(conge_id);
            refuser_conge_modal.show();
        }

        if (url) {
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
            },
            error: function (error) {
                console.error(error);
            }
        });
        }
    });

</script>
@endpush
