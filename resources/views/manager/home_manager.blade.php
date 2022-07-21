@extends('layouts.app')

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
            Toutes les demandes
        </a>
    </li>
    <li class="nav-item mx-2 position-relative" role="presentation">
      <a    class="nav-link"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            data-bs-toggle="tab"
            href="#tab_liste_attente"
            role="tab"
            aria-controls="tab_liste_attente"
            aria-selected="false">

    Demandes en attentes
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        20
        <span class="visually-hidden">{{ __('en attente') }}</span>
    </span>


    </a>
    </li>
        <li class="nav-item mx-2 position-absolute end-0" role="presentation">
            <a href="{{ route('calendrier_conge') }} " class="d-flex nav-link align-items-center">
                <i class='bx bxs-calendar-check fs-2' ></i>
                <span>
                    Calendrier
                </span>
            </a>
        </li>
  </ul>
  <!-- Tabs navs -->



    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ Auth::user()->roles->pluck('id') }}
                        <h2>MANAGER</h2>

                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>

      <!-- Tabs content -->
  <div class="tab-content" id="ex1-content">
    <div
      class="tab-pane fade show active"
      id="ex1-tabs-1"
      role="tabpanel"
      aria-labelledby="ex1-tab-1">

        @include('manager.liste_conge')

    </div>

    <div class="tab-pane fade" id="tab_liste_attente" role="tabpanel" aria-labelledby="tab_liste_attente">
        @include('manager.liste_en_attente')
    </div>

  </div>
  <!-- Tabs content -->




</div>

@endsection
