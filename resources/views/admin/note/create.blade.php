{!! Form::open(['route'=>'note.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf

<div class="form-group">
    {{Form::label('name',__('Title'))}}
    {{Form::text('title',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('title')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="form-group">
    {{Form::label('name',__('Attchment'))}}
    {{Form::file('attchment',array('class'=>'form-control'))}}
    @error('attchment')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="form-group">
    {{Form::label('name',__('Description'))}}
    {{Form::textarea('description',null,['class'=>'form-control'])}}
    @error('description')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
