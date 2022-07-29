@extends('manager.fullCalendar.createEventModal')
@section('jours')
<div class="form-group">
    <label><b>Heure du debut</b></label>
    <input type="datetime-local" name="dateDebut" />
</div>
<br>

<div class="form-group">
    <label><b>Heure de fin</b></label>
    <input type="datetime-local" name="dateFin" />
</div>
@endsection
