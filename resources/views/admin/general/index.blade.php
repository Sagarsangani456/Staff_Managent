@extends('admin.Layout.admin')
@section('title','General Setting')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('General Setting')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('general_index') }}">{{__('General Setting')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="col-12">
                                <h4 class="mb-0 mt-2">{{ \App\Models\Utility::settingdata('name') }}</h4>
                                <p class="text-muted font-14">{{__('Application Name')}}</p>
                            </div>
                            <div class="col-12 mt-20">
                                <img src="{{asset( 'image/'.\App\Models\Utility::settingdata('website_logo')) }}" width="100px" height="100px" alt="">
                                <h5 class="mb-0 mt-2">{{__('Logo')}}</h5>
                            </div>
                            <div class="col-12 mt-20">
                                <img src="{{asset( 'image/'.\App\Models\Utility::settingdata('website_favicon')) }}" width="100px" height="100px" alt="">
                                <h5 class="mb-0 mt-2">{{__('Favicon')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route'=>['general_store',\App\Models\Utility::settingdata('id')],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                            @csrf

                            <div class="form-group">
                                {{Form::label('name',__('Application Name'))}}
                                {{Form::text('name' , \App\Models\Utility::settingdata('name') ,array('class'=>'form-control','placeholder'=>'Enter Your Application Name'))}}
                                @error('name')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                {{Form::label('name',__('Logo'))}}
                                {{Form::file('website_logo',array('class'=>'form-control'))}}
                                @error('website_logo')
                                <span class="invalid-name" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{Form::label('name',__('Favicon'))}}
                                {{Form::file('website_favicon',array('class'=>'form-control'))}}
                                @error('website_favicon')
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
        </section>
    </div>
@endsection
