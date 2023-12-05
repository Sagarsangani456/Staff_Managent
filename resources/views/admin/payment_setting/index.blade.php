@extends('admin.Layout.admin')
@section('title','payment Setting')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Payment Setting')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('payment_setting') }}">{{__('Payment Setting')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route'=>'payment_store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Razorpay_Key'))}}
                                    {{Form::text('razorpay_key',\App\Models\Utility::settingdata('razorpay_key') ,array('class'=>'form-control','placeholder'=>'Enter Your razorpay_key'))}}
                                    @error('razorpay_key')
                                    <span class="invalid-name" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    {{Form::label('name',__('Razorpay_Secret'))}}
                                    {{Form::text('razorpay_secret', \App\Models\Utility::settingdata('razorpay_secret'),array('class'=>'form-control','placeholder'=>'Enter Your razorpay_secret'))}}
                                    @error('razorpay_secret')
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
