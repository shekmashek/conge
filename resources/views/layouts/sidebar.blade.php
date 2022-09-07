
<div class="d-flex flex-column flex-shrink-0 bg-light mt-5" style="width: 4.5rem;">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">


        @can('isReferent')
        {{-- ----------------referent home---------------- --}}
        <li class="nav-item">
            <a href="{{ route('home_referent') }}" class="nav-link
            @if (Route::currentRouteName() == 'home_referent')
            active

            @endif
            py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-calendar-minus fs-3'></i>
        </a>
    </li>
    {{-- -------------------referent edit work times------------------- --}}
        <li>
        <a href="{{ route('edit_work_times') }}" class="
        @if (Route::currentRouteName() == 'edit_work_times')
            active

        @endif
        nav-link py-3 border-bottom" title="Seetings" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-calendar-plus fs-3'></i>
        </a>
        </li>
      @endcan


      @can('isRH')
      {{-- -------------------side bar RH home------------------- --}}
        <li class="nav-item">
            <a href="{{ route('home_RH') }}" class="nav-link
            @if (Route::currentRouteName() == 'home_RH')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class='bx bx-calendar-minus fs-3'></i>
            </a>
        </li>
        {{-- --------------------side bar liste employés--------------------------- --}}
        <li class="nav-item">
            <a href="{{ route('liste_employes') }}" class="nav-link
            @if (Route::currentRouteName() == 'liste_employes')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="Liste employés" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class='bx bxs-user' style="font-size: x-large;"></i>
            </a>
        </li>

        @endcan

    </ul>

</div>


