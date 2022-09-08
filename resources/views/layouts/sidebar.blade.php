
<div class="d-flex flex-column flex-shrink-0 bg-transparent mt-5" style="width: 4.5rem;">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center ms-1">

        @canany(['isManager','isReferent'])
        <li class="nav-item mb-1">


            <a href="{{ route('home_manager') }}" class="nav-link rounded-3
            @if (Route::currentRouteName() == 'home_manager')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="Gérer les congés" data-bs-toggle="tooltip" data-bs-placement="right">

                <i class='bx bx-calendar-minus fs-3'></i>
            </a>
          </li>


          <li class="nav-item mb-1">


            <a href="{{ route('manager.liste_employes') }}" class="nav-link rounded-3
            @if (Route::currentRouteName() == 'manager.liste_employes')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="Gérer l'équipe" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bx-group fs-3'></i>
            </a>
          </li>


        @endcan


        @can('isManager')
        {{-- les graphes statistiques : un référent peut voir toutes les stats de l'entreprise --}}
        {{-- Un manager ne verra que celui concernant son service --}}
        <li class="nav-item mb-1">


          <a href="{{ route('stats_conges_manager') }}" class="nav-link rounded-3
          @if (Route::currentRouteName() == 'stats_conges_manager')
              active

          @endif
          py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

              <i class='bx bxs-bar-chart-square fs-3'></i>
          </a>
        </li>
      @endcan

      @can('isReferent')

      <li class="nav-item mb-1">

        <a href="{{ route('home_referent') }}" class="nav-link rounded-3
        @if (Route::currentRouteName() == 'home_referent')
            active

        @endif
        py-3 border-bottom" aria-current="page"  data-bs-toggle="tooltip" data-bs-placement="right">

        <i class='bx bx-calendar-star fs-3' ></i>
        </a>
      </li>

        <li class="nav-item mb-1">
        <a href="{{ route('edit_work_times') }}" class=" rounded-3
        {{-- @if (Route::currentRouteName() == 'edit_work_times') --}}
            {{-- active --}}

            {{-- @endif --}}
        nav-link py-3 border-bottom" title="Seetings" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-wrench fs-3'></i>
        </a>
        </li>

            {{-- les graphes statistiques : un référent peut voir toutes les stats de l'entreprise --}}
            {{-- Un manager ne verra que celui concernant son service --}}
        <li class="nav-item mb-1">
            <a href="#" class="nav-link rounded-3
            @if (Route::currentRouteName() == 'liste_employes')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bxs-bar-chart-square fs-3'></i>
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


