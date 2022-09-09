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
<div class="container">


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">
        </li>
    <li class="nav-item mx-2 position-relative" role="presentation">
      <a    class="nav-link active"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#tab_liste_employes"
            role="tab"
            aria-controls="tab_liste_employes"
            aria-selected="false">

    Listes des employés

    </a>
    </li>
    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link "
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            Ajouter employés
        </a>
    </li>

  </ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active"
         id="tab_liste_employes" role="tabpanel"
         aria-labelledby="tab_liste_employes">
            @include('rh.liste_employes') <!-- include liste en attente -->
        </div>

        <div
        class="tab-pane fade"
        id="ex1-tabs-1"
        role="tabpanel"
        aria-labelledby="ex1-tab-1">
            @include('rh.ajouter_employes') <!-- include liste employés -->
        </div>
  </div>
  <!-- Tabs content -->




</div>

@endsection
