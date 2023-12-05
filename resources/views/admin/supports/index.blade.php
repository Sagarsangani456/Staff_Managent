@extends('admin.Layout.admin')
@section('title','Support')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">Supports</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('support.index') }}">{{__('Support')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">{{__('Support Table')}}</h4>
                                    @can('support-create')
                                        <a href="#" data-size="md" data-url="{{ route('support.create') }}" data-ajax-popup="true" data-title="{{__('Add Support')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Support') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('Subject')}}</th>
                                        <th scope="col">{{__('Attchment')}}</th>
                                        <th scope="col">{{__('Created Date')}}</th>
                                        <th scope="col">{{__('Created By')}}</th>
                                        <th scope="col">{{__('User Assign')}}</th>
                                        <th scope="col">{{__('Priority')}}</th>
                                        <th scope="col">{{__('Status')}}</th>

                                        <th scope="col">{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($support as $support_list)
                                        <tr>
                                            <td>{{$support_list->subject}}</td>
                                            <td>
                                                @if($support_list->attchment == '')
                                                    <span class="fs"> {{"---"}} </span>
                                                @else
                                                    <a href="{{asset('attchment/'.$support_list->attchment)}}" download><i class="fa-solid fa-download"></i></a>
                                                @endif
                                            </td>

                                            <td>{{ \App\Models\Utility::dateformat($support_list->created_at) }}</td>
                                            <td>{{$support_list->user_name->name}}</td>
                                            <td>{{$support_list->user_assign}}</td>
                                            <td>
                                                <span class="badge">{{$support_list->priority}}</span>
                                            </td>
                                            <td>
                                                <span class="badge">{{$support_list->status}}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('support-reply')
                                                        <a href="{{ route('reply',$support_list->id) }}" class="btn btn-info btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Replay"><i class="fa-solid fa-share"></i></a>
                                                    @endcan
                                                    @can('support-edit')
                                                        <a href="#" data-size="md" data-url="{{ route('support.edit',$support_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit Support')}}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('support-delete')
                                                        <form action="{{ route('support.destroy',$support_list->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

