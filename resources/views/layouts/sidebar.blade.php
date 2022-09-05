
<div class="d-flex flex-column flex-shrink-0 bg-transparent mt-5" style="width: 4.5rem;">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center ms-1">

        @can('inManager')
          {{-- les graphes statistiques : un référent peut voir toutes les stats de l'entreprise --}}
          {{-- Un manager ne verra que celui concernant son service --}}
          <li class="nav-item mb-1">


            <a href="{{ route('manager.stats') }}" class="nav-link rounded-3
            @if (Route::currentRouteName() == 'manager.liste_employes')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bxs-bar-chart-square fs-3'></i>
            </a>
          </li>
        @endcan

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
        @if (Route::currentRouteName() == 'edit_work_times')
            active

        @endif
        nav-link py-3 border-bottom" title="Seetings" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-wrench fs-3'></i>
        </a>
        </li>

            {{-- les graphes statistiques : un référent peut voir toutes les stats de l'entreprise --}}
            {{-- Un manager ne verra que celui concernant son service --}}
        <li class="nav-item mb-1">
            <a href="{{ route('referent.stats') }}" class="nav-link rounded-3
            @if (Route::currentRouteName() == 'manager.liste_employes')
                active

            @endif
            py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right">

            <i class='bx bxs-bar-chart-square fs-3'></i>
            </a>
        </li>

      @endcan

    </ul>

</div>
