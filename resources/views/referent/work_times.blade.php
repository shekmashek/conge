@extends('layouts.app')

@section('content')
<div class="container">

    {{------------------------------------------------------------------- heure de travail ------------------------------------------------------------------------------ --}}
@forelse ($heureTravail as $hT)
    <div class="d-flex">


            <form action="{{ route('updateTime') }}" method="POST">
                @csrf
                @method('PUT')
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>{{ $hT->designation }}</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="id" value="{{ $hT->id }}">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_debut" name="heure_debut" value="{{ $hT->heure_debut }}" required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_fin" name="heure_fin" value="{{ $hT->heure_fin }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" id="btn_def_jour" class="btn btn-primary " name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

{{------------------------------------------------------------------- heure de pause ------------------------------------------------------------------------------ --}}

            <form action="{{ route('updateTime') }}" method="POST">
                @csrf
                @method('PUT')
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de pause </h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <input type="hidden" value="{{ $hT->id }}" name="id">
                                <label for="debut_pause" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut_pause" name="debut_pause" value="{{ $hT->debut_pause }}" required>
                                </div>
                                <label for="fin_pause" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin_pause" name="fin_pause" value="{{ $hT->fin_pause }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" id="btn_def_jour_pause" class="btn btn-primary" name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

</div>
@empty
aucune heure définie
@endforelse


</div>
@endsection
