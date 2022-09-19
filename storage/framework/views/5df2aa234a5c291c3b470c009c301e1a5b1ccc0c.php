<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    

                <br>

                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de Jour</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut" name="debut"  required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin" name="fin"  required>
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnDef" class="btn btn-primary" name="search" title="Search">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  <br>
                <div class ="container">
                    <label class="d-flex justify-content-center"><h3>Heure de Nuit</h3></label>
                    <div class = "row">
                        <div class = "container-fluid">
                            <div class="form-group row">
                                <input type="hidden" name="time_id">
                                <label for="date_debut" class="col-form-label col-sm-2">heure de début</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="debut" name="debut" placeholder="Date de début" required>
                                </div>
                                <label for="date_fin" class="col-form-label col-sm-2">heure de fin</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control input-sm" id="fin" name="fin"  placeholder="Date de fin" required>
                                </div>
                                <div class="col-sm-2">
                                    <button id="btnDef" class="btn btn-primary" name="search" title="Search">definir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


</body>
</html>
<?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/referent/liste.blade.php ENDPATH**/ ?>