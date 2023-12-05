{!! Form::open(['route'=>'support.store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
@csrf

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
    {{Form::label('name',__('User Assign'))}}
{{--    {{Form::text('user_assign',null,['class'=>'form-control','placeholder'=>'Enter Your User Assign'])}}--}}
    <select name="user_assign" id="" class="form-control">
        <option value="">ALL</option>
        @foreach($user as $user_list)
            <option value="{{$user_list->name}}">{{$user_list->name}}</option>
        @endforeach
    </select>
    @error('user_assign')
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
    {{Form::label('name',__('Priority'))}}
    <select name="priority" id="" class="form-control">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
        <option value="critical">Critical</option>
    </select>
    @error('priority')
    <span class="invalid-name" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
    @enderror
</div>

<div class="form-group">
    {{Form::label('name',__('Status'))}}
    <select name="status" id="" class="form-control">
        <option value="pending">Pending</option>
        <option value="open">Open</option>
        <option value="close">Close</option>
        <option value="on_hold">On Hold</option>
    </select>
    @error('status')
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
