@extends('layouts.app')


@push('extra-links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

<style>
    .show_hover:hover {
        opacity: 1!important;
    }

</style>

@endpush

@section('content')
<div class="container mt-5">
    <table id="liste_employe_manager" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nom Prenom(s)</th>
                <th>Département/Service</th>
                <th>Date d'embauche</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>


        </tbody>

    </table>

</div>
@endsection

@push('extra-scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>


@endpush

@push('extra-js')
<script>



    $(document).ready(function () {


        var table = $('#liste_employe_manager').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },

            ajax: {
                url: "{{ route('manager.liste_employes') }}",
                type: 'GET',
                data: function (d) {

                }
            },
            columns: [
                {
                    data: 'nom_prenom',
                },
                {
                    data: 'service.departement.nom_departement',
                    render: function (data, type, row) {
                        return row.service.departement.nom_departement + ' / ' + row.service.nom_service;
                    }
                },
                {
                    // if contrat : contrat.date_embauche else : null
                    data: 'contrat'
                },

                {
                    data: 'actions',
                },
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
                    "searchable": false
                },

            ]

        });

        new $.fn.dataTable.FixedHeader( table );


    });
</script>
@endpush
