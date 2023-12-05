@extends('admin.Layout.admin')
@section('title','Account Setting')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Account Setting')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('account_index') }}">{{__('Account Setting')}}</a></div>
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
                                        <img src="{{ asset('image/'.$account_user->image) }}" alt="" width="100px" height="100px" class="user_profile">
                                    </div>
                                    <div class="user-detail mt-5">
                                        <h3 class="text-center mt-1 text-dark">{{ $account_user->name }}</h3>
                                        <h6 class="text-center mt-1">
                                            @if(!empty($account_user->getRoleNames()))
                                                @foreach($account_user->getRoleNames() as $value)
                                                    <span>{{$value}}</span>
                                                @endforeach
                                            @endif</h6>
                                        <h6 class="text-center mt-1">{{$account_user->email}}</h6>
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
                                {!! Form::model($account_user,['route'=>['account_update',$account_user->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                                @csrf

                                <div class="form-group">
                                    {{Form::label('name',__('Name'))}}
                                    {{Form::text('name',$account_user->name,array('class'=>'form-control','placeholder'=>'Enter Your Name'))}}
                                    @error('name')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('name',__('Email'))}}
                                    {{Form::text('email',$account_user->email,array('class'=>'form-control','placeholder'=>'Enter Your Email'))}}
                                    @error('email')
                                    <span class="invalid-name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{Form::label('name',__('Profile'))}}
                                    {{Form::file('image',array('class'=>'form-control'))}}
                                    @error('image')
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
