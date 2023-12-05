@extends('admin.Layout.admin')
@section('title','Support')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Language')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('language.index') }}">{{__('Language')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class=""> {{__('Language')}}</h4>
                                    <a href="#" data-size="md" data-url="{{ route('language.create') }}" data-ajax-popup="true" data-title="{{__('Add Language')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                        {{ __('Add Language') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="trsuh">
                        <ul class="nav nav-pills border-0 nav-fill mb-5 " id="pills-tab" role="tablist">

                            <a href="javascript:void(0)" class="dropdown-item font-weight-bold fontsize btn bg-light-secondary" id="delete" data-id="">
                                <i class="fa-solid fa-trash-can "></i>
                            </a>
{{--                            {!! Form::open(['method' => 'DELETE', 'route' => ['language.destroy',$languages->id],'id'=>'delete-booking-'.$languages->id]) !!}--}}
{{--                            {!! Form::close() !!}--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="card sticky-top">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            @foreach($languages as $code => $language)
                                <a href="{{route('language.data',[$code])}}" class="list-group-item list-group-item-action border-0 {{ ($currantLang == $code) ? 'active':'' }}">{{ ucfirst($language) }}<i class="fa-solid fa-chevron-right float-right"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="labels" role="tabpanel" aria-labelledby="home-tab">
                                        <form method="post" action="{{ route('store.language.data',[$currantLang]) }}">
                                            @csrf
                                            <div class="row">
                                                @foreach($arrylabel as $label => $value)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label fontsize" for="example3cols1Input">{{$label}} </label>
                                                            <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="card-footer text-end">
                                                    <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection
