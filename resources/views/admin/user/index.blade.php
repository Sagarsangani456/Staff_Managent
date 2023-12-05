@extends('admin.Layout.admin')
@section('title','User')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">Users</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">{{__('User')}}</a></div>
                    <div class="breadcrumb-item">Table</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">{{__('User Table')}}</h4>
                                    @can('user-create')
                                        <a href="#" data-size="md" data-url="{{ route('user.create') }}" data-ajax-popup="true" data-title="{{__('Add User')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add User') }}
                                        </a>
                                    @endcan

                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
{{--                                        <th scope="col">ID</th>--}}
                                        <th scope="col">{{__('Profile')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Email')}}</th>
                                        <th scope="col">{{__('Role Name')}}</th>
                                        <th scope="col">{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $user_list)
                                        <tr>
                                            <td><img src="{{ asset('image/'.$user_list->image) }}" alt="" width="40px" height="40px" srcset=""></td>
                                            <td>{{$user_list->name}}</td>
                                            <td>{{$user_list->email}}</td>
                                            <td>
                                                @if(!empty($user_list->getRoleNames()))
                                                    @foreach($user_list->getRoleNames() as $value)
                                                        <span>{{$value}}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('user-edit')
                                                        <a href="#" data-size="md" data-url="{{ route('user.edit',$user_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit User')}}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('user-delete')
                                                        <form action="{{ route('user.destroy',$user_list->id) }}" method="POST">
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

