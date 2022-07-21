<?php
// var_dump($motif_conges[0]['nom_motif']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Conge</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" />
    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>



    <!-- Icons font CSS-->

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">


    <!-- Vendor CSS-->
    <link href="css/select2/select2.min.css" rel="stylesheet" media="all">


    <!-- Main CSS-->
    <link href="css/styleConge.css" rel="stylesheet" media="all">
</head>

<body>

    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Demande de conge</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('insererConge') }}" method="post" accept-charset="UTF-8">
                        @csrf
                        <div class="form-row">
                            <div class="name">Date debut</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="DateDebut">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Date fin</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="DateFin">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Motif</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select class="form-select" aria-label="Default select example" name="motif">
                                            <option selected>...</option>
                                            @foreach ($motif_conges as $motif_conge)
                                                <option value={{ $motif_conge['id'] }}>
                                                    {{ $motif_conge['nom_motif'] }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row m-b-55">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="row row-refine">

                                    <div class="col-9">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                                name="description"></textarea>
                                            <label for="floatingTextarea2">Commentaires</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Modal -->
                         <div class="modal fade" id="staticBackdrop" role="document"
                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                     <button type="button" class="btn-close" data-dismiss="modal"
                                         aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     ...
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary"
                                         data-dismiss="modal">Close</button>
                                     <button type="button" class="btn btn-primary">Understood</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                       <!-- end Modal -->
                       <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#staticBackdrop">Heure</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#staticBackdrop">Demi-journe</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#staticBackdrop">Jours</button>
                    </div>

                    <br>
                        <br>
                        <div>
                            <button class="btn btn-success" type="submit">Envoyer</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
