{!! Form::open(['route'=>'permission.store','method'=>'POST']) !!}
@csrf

<div class="form-group">
    {{Form::label('name',__('Permission Name'))}}
    {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Your permission'])}}
    @error('name')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


    <div class="form-group">

        {{Form::label('name',__('Group '))}}
        {{Form::text('group',null,['class'=>'form-control','placeholder'=>'Enter Your Group'])}}
    </div>


<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
