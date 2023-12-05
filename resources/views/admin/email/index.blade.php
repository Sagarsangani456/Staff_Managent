@extends('admin.Layout.admin')
@section('title','Email Setting')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Email Setting')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('email_index') }}">{{__('Email Setting')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route'=>'email_store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Driver'))}}
                                    {{Form::text('email_server_driver',\App\Models\Utility::settingdata('email_server_driver') ,array('class'=>'form-control','placeholder'=>'Enter Your Email Server Driver'))}}
                                    @error('email_server_driver')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Host'))}}
                                    {{Form::text('email_server_host', \App\Models\Utility::settingdata('email_server_host'),array('class'=>'form-control','placeholder'=>'Enter Your Email Server Host'))}}
                                    @error('email_server_host')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Port'))}}
                                    {{Form::text('email_server_port',\App\Models\Utility::settingdata('email_server_port'),array('class'=>'form-control','placeholder'=>'Enter Your Email Server Port'))}}
                                    @error('email_server_port')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Username'))}}
                                    {{Form::textarea('email_serveru_sername',\App\Models\Utility::settingdata('email_serveru_sername'),array('class'=>'form-control','placeholder'=>'Enter Your Email Server Username'))}}
                                    @error('email_serveru_sername')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Password'))}}
                                    {{Form::text('email_server_password',\App\Models\Utility::settingdata('email_server_password'),array('class'=>'form-control','placeholder'=>'Enter Your Email Server Password'))}}
                                    @error('email_server_password')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Email Server Encryption'))}}
                                    {{Form::text('email_server_encryption',\App\Models\Utility::settingdata('email_server_encryption'),array('class'=>'form-control','placeholder'=>'Enter Your Email Server Encryption'))}}
                                    @error('email_server_encryption')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('From Email'))}}
                                    {{Form::text('from_email',\App\Models\Utility::settingdata('from_email'),array('class'=>'form-control','placeholder'=>'Enter Your From Email'))}}
                                    @error('from_email')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('From Name'))}}
                                    {{Form::text('from_name',\App\Models\Utility::settingdata('from_name'),array('class'=>'form-control','placeholder'=>'Enter Your From Name'))}}
                                    @error('from_name')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="text-left col-md-12 mt-4">
                                    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
