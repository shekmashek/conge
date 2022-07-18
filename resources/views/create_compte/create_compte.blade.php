<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conge.mg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/create_compte_client.css')}}">
</head>

<body>

    <div class="container">
        <div class="row">
            <form action="{{route('create-compte')}}" id="msform_facture" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="contenue">
                    <h3 class="">Crée votre compte</h3>
                    <h5 class="mt-3"><i class="fa-solid fa-user-tie"></i>&nbsp;&nbsp;A propos de vous,responsable de
                        ressource humaine:</h5>
                    <div class="formulaire mt-3" style="display: flex">
                        <div class="form ">
                            <input name="matricule_resp_etp" id="matricule_resp_etp" type="text" autocomplete="off"
                                required>
                            <label for="matricule_resp_etp">Matricule</label>
                            @error('matricule_resp_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror

                        </div>
                        <div class="form " style="margin-left: 20px;">
                            <input name="nom_resp_etp" autocomplete="off" type="text" id="nom_resp_etp" required>
                            <label for="nom_resp_etp">Noms</label>
                            @error('nom_resp_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="nom_resp_etp_err"></span>
                        </div>
                    </div>
                    <div class="formulaire mt-3" style="display: flex">
                        <div class="form ">
                            <input name="prenom_resp_etp" id="prenom_resp_etp" type="text" autocomplete="off" required>
                            <label for="prenom_resp_etp">Prenoms</label>
                            @error('prenom_resp_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                        <div class="form " style="margin-left: 20px;">
                            <input name="cin_resp_etp" autocomplete="off" type="text" id="cin_resp_etp" required>
                            <label for="cin_resp_etp">CIN</label>
                            @error('cin_resp_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="cin_resp_etp_err"></span>
                        </div>
                    </div>

                    <div class="formulaire">
                        <div class="form mt-4" style="width:520px;">
                            <input name="email_resp_etp" autocomplete="off" id="email_resp_etp" type="text" required>
                            <label for="email_resp_etp">Email Responsable</label>
                            @error('email_resp_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="email_resp_etp_err"> </span>
                        </div>
                    </div>
                    <div class="img">
                        <img src="{{asset('images/create.png')}} " style="width:400px;height:400px; alt="">
                    </div>
                    <h5 class=" mt-4"><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;A propos de votre entreprise :
                        </h5>
                        <div class="formulaire mt-3" style="display: flex">
                            <div class="form ">
                                <input type="text" name="name_etp" id="name_etp" autocomplete="off" required>
                                <label for="name_etp">Raison sociale</label>
                                @error('name_etp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="name_etp_err"></span>
                            </div>
                            <div class="form " style="margin-left: 20px;">
                                <input name="nif" id="nif_etp" type="text" autocomplete="off" required>
                                <label for="nif_etp">Nif</label>
                                @error('nif')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000; font-size: 0.8rem" id="nif_etp_err"> </span>
                            </div>

                        </div>
                        <div class="formulaire">
                            <div class="form mt-4" style="width:520px;">
                                <select class="form-select" aria-label="Default select example" name="secteur_id"
                                    required id="secteur_id">
                                    @foreach ($secteurs as $secteur)
                                    <option value="{{$secteur->id}}">{{$secteur->nom_secteur}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulaire">
                            <label for="" class="mt-2"
                                style="font-size:18px;color:gray;font-weight: lighter;">Logo</label>
                            <div class="form " style="width:520px;">
                                <input type="file" name="logo_etp" id="logo_etp" class="form-control" autocomplete="off"
                                    style="height: 30px" required>
                            </div>
                            @error('logo_etp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <p id="error_logo_etp" style="color:#ff0000; font-size: 0.8rem"></p>
                        </div>

                        <div class="formulaire text-center mt-3" style="display: flex;">
                            <input name="value_confident" required class="form-check-input align-middle" type="checkbox"
                                value="1" id=""> &nbsp;<p class="align-middle"><a
                                    href="{{route('condition_generale_de_vente')}}"
                                    target="_blank"
                                    class="nav-item lien_confidentiel" style="font-size: 14px">J'ai lu et accepter les
                                    termes de confidentiels du plateforme</a></p>
                        </div>
                        <div class="formulaire">
                            <div class="formulaire text-center" style="display: flex;">
                                <h5 style="font-size: 18px;margin-left:15%">Je ne suis pas un robot🙈</h5>
                            </div>
                            <div class="test">
                                <p style="font-size: 16px;margin-left:20%">16 + <input type="text" name="val_robot"
                                        placeholder="?" style="width: 40px;text-align:center" required> = 27</p>
                                <a href="/" class="btn btn"
                                    style="text-decoration: none;color:white;background: #0a0a08;margin-left:0%;"><i
                                        class="fa-solid fa-circle-chevron-left align-middle"></i> &nbsp;Retour</a>
                                </button>
                                <button type="submit" id="suivant_of_confirmer" class="btn text-light mt-3"
                                    style="background: #7367f0;margin-left:35%;">Confirmer</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"
        integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('change', '#name_entreprise', function() {
        var id = $(this).val();
        document.getElementById('name_entreprise_desc').innerHTML = id;
        console.log(document.getElementById('name_entreprise_desc').value);
    });

    /*-------------------------------------------------------------------------------------
        reprendre fonctions js dans create_compte_client.blade.php
    */
    </script>
</body>

</html>
