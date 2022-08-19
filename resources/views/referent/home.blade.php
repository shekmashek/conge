@extends('layouts.app')

@push('extra-links')

        {{-- bootstrap Year calendar css --}}
        <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
@endpush

@push('extra-scripts')

        {{-- bootstrap Year calendar js --}}
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

@endpush

@section('title', 'Accueil referent')

@section('content')
<div class="container">


    <!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 border-0" id="ex1" role="tablist">


    <li class="nav-item mx-2" role="presentation">
        <a class="nav-link active"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#ex1-tabs-1"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true">
            heure de travail
        </a>
    </li>
</ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">

    <div class="tab-pane fade show active" id="tab_liste_attente" role="tabpanel" aria-labelledby="tab_liste_attente">

        reférent connécté

        {{-- @include('rh.liste_conge') --}}
        {{-- @include('referent.work_times') --}}
    </div>

  </div>
  <!-- Tabs content -->




</div>

@endsection
