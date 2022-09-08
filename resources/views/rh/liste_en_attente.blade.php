
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

{{------------------------------------data table Dmd en attente---------------------------------------}}

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

            </tr>
        </thead>
        <tbody>
            @forelse ($conges_en_attente as $conge)
            <tr>
                <td>{{ $conge->employe->nom_emp.' '.$conge->employe->prenom_emp }}</td>
                <td>{{ $conge->type_conge->type_conge }}</td>
                <td>{{ date('d M Y - H:i', strtotime($conge->debut)) }}</td>
                <td>{{ date('d M Y - H:i',strtotime($conge->fin)) }}</td>
                <td>{{ $conge->j_utilise }}</td>
                <td>{{ $conge->motif }}</td>
                <td>
                    @if ($conge->etat_conge->id == 3)
                    <div class="form-check form-switch">
                        <span><i class='bx bx-loader bx-spin fs-5' style='color:#ffa417'></i></span>
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                    </div>
                    @elseif ($conge->etat_conge_id == 2)

                    <div class="form-check form-switch">
                        <i class='bx bx-x-circle fs-5' style='color:var(--bs-red)'></i>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Refusé</label>
                    </div>
                    @elseif ($conge->etat_conge_id == 1)
                    <div class="form-check form-switch">
                        <span><i class='bx bx-check-circle fs-5' style='color:#85ea87' ></i></span>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Accordé</label>
                    </div>
                    @endif
                </td>

            </tr>
            @empty
                <span>Aucun congé enregistré</span>
            @endforelse



    </table>

    {{-----------------------------------data table Dmd en attente ajax-------------------------------------}}
  {{-- <table id="liste_en_attente" class="table table-bordered table-striped" style="width:100%"  >
        <thead>
            <tr>
                <th>Employe</th>
                <th>Type</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée(jour)</th>
                <th>Motif</th>
                <th>status</th>
            </tr>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
 --}}


</div>

@push('extra-js')
<script>
    $(document).ready(function () {
        var table = $('#liste_en_attente').DataTable({
            responsive: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },
        });

        new $.fn.dataTable.FixedHeader( table );

    });


    $('#ex1-tab-2').on('click', function () {
        $('#manager_card').addClass('visually-hidden');
    });

    $('#ex1-tab-1').on('click', function () {
        $('#manager_card').removeClass('visually-hidden');
    });

    var currentYear = new Date().getFullYear();

    var events = {!! json_encode($calendar, JSON_HEX_TAG) !!};




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



    document.addEventListener('DOMContentLoaded', function() {


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


</script>
@endpush
