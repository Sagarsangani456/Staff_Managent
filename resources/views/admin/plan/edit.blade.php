{!! Form::model($plan,['route'=>['plan.update',$plan],'method'=>'PUT']) !!}
@csrf

<div class="form-group">
    {{Form::label('name',__('Plan Name'))}}
    {{Form::text('plan_name',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('plan_name')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Plan price'))}}
    {{Form::text('plan_price',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('plan_price')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Plan Duration'))}}
    {{Form::text('duration',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('duration')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Maximum User'))}}
    {{Form::text('maximum_user',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('maximum_user')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Maximum Contact'))}}
    {{Form::text('maximum_contact',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('maximum_contact')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Maximum Note'))}}
    {{Form::text('maximum_note',null,['class'=>'form-control','placeholder'=>'Enter Your Title'])}}
    @error('maximum_note')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>



<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
