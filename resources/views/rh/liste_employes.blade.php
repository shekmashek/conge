{{-- @extends('layouts.app') --}}


{{-- @push('extra-links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

<style>
    .show_hover:hover {
        opacity: 1!important;
    }
</style>

@endpush --}}

{{-- @section('content') --}}
<div class="container">
            <div class="row">
                <div class="fixedTop mt-2">
                    <table class="table" id="liste_employe_RH">
                        <thead style="background: #c7c9c939">
                            <tr>
                                <th class="align-middle text-center">ID</th>
                                <th class="align-middle text-center">Employé</th>
                                <th class="align-middle text-center">Contacts</th>
                                <th class="align-middle text-center">Département <br> Service</th>
                                <th class="align-middle text-center">Date d'embauche</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
</div>
{{-- @endsection --}}

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
        var table = $('#liste_employe_RH').DataTable({
            responsive: true,
            serverSide: true,
            processing: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },
            ajax: {
                url: "{{ route('liste_employes') }}",
                type: 'GET',
                data: function (d) {
                }
            },
            columns: [
                {
                    data: 'id', name: 'id'
                    , className: 'align-middle text-center'
                },

                {
                    data: 'nom_prenom',
                    className: 'align-middle text-center'

                },
                {
                    data: 'contacts',
                    className: 'align-middle text-center'

                },

                {
                    data: 'service.departement.nom_departement',
                    className: 'align-middle text-center',
                    render: function (data, type, row) {
                        return row.service.departement.nom_departement + ' <br> ' + row.service.nom_service;
                    }
                },
                {
                    data: 'contrat.date_embauche',
                    className: 'align-middle text-center',
                    render: function (data, type, row) {
                        // tranfrom date to dd/mm/yyyy
                        var date = new Date(row.contrat.date_embauche);
                        return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                        className: 'align-middle text-center'
                    }
                },
                // {
                //     data: 'actions',
                // },
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
            ]
        });
        new $.fn.dataTable.FixedHeader( table );
    });
</script>
@endpush
