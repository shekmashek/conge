{{-- <a class="dropdown-toggle p-1" id="dropdownMenuProfil" data-bs-toggle="dropdown" aria-expanded="false"
    aria-haspopup="true"><i class='bx bx-user-circle icon_creer_admin'></i></a> --}}
{{-- <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuProfil"> --}}
    <div class="card card_profile pt-3 border-0">
        <div class="">
            <div class="card-title">
                <div class="row px-3 mt-2 mb-2 align-items-center">
                    <div class="col-7">
                        <span class="titre_card_profil"><img src="{{ asset('img/logos_all/iconConge.webp') }}"
                                alt="logo_mini" title="logo conges.mg" width="30px" height="30px">Conges.mg</span>
                    </div>
                    <div class="col-5 text-center">
                        <div class="logout">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class=" text-center">@lang('translation.SeDéconnecter')</a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="row ps-4 align-items-center">
                    <div class="col-2 ps-4">
                        <span>
                            <div style="display: grid; place-content: center">
                                <div class='randomColor photo_users'
                                    style="background: purple; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="col-10 ps-4">
                        <h6 class="mb-0 ">{{Auth::user()->name}}</h6>
                        <h6 class="mb-0 text-muted text_mail">{{Auth::user()->email}}</h6>
                    </div>
                </div>
                <div class="row role_liste mt-2 g-0 p-3">
                    <div class="col-12">
                        <div class="row algn-items-center">
                            <div class="col">
                                <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                                <span class="text-muted p-0 small-font">@lang('translation.ConnéctéEnTantQue') :</span>
                            </div>
                            <div class="col p-0">
                                @if (count(Auth::user()->roles) == 1 && Auth::user()->roles[0]->id == 33)
                                <div>Employé</div>
                                @else
                                <div class="dropdown fit-content">
                                    <button class="form-control dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        @foreach (Auth::user()->roles as $role)
                                        @if ($role->pivot->activiter == 1)
                                        {{$role->role_description }}
                                        @endif
                                        @endforeach
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach (Auth::user()->roles as $role)
                                        <form action="{{ route('role.update', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @if ($role->pivot->activiter !== 1)
                                            <input type="number" name="role_id" value="{{ $role->id }}" hidden>
                                            <li><button type="submit" class="dropdown-item" href="">{{$role->role_description }}</button></li>
                                            @endif
                                        </form>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="d-flex flex-row py-0 justify-content-center">
                                <a href="{{url('politique_confidentialite')}}" target="_blank">
                                    <p class="m-0 small-font">@lang('translation.PolitiqueDeConfidentialité')</p>
                                </a>
                                &nbsp;-&nbsp;
                                <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                    <p class="m-0 small-font">@lang('translation.ConditionsDUtilisation')</p>
                                </a>
                            </div>
                            <div class="d-flex flex-row py-0 justify-content-center">
                                <a href="{{url('contacts')}}" target="_blank">
                                    <p class="m-0 small-font">@lang('translation.Contactez-nous')</p>
                                </a>
                                &nbsp;-&nbsp;
                                <a href="{{url('info_legale')}}" target="_blank">
                                    <p class="m-0 small-font">@lang('translation.InformationLégales')</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
</div> --}}