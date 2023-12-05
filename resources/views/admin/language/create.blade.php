{!! Form::open(['route'=>'language.store','method'=>'POST']) !!}
@csrf

<div class="form-group">
    {{Form::label('name',__('Language Code'))}}
    {{Form::text('language_code',null,['class'=>'form-control','placeholder'=>'Enter Your Language Code'])}}
    @error('language_code')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Language Name'))}}
    {{Form::text('language_name',null,['class'=>'form-control','placeholder'=>'Enter Your Language Name'])}}
    @error('language_name')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
