{!! Form::model($edit,['route'=>['user.update',$edit->id],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
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
    {{Form::label('name',__('Image'))}}
    {{Form::file('image',array('class'=>'form-control'))}}
    @error('image')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Role'))}}
    <select name="role" class="form-control">
        <option value="">--Select Role --</option>
        @foreach($roles as $value)
            <option value="{{ $value->name}}"{{ isset($edit) ? ($edit->type ==  $value->name ? 'selected' : '') : (old('type') == $value->name ? 'selected' : '') }}>{{ $value->name}}</option>
        @endforeach
    </select>
    @error('role')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>


<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
