
<div class="container">
<div class="row mt-3">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div style="border-radius: 1px">

            {{-- @if ( session()->has('message'))
            <h4 style="background-color:green;color:white; width">
                {{ session()->get('message') }}
            </h4>    
            @endif --}}
            
            <form action="{{ route('admin.home.create') }}" id="formInsert" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">
                    <div class="col-md-4 text-end">
                        <label class="mt-2">Matricule <strong style="color:#ff0000;">*</strong></label>    
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="matricule" id="matricule"  placeholder="maricule" 
                            autocomplete="off" class="form-control form-control-sm input w-50" id="matricule">
                            @if ($errors->has('matricule'))
                                <span style="color: #ff0000">Veuillez remplir le champ</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4 text-end">
                        <label for="nom" class="mt-2">Nom <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="nom" autocomplete="off" id="nom"
                             placeholder="Nom" class="form-control form-control-sm input">
                             @if ($errors->has('nom'))
                                <span style="color: #ff0000">Veuillez remplir le champ</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4 text-end">
                        <label for="prenom" class="mt-2">Prénom <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="prenom"  autocomplete="off" id="prenom"
                             placeholder="Prénom" class="form-control form-control-sm input">
                        
                            @if ($errors->has('prenom'))
                             <span style="color: #ff0000">Veuillez remplir le champ</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4 text-end">
                        <label for="cin" class="mt-2">CIN <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="cin" autocomplete="off" id="cin"
                             placeholder="Carte d'Identité Nationale" class="form-control form-control-sm input">
                            
                            @if ($errors->has('cin'))
                                <span style="color:#ff0000">Veuillez remplir le champ correctement (12 chiffres minimum)</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4 text-end">
                        <label for="phone" class="mt-2">Téléphone <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="phone" min="6" autocomplete="off" id="phone"
                             placeholder="Téléphone" class="form-control form-control-sm input">
                             @if ($errors->has('phone'))
                                <span style="color: #ff0000;">Veuillez remplir le champ correctement (8 chiffres minimum)</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4 text-end">
                        <label for="mail" class="mt-2">Email <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="email" name="email"  autocomplete="off" id="email"
                             placeholder="E-mail" class="form-control form-control-sm input">
                            @if ($errors->has('email'))
                                <span style="color: #ff0000">Veuillez entrer un email valide</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-1 fonctions_cacher">

                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="hidden" name="selecteur_id" value="8">
                        </div>
                    </div>
                </div>
                <div class="row mt-1 affiche">
                    <div class="col-md-4 text-end">
                        <label for="fonction" class="mt-2">Fonction <strong style="color:#ff0000;">*</strong></label>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="nom_fonction"  autocomplete="off" id="nom_fonction"
                             placeholder="Responsable des Ressources Humaines" class="form-control form-control-sm input">
                            @if ($errors->has('nom_fonction'))
                                <span style="color: #ff0000">Veuillez remplir le champ</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3 affiche">
                    <div class="col-md-4 text-end"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-sm btn-primary" id="saver_stg">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>