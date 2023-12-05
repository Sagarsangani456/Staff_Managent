@extends('admin.Layout.admin')
@section('title','Note')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h3>{{__('Note')}}</h3>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('note.index') }}">{{__('Note')}}</a></div>
                    <div class="breadcrumb-item">{{__('Note')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class=""> {{__('Note card')}}</h4>
                                    @can('note-create')
                                        <a href="#" data-size="md" data-url="{{ route('note.create') }}" data-ajax-popup="true" data-title="{{__('Add Note')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Note') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                @foreach($note as $note_list)
                    <div class="col-xl-4 cdx-xxl-50 cdx-xl-50">
                        <div class="card">
                            <div class="card-body">
                                <div class="note-body">
                                    <h4 class="text-dark">{{ $note_list->title }}</h4>
                                </div>
                                <ul class="list-unstyled mt-3 d-flex">
                                    <li class="ml-1"><i class="fa-solid fa-calendar-days"></i> {{ \App\Models\Utility::dateformat($note_list->created_at) }}</li>
                                    <li class="ml-3">
                                        @if($note_list->attchment == '')
                                            <span></span>
                                        @else
                                            <a href="{{asset('attchment/'.$note_list->attchment)}}" class=" attchment" target="_blank"><i class="fa-solid fa-circle-down"></i> {{__('Attchment')}}</a>
                                        @endif
                                    </li>
                                </ul>
                                <p>{{ $note_list->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection



{{--action="{{ route('contact.destroy',$contact_list->id) }}"--}}
