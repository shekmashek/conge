@push('extra-links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

<style>
            .badge.bg-purple {
                background-color: #f1e7fe!important;
                color: #a537fd!important;

            }
            .table-head {
                font-weight: normal;
            }
            .text-purple {
                color: #9359ff;
            }
            .form-select:focus,
            .form-control:focus {
                border-color: #ab39f7;
                box-shadow: 0 0 0 0.2rem rgba(160, 92, 248, 0.25);
            }
            .nav-tabs:hover {
                outline: none;
                border: none;
            }
            .nav-item a:hover {
                outline: none;
                color: #9359ff;
                text-decoration: none;
            }
            .nav-tabs .nav-link {
                border: none;
                color: #535353c9;
            }
            .nav-tabs .nav-link.active {
                border-bottom: 2px solid #9359ff;
                color: #9359ff;
            }
            .dataTables_length label,
            .dataTables_filter label {
                opacity: 0.5;
                transition: opacity 0.15s ease-in;
            }
            .dataTables_length label:hover,
            .dataTables_filter label:hover {
                opacity: 1;
            }
            .page-item.active .page-link {
                border-radius: 5rem;
                border: 1px solid #9359ff;
                background-color: #9359ff !important;
                padding: 0.3rem 0.7rem;
                /* color: #59ff90; */
                margin: 0 0.5rem;
                font-size: small;
                color: white!important;
                transition: 0.3s;
            }
            .page-item.disabled .page-link {
                font-size: smaller;
                opacity: 0, 5;
            }
</style>

@endpush

<div class="comtainer mt-5">
    <table id="liste_conge" class="table table-striped" style="width:100%">
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
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                      </div>
                </td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                      </div>
                </td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">En attente</label>
                      </div>
                </td>
            </tr>

    </table>

</div>

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
        var table = $('#liste_conge').DataTable({
            responsive: true,
            language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            },
        });

        new $.fn.dataTable.FixedHeader( table );

    });
</script>
@endpush
