
<div class="d-flex flex-column flex-shrink-0 bg-light mt-5" style="width: 4.5rem;">

    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
      <li class="nav-item">
        <a href="{{ route('home_referent') }}" class="nav-link
        @if (Route::currentRouteName() == 'home_referent')
            active

        @endif
        py-3 border-bottom" aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
            <i class='bx bx-calendar-minus fs-3'></i>
        </a>
      </li>

      @can('isReferent')
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

    </ul>

</div>
