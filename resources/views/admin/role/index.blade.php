@extends('admin.Layout.admin')
@section('title','Role')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">Role</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('role.index') }}">{{__('Role')}}</a></div>
                    <div class="breadcrumb-item">Table</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">Role Table</h4>
                                    @can('role-create')
                                        <a href="{{ route('role.create') }}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Role') }}
                                        </a>
                                    @endcan

                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('ID')}}</th>
                                        <th scope="col">{{__('Role Name')}}</th>
                                        <th scope="col">{{__('User Count')}}</th>
                                        <th scope="col">{{__('Permission Count')}}</th>

                                        <th scope="col">{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($role as $role_list)
                                        <tr>
                                            <td>{{$role_list->id}}</td>
                                            <td>{{$role_list->name}}</td>
                                            <td>{{$role_list->users->count()}}</td>
                                            <td>{{ $role_list->permissions->count() }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('role-edit')
                                                        <a href="{{ route('role.edit',$role_list->id) }}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('role-delete')
                                                        <form action="{{ route('role.destroy',$role_list->id) }}" method="POST">
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

