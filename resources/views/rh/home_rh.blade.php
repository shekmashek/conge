@extends('layouts.app')

@push('extra-links')

        {{-- bootstrap Year calendar css --}}
        <link rel="stylesheet" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css">
@endpush

@push('extra-scripts')

        {{-- bootstrap Year calendar js --}}
        <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>

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
            href="#tab_liste_attente"
            role="tab"
            aria-controls="tab_liste_attente"
            aria-selected="false">

    Demandes en attentes

    @if ($nbr_en_attente > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $nbr_en_attente }}
            <span class="visually-hidden">{{ __('en attente') }}</span>
        </span>
    @endif


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
            Historique
        </a>

        <li class="nav-item mx-2 position-absolute end-0" role="presentation">
            <a href="{{ route('rh.calendrier') }} " class="d-flex nav-link align-items-center">
                <i class='bx bxs-calendar-check fs-2' ></i>
                <span>
                    Calendrier
                </span>
            </a>
        </li>
  </ul>


      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
    <div
      class="tab-pane fade"
      id="ex1-tabs-1"
      role="tabpanel"
      aria-labelledby="ex1-tab-1">

        @include('rh.liste_conge') <!-- include historique -->


    </div>

    <div class="tab-pane fade show active" id="tab_liste_attente" role="tabpanel" aria-labelledby="tab_liste_attente">

        @include('rh.liste_en_attente') <!-- include liste en attente -->
    </div>

  </div>
  <!-- Tabs content -->




</div>

@endsection
