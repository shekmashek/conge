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
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>


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
                                <a href="#" class="nav-link py-3 px-2">
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
                                      <h6>id: dsdsjhsxns65s6x | John Doe</h6>
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
                <div id="historique">
                    <div class="row" style="padding-top: 20px;">
                        <h2>Historique de congé</h2>
                    </div>
                    <div class="row" style="padding-top: 20px; padding-bottom: 20px;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="conge_employe">Accueil</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mon historique de congé</li>
                            </ol>
                        </nav>
                    </div>
                    <table style="padding-top: 20px; padding-bottom: 20px;" id="myTable" class="table table-bordered table-striped">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/historique_congeJson",
        dataType: 'json',
        async: false,
        success: function (data) {
        console.log("Tafiditra ato");
            console.log(data);
            $('#myTable tr').empty();
            var header = '';
            header += '<tr>';
            header += '<th>Type de congé</th>';
            header += '<th>Fréquence solde</th>';
            header += '<th>Début</th>';
            header += '<th>Fin</th>';
            header += '<th>Intervalle</th>';
            header += '<th>Durée de congé</th>';
            header += '<th>Motif</th>';
            header += '<th>Etat</th>';
            header += '<th>Actions</th>';
            header += '</tr>';
            $('#myTable thead').append(header);
            var congeEnAttente_data = '';
            $.each(data, function (key, value) {
                congeEnAttente_data += '<tr>';
                congeEnAttente_data += '<td>' + value.type_conge + '</td>';
                congeEnAttente_data += '<td>' + value.frequence + '</td>';
                congeEnAttente_data += '<td>' + value.debut + '</td>';
                congeEnAttente_data += '<td>' + value.fin + '</td>';
                if (value.intervalle===null) {
                    congeEnAttente_data += '<td>' + '---' + '</td>';
                }
                else{
                    congeEnAttente_data += '<td>' + value.intervalle + '</td>';
                }
                congeEnAttente_data += '<td>' + value.duree_conge/1440 + '</td>';
                congeEnAttente_data += '<td>' + value.motif + '</td>';
                if (value.etat_conge_id == 1) {
                    congeEnAttente_data += '<td>' + value.etat_conge + ' <i class="bx bx-check-circle" style="color:green; font-size: 20px; font-weight: bold;"></i>' +'</td>';
                }
                if (value.etat_conge_id == 2){
                    congeEnAttente_data += '<td>' + value.etat_conge + ' <i class="bx bx-x-circle" style="color: red; font-size: 20px; font-weight: bold;"></i>' +'</td>';
                }
                if(value.etat_conge_id == 3){
                    congeEnAttente_data += '<td>' + value.etat_conge + ' <i class="bx bx-loader-circle bx-spin bx-rotate-90" style="color:#BDB76B; font-size: 20px; font-weight: bold;"></i>' +'</td>';
                    congeEnAttente_data += '<td><button type="button" id="annulerDemande" class="btn btn-outline-danger">Annuler la demande</button> <button type="button" id="modifierDemande" class="btn btn-outline-success">Modifier la demande</button></td>';
                }
                congeEnAttente_data += '</tr>';
            });
            $('#myTable tbody').append(congeEnAttente_data);
        }
    });
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* Début formulaire ajout d'absence à remplir */
            $('#annulerDemande').on('submit', function(e) {
                e.preventDefault();

            /* Liste des input à remplir */
                console.log('vokitika ilay annuler')

            });

        /* Fin formulaire ajout d'absence à remplir */

        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
</body>

</html>
