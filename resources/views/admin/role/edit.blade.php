@extends('admin.Layout.admin')

@section('content')

    {!! Form::model($role,['route'=>['role.update',$role->id],'method'=>'PUT'])  !!}
    @csrf

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Table</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('role.index') }}">{{__('Role')}}</a></div>
                    <div class="breadcrumb-item">{{__('Edit')}}</div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4>Edit Role</h4>
                </div>
                <div class="card-body">
                    <div class="card-header">
                        <h4>{{ __('Create Role') }}</h4>
                        <div class="card-header-action">
                            <label class="custom-switch pt-1">
                                <input type="checkbox" id="select-all" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">{{ __('Select All') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group p-0 col-12">
                        <label>{{ __('Role name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                    </div>
                    @foreach($permissions as $groupName => $permissionGroup)
                        <div class="row">
                            <div class="col-12 pt-4">
                                <div class="section-title mt-0">{{ $groupName }}</div>
                            </div>
                            @foreach($permissionGroup as $permission)
                                <div class="col-md-3 col-sm-12 pt-3">
                                    <label class="custom-switch">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="customCheck{{ $permission->id }}" class="custom-switch-input permission" {{ in_array($permission->id,$selected_permissions) ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">{{ ucwords(str_replace('-',' ',$permission->name)) }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="text-right">
                {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
            </div>

            {!! Form::close() !!}


            <script>
                $('#select-all').on('click', function () {
                    if ($(this).is(":checked")) {
                        $('.permission').attr('checked', true);
                    } else {
                        $('.permission').attr('checked', false);
                    }
                });
            </script>
@endsection
