<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ \App\Models\Utility::settingdata('name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu ">
            <li class="menu-header">{{__('Home')}}</li>
            <li class="nav-item {{ \Request::route()->getname() == 'home' ? 'active' : '' }} ">
                <a href="{{ route('home') }}" class="nav-link "><i class="fas fa-solid fa-fire-flame-curved  "></i><span>{{__('Dashboard')}}</span></a>
            </li>
            @can('user-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'user.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-solid fa-user-group "></i> <span>{{__('User')}}</span></a></li>
            @endcan

            <li class="nav-item d-none {{ \Request::route()->getname() == 'permission.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('permission.index')}}"><i class="fas fa-brands fa-product-hunt "></i> <span>{{__('Permission')}}</span></a></li>
            @can('role-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'role.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('role.index') }}"><i class="fas fa-solid fa-users-gear "></i> <span>{{__('Role')}}</span></a></li>
            @endcan

            @can('contact-manage')
                <li class="menu-header">{{__('Additional')}}</li>
                <li class="nav-item {{ \Request::route()->getname() == 'contact.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('contact.index') }}"><i class="fas fa-solid fa-phone "></i> <span>{{__('Contacts')}}</span></a></li>
            @endcan
            @can('support-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'support.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('support.index')}}"><i class="fas fa-solid fa-headphones-simple "></i> <span>{{__('Supports')}}</span></a></li>
            @endcan
            @can('note-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'note.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('note.index') }}"><i class="fas fa-solid fa-file "></i> <span>{{__('Notes')}}</span></a></li>
            @endcan

            @can('plan-manage')
                <li class="menu-header">{{__('Plans')}}</li>

                <li class="nav-item {{ \Request::route()->getname() == 'plan.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('plan.index') }}"> <i class="fas fa-brands fa-product-hunt "></i><span>{{__('Plan')}}</span></a></li>
            @endcan
            @can('coupon-manage')
                <li class="menu-header">{{__('Coupons')}}</li>
                <li class="nav-item {{ \Request::route()->getname() == 'coupon.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('coupon.index') }}"> <i class="fas fa-solid fa-gift"></i><span>{{__('Coupon')}}</span></a></li>
            @endcan

            <li class="menu-header">{{__('Setting')}}</li>

            @can('account-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'account_index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('account_index') }}"> <i class="fas fa-solid fa-user "></i><span>{{__('Account')}}</span></a></li>
            @endcan
            @can('password-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'password_index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('password_index') }}"> <i class="fas fa-solid fa-lock "></i><span>{{__('Password')}}</span></a></li>
            @endcan
            @can('general-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'general_index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('general_index') }}"> <i class="fas fa-solid fa-gear fa-spin fa-spin-reverse"></i><span>{{__('General')}}</span></a></li>
            @endcan
            @can('company-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'company_index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('company_index') }}"> <i class="fas fa-solid fa-wrench "></i><span>{{__('Company')}}</span></a></li>
            @endcan
            @can('email-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'email_index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('email_index') }}"> <i class="fas fa-solid fa-envelope "></i><span>{{__('Email')}}</span></a></li>
            @endcan
            @can('payment-manage')
                <li class="nav-item {{ \Request::route()->getname() == 'payment_setting' ? 'active' : '' }} "><a class="nav-link" href="{{ route('payment_setting') }}"> <i class="fas fa-solid fa-trophy "></i><span>{{__('Payment')}}</span></a></li>
            @endcan

{{--            <li class="nav-item {{ \Request::route()->getname() == 'language.index' ? 'active' : '' }} "><a class="nav-link" href="{{ route('language.index')}}"> <i class="fas fa-solid fa-globe"></i><span>{{__('Language')}}</span></a></li>--}}

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>




