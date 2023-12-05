{!! Form::open(['route'=>'contact.store','method'=>'POST']) !!}
@csrf

<div class="form-group">
    {{Form::label('name',__('Name'))}}
    {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Your Name'])}}
    @error('name')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Email'))}}
    {{Form::text('email',null,['class'=>'form-control','placeholder'=>'Enter Your Email'])}}
    @error('email')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Contact Number'))}}
    {{Form::text('contact_number',null,['class'=>'form-control','placeholder'=>'Enter Your Contact Number'])}}
    @error('contact_number')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Subject'))}}
    {{Form::text('subject',null,['class'=>'form-control','placeholder'=>'Enter Your Subject'])}}
    @error('subject')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Message'))}}
    {{Form::textarea('message',null,['class'=>'form-control'])}}
    @error('name')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>



<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
