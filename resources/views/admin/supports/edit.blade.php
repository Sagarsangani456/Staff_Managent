{!! Form::model($support,['route'=>['support.update',$support->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
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
        @foreach($user as $user_list)
            <option value="{{$user_list->name}}"{{ isset($support) ? ($support->user_assign == $user_list->name ? 'selected' : '') : (old('user_assign') == $user_list->name ? 'selected':'') }}>{{$user_list->name}}</option>
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
        <option value="low"{{ isset($support) ? ($support->priority == 'low' ? 'selected' : '') : (old('priority') == 'low' ? 'selected' : '') }}>Low</option>
        <option value="medium"{{ isset($support) ? ($support->priority == 'medium' ? 'selected' : '') : (old('priority') == 'medium' ? 'selected' : '') }}>Medium</option>
        <option value="high"{{ isset($support) ? ($support->priority == 'high' ? 'selected' : '') : (old('priority') == 'high' ? 'selected' : '') }}>High</option>
        <option value="critical"{{ isset($support) ? ($support->priority == 'critical'? 'selected' : '') : (old('priority') == 'critical' ? 'selected' : '') }}>Critical</option>
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
        <option value="pending"{{ isset($support) ? ($support->status == 'pending' ? 'selected' : '') : (old('status') == 'pending' ? 'selected' : '') }}>Pending</option>
        <option value="open"{{ isset($support) ? ($support->status == 'open' ? 'selected' : '') : (old('status') == 'open' ? 'selected' : '') }}>Open</option>
        <option value="close"{{ isset($support) ? ($support->status == 'close' ? 'selected' : '') : (old('status') == 'close' ? 'selected' : '') }}>Close</option>
        <option value="on_hold"{{ isset($support) ? ($support->status == 'on_hold' ? 'selected' : '') : (old('status') == 'on_hold' ? 'selected' : '') }}>On Hold</option>
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
