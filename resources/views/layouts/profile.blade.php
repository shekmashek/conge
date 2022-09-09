{{-- <a class="dropdown-toggle p-1" id="dropdownMenuProfil" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-user-circle icon_creer_admin'></i></a> --}}
{{-- <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuProfil"> --}}
    <div class="card card_profile pt-3">
        <div class="card-title">
            <div class="row px-3 mt-2">
                <div class="col-7">
                    <span class="titre_card_profil"><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="logo_mini" title="logo formation.mg" width="30px" height="30px">Formation.mg</span>
                </div>
                <div class="col-5 text-center">
                    <div class="logout">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" text-center">@lang('translation.SeDéconnecter')</a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row ps-4">
                <div class="col-2 ps-4">
                    <span>
                        <div style="display: grid; place-content: center">
                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                            </div>
                        </div>
                    </span>
                </div>
                <div class="col-10 ps-4">
                    <h6 class="mb-0 ">{{Auth::user()->name}}</h6>
                    <h6 class="mb-0 text-muted text_mail">{{Auth::user()->email}}</h6>
                    <p id="nom_etp" class="mt-2"></p>
                </div>
            </div>
            <div class="row role_liste mt-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                            <span class="text-muted p-0 test_font">@lang('translation.ConnéctéEnTantQue') :</span>
                        </div>
                        <div class="col p-0">
                            <select name="" id="liste_role" class="form-control" style="height: 30px;font-size:12px;width:150px;margin-left:-20px;margin-top:-03px;">

                            </select>
                            {{-- <ul id="liste_role" class="d-flex flex-column"></ul> --}}
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row mt-5">
                        <div class="d-flex flex-row py-0 justify-content-center">
                            <a href="{{url('politique_confidentialite')}}" target="_blank">
                                <p class="m-0 test_font2">@lang('translation.PolitiqueDeConfidentialité')</p>
                            </a>
                            &nbsp;-&nbsp;
                            <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                <p class="m-0 test_font2">@lang('translation.ConditionsDUtilisation')</p>
                            </a>
                        </div>
                        <div class="d-flex flex-row py-0 justify-content-center">
                            <a href="{{url('contacts')}}" target="_blank">
                                <p class="m-0 test_font2">@lang('translation.Contactez-nous')</p>
                            </a>
                            &nbsp;-&nbsp;
                            <a href="{{url('info_legale')}}" target="_blank">
                                <p class="m-0 test_font2">@lang('translation.InformationLégales')</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
{{-- </div> --}}
