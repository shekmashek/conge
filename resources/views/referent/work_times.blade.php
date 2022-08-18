@extends('layouts.app')

@section('content')
<div class="container">

    {{------------------------------------------------------------------- Jours ------------------------------------------------------------------------------ --}}
<div class="d-flex">
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de Jour</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_debut" name="debut"  required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="heure_fin" name="fin"  required>
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnDef" class="btn btn-primary" name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
                                    <button id="btnDef" class="btn btn-primary" name="set_time" title="Set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</div>
 <br>

{{------------------------------------------------------------------- separateur ------------------------------------------------------------------------------ --}}

<div>
    <hr>
</div>


{{------------------------------------------------------------------- nuit ------------------------------------------------------------------------------ --}}

<br>

<div class="d-flex">
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de Nuit</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut" name="heure_debut" placeholder="Date de début" required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin" name="heure_fin"  placeholder="Date de fin" required>
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnDef" class="btn btn-primary" name="set_time" title="set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de pause </h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut" name="debut_pause" placeholder="Date de début" required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin" name="fin_pause"  placeholder="Date de fin" required>
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnDef" class="btn btn-primary" name="set_time" title="set_time">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</div>

</div>
@endsection
