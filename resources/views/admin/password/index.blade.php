@extends('admin.Layout.admin')
@section('title','Password Setting')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Password Setting')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('password_index') }}">{{__('Password Setting')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 cdx-xxl-30 cdx-xl-40">
                    <div class="row">
                        <div class="col-xl-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-image">
                                        <img src="{{ asset('image/'.$user->image) }}" alt="" width="100px" height="100px" class="user_profile">
                                    </div>
                                    <div class="user-detail mt-5">
                                        <h3 class="text-center mt-1 text-dark">{{ $user->name }}</h3>
                                        <h6 class="text-center mt-1">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $value)
                                                    <span>{{$value}}</span>
                                                @endforeach
                                            @endif</h6>
                                        <h6 class="text-center mt-1">{{$user->email}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 cdx-xxl-70 cdx-xl-60">
                    <div class="card">
                        <div class="card-body">
                            <div class="info-group">
                                {!! Form::open(['route'=>'change_password','method'=>'POST']) !!}
                                @csrf

                                <div class="form-group">
                                    {{Form::label('name',__('Current Password'))}}
                                    {{Form::password('current_password',array('class'=>'form-control','placeholder'=>'Enter Your Current Password'))}}
                                    @error('current_password')
                                    <span class="invalid-name" role="alert">
                                         <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('name',__('New Password'))}}
                                    {{Form::password('new_password',array('class'=>'form-control','placeholder'=>'Enter Your New Password'))}}
                                    @error('new_password')
                                    <span class="invalid-name" role="alert">
                                         <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('name',__('Confirm New Password'))}}
                                    {{Form::password('new_password_confirmation',array('class'=>'form-control','placeholder'=>'Enter Your Confirm New Password'))}}
                                    @error('new_password')
                                    <span class="invalid-name" role="alert">
                                         <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>

                                <div class="text-left">
                                    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
