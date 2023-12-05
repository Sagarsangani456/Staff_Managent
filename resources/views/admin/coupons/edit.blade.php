{!! Form::model($coupon,['route'=>['coupon.update',$coupon->id],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
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

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('name',__('Discount'))}}
            {{Form::number('discount',null,['class'=>'form-control','placeholder'=>'Enter Your Discount','step'=>'0.01'])}}
            <span class="mt-1">Note: Discount in Percentage</span>
            @error('discount')
            <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{Form::label('name',__('Flat Discount'))}}
            {{Form::number('flatdiscount',null,['class'=>'form-control','placeholder'=>'Enter Your Discount'])}}
            <span class="mt-1">Note: Flat Discount </span>
            @error('flatdiscount')
            <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    {{Form::label('name',__('Limit'))}}
    {{Form::number('limit',null,['class'=>'form-control','placeholder'=>'Enter Your Limit'])}}
    @error('limit')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Code'))}}
    {{Form::text('code',null,['class'=>'form-control','placeholder'=>'Enter Your Code','id'=>'auto-code'])}}
    <button class="btn generate_btn mt-3" type="button" id="code-generate"><i class="fa fa-history pr-1"></i> Generate</button>
    @error('code')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="text-right">
    {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
</div>

{!! Form::close() !!}
