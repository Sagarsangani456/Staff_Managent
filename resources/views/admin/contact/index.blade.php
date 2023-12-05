@extends('admin.Layout.admin')
@section('title','Contact')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Contact')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('contact.index') }}">{{__('Contact')}}</a></div>
                    <div class="breadcrumb-item">{{__('card')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class=""> {{__('Contact card')}}</h4>
                                    @can('contact-create')
                                        <a href="#" data-size="md" data-url="{{ route('contact.create') }}" data-ajax-popup="true" data-title="{{__('Add Contact')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Contact') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                @foreach($contact as $contact_list)
                    <div class="col-xl-4  cdx-xxl-50 cdx-xl-50 ">
                        <div class="card card-contact rounded ">
                            <div class="card-body ">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <h4 class="text-dark">{{ $contact_list->name }}</h4>
                                        <h6 class="text">{{ $contact_list->email }}</h6>
                                    </div>
                                    <div class="user-setting">
                                        <div class="action-menu">
                                            <div class="action-toggle ">
                                                <i class="fa-solid fa-ellipsis-vertical" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent"></i>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                                    @can('contact-edit')
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-size="md" data-url="{{ route('contact.edit',$contact_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit Contact')}}"><i class="fa-solid fa-pen-to-square"></i> {{__('Edit Contact')}}</a>
                                                        </li>
                                                    @endcan
                                                    @can('contact-delete')
                                                        <li>
                                                            <a href="javascript:void(0)" class="text-danger dropdown-item font-weight-bold" id="delete" data-id="{{$contact_list->id}}">
                                                                <i class="fa fa-trash"></i> {{__('Delete Contact')}}
                                                            </a>
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['contact.destroy',$contact_list->id],'id'=>'delete-booking-'.$contact_list->id]) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h5 class="text-primary mb-4">{{ $contact_list->subject}}</h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <label class="fw">{{__('Contact Number')}} : </label>
                                            <span>{{ $contact_list->contact_number }}</span>
                                        </li>
                                        <li class="border-bottom ">
                                            <label class="fw">{{__('Created Date')}} : </label>
                                            <span>{{ \App\Models\Utility::dateformat($contact_list->created_at)}}</span>
                                        </li>
                                    </ul>
                                    <div class="user-action ">
                                        <p class="taxt">
                                            {{ $contact_list->message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection



{{--action="{{ route('contact.destroy',$contact_list->id) }}"--}}
