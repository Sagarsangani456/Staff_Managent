<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

    </form>


    <ul class="navbar-nav navbar-right">


        <div class="dropdown">

            <button class="btn  btn-outline-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-earth-americas mr-2"></i>Language
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                @foreach(\App\Models\Language::all() as $language_list)
                    <li><a class="dropdown-item fontsize" href="{{ route('change_language',$language_list->language_code) }}">{{ $language_list->language_name }}</a></li>
                @endforeach
                @if(\Illuminate\Support\Facades\Auth::user()->type == 'super admin')
                    <div class="border-bottom"></div>
                    <div class="mt-2 ml-4">
                        <a href="#" data-size="md" data-url="{{ route('language.create') }}" data-ajax-popup="true" data-title="{{__('Create Language')}}" class="fontsize">
                            {{ __('Create Language') }}
                        </a>
                    </div>
                    <div class="mt-2 ml-4">
                        <a href="{{ route('language.index') }}" class="fontsize">{{ __('Manage Language') }}</a>
                    </div>
                @endif
            </div>
        </div>


        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{asset('image/'.Auth::user()->image)}}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('account_index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{__('Profile')}}
                </a>
                <a href="{{ route('general_index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-solid fa-gear fa-spin fa-spin-reverse"></i> {{__('Settings')}}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt ml-2 mr-2"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>

