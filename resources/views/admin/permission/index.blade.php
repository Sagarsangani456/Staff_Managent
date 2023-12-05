@extends('admin.Layout.admin')
@section('title','Permission')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('Table')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('permission.index') }}">{{__('Permission')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">{{__('Permission Table')}}</h4>
                                    <a href="#" data-size="md" data-url="{{ route('permission.create') }}" data-ajax-popup="true" data-title="{{__('Add permission')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                     {{ __('Add permission') }}
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('ID')}}</th>
                                        <th scope="col">{{__('Permisssion Name')}}</th>
                                        <th scope="col">{{__('Group')}}</th>
                                        <th scope="col">{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permission as $permission_list)
                                        <tr>
                                            <td>{{$permission_list->id}}</td>
                                            <td>{{$permission_list->name}}</td>
                                            <td>{{$permission_list->group}}</td>

                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" data-size="md" data-url="{{ route('permission.edit',$permission_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit Permission')}}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <form action="{{ route('permission.destroy',$permission_list->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
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

