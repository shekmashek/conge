@section('title')
<p class="text_header m-0 mt-1">employés</p>
@endsection


<style>
  table,
  th {
    font-size: 11px;
  }

  th,
  tr {
    text-align: center;
  }

  table,
  td {
    font-size: 11px;
  }

  .nav_bar_list:hover {
    background-color: transparent;
  }

  .nav_bar_list .nav-item:hover {
    border-bottom: 2px solid black;
  }

  .input_inscription {
    padding: 2px;
    border-radius: 100px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important;
    border: 2px solid #aa076c17 !important;
  }

  .input_inscription:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 2px solid #AA076B !important;
    outline-width: 0 !important;
  }

  .form-control-placeholder {
    position: absolute;
    top: 1rem;
    padding: 12px 2px 0 2px;
    padding: 0;
    padding-top: 2px;
    padding-bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
    transition: all 300ms;
    opacity: 0.5;
    left: 2rem;
  }

  .input_inscription:focus+.form-control-placeholder,
  .input_inscription:valid+.form-control-placeholder {
    font-size: 95%;
    font-weight: bolder;
    top: 1rem;
    transform: translate3d(0, -100%, 0);
    opacity: 1;
    backgroup-color: white;
  }

  input:-webkit-autofill,
  input:-webkit-autofill:hover,
  input:-webkit-autofill:focus,
  input:-webkit-autofill:active {
    box-shadow: 0 0 0 30px white inset !important;
    -webkit-box-shadow: 0 0 0 30px white inset !important;
  }

  .status_grise {
    border-radius: 1rem;
    background-color: #637381;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_reprogrammer {
    border-radius: 1rem;
    background-color: #00CDAC;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_cloturer {
    border-radius: 1rem;
    background-color: #314755;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_reporter {
    border-radius: 1rem;
    background-color: #26a0da;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_annulee {
    border-radius: 1rem;
    background-color: #b31217;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_termine {
    border-radius: 1rem;
    background-color: #1E9600;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .status_confirme {
    border-radius: 1rem;
    background-color: #2B32B2;
    color: white;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .statut_active {
    border-radius: 1rem;
    background-color: rgb(15, 126, 145);
    color: whitesmoke;
    width: 60%;
    align-items: center margin: 0 auto;
  }

  .btn_creer {
    background-color: white;
    border: none;
    border-radius: 30px;
    padding: .2rem 1rem;
    color: black;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
  }

  .btn_creer a {
    font-size: .8rem;
    position: relative;
    bottom: .2rem;
  }

  .btn_creer:hover {
    background: #6373812a;
    color: blue;
  }

  .btn_creer:focus {
    color: blue;
    text-decoration: none;
  }

  .icon_creer {
    background-image: linear-gradient(60deg, #f206ee, #0765f3);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    font-size: 1.5rem;
    position: relative;
    top: .4rem;
    margin-right: .3rem;
  }

  .color-text-trie {
    color: blue;
  }

  .navigation_module .nav-link {
    color: #637381;
    padding: 5px;
    cursor: pointer;
    font-size: 0.900rem;
    transition: all 200ms;
    margin-right: 1rem;
    text-transform: uppercase;
    padding-top: 10px;
    border: none;
  }

  .nav-item .nav-link.active {
    border-bottom: 3px solid #7635dc !important;
    border: none;
    color: #7635dc
  }

  .nav-tabs .nav-link:hover {
    background-color: rgb(245, 243, 243);
    transform: scale(1.1);
    border: none;
  }

  .nav-tabs .nav-item a {
    text-decoration: none;
    text-decoration-line: none;
  }

  #modifTable_length label,
  #modifTable_length select,
  #modifTable_filter label,
  .pagination,
  .headEtp,
  .dataTables_info,
  .dataTables_length,
  .headProject {
    font-size: 13px;
  }

  .redClass {
    color: #f44336 !important;
  }

  .arrowDrop {
    color: #1e9600;
    transition: 0.3s !important;
    transform: rotate(360deg) !important;
  }

  .mivadika {
    transform: rotate(180deg) !important;
    color: red !important;
    transition: 0.3s !important;
  }

  #example_length select {
    height: 25px;
    font-size: 13px;
    vertical-align: middle;
  }

  .hideAction {
    display: none;
  }

  .page-item.active .page-link {
    z-index: 3;
    color: black !important;
    background-color: white;
    border: 1px solid black;
  }
</style>


<div class="row">
  <div class="fixedTop mt-2">
    <table class="table" id="adminTable">
      <thead style="background: #c7c9c939">
        <tr>
          <th class="align-middle text-center">ID</th>
          <th class="align-middle text-center">Employé</th>
          <th class="align-middle text-center">Contacts</th>
          <th class="align-middle text-center">Département <br> Service</th>
          @canany(['isReferent','isReferentFormation','isAdmin'])
          <th class="align-middle text-center">Formateur interne</th>
          @can('isAdmin')
          <th class="align-middle text-center">Réferent</th>
          @endcan
          <th class="align-middle text-center">Status</th>
          <th class="align-middle text-center">Action</th>
          @endcanany
        </tr>
      </thead>
      <tbody>
        @foreach ($employes as $employe)
        <tr>
          <td class="align-middle text-center">{{ $employe->id }}</td>
          <td class="align-middle text-center">{{ $employe->nom_emp . ' ' . $employe->prenom_emp }}</td>
          <td class="align-middle text-center">{{ $employe->email_emp }}<br>{{$employe->telephone_emp }}</td>
          <th class="align-middle text-center">{{ $employe->service->departement->nom_departement }}<br>{{ $employe->service->nom_service }}</th>
          @canany(['isReferent','isReferentFormation','isAdmin'])
          <th class="align-middle text-center">{{ "Formateur interne" }}</th>
          @can('isAdmin')
          <td class="align-middle text-center">{{ "referent" }}</td>
          @endcan
          <td class="align-middle text-center">{{ "status" }}</td>
          <td class="align-middle text-center">{{ "action" }}</td>
          @endcanany
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
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
    $('#adminTable').DataTable({
      language: {
              url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
      }
    });
  });
</script>
@endpush