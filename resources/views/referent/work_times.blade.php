@extends('layouts.app')

@section('content')
<div class="container">

    {{------------------------------------------------------------------- heure de travail ------------------------------------------------------------------------------ --}}
@forelse ($heureTravail as $hT)
    <div class="d-flex">


            <form action="{{ route('updateTime') }}" method="POST">
                @csrf
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>{{ $hT->designation }}</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" value="{{ $hT->id }}" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_debut" name="debut"  required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_fin" name="fin"  required>
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
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de pause </h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut_pause" name="debut"  required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin_pause" name="fin"  required>
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
