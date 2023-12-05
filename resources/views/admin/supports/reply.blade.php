@extends('admin.Layout.admin')
@section('title','Replay')
@section('content')

    <div class="main-content">
        <div class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Reply')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('support.index') }}">{{__('Support')}}</a></div>
                    <div class="breadcrumb-item">{{__('Reply')}}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card blogdetail-wrrapper">
                        <div class="card-body">
                            <h4 class="text-dark">{{$reply->subject}}</h4>
                            <ul class="list-unstyled mt-3 d-flex">
                                <li><i class="fa-regular fa-user"></i> <b>{{$reply->user_name->name}}</b></li>
                                <li class="ml-3"><i class="fa-regular fa-user"></i> <b>{{$reply->user_assign}}</b></li>
                                <li class="ml-3"><i class="fa-solid fa-calendar-days"></i> <b>{{ \App\Models\Utility::dateformat($reply->created_at) }}</b></li>
                                <li class="ml-3"><span class="badge">{{$reply->priority}}</span></li>
                                <li class="ml-3"><span class="badge">{{$reply->status}}</span></li>
{{--                                <li class="ml-3"><a href="{{asset('attchment/'.$reply->attchment)}}" download><i class="fa-solid fa-download"></i></a></li>--}}
                                <li class="ml-3">
                                    @if($reply->attchment == '')
                                        <span></span>
                                    @else
                                        <a href="{{asset('attchment/'.$reply->attchment)}}" download><i class="fa-solid fa-download"></i></a>
                                    @endif
                                </li>
                            </ul>
                            <p>{{ $reply->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="msg"><i class="fa-solid fa-comment-dots"></i> <span class="comment">{{__("Comments")}}</span></p>
                        </div>
                        @foreach($comment as $comment_list)
                            <div class="form-group comment_msg">
                                <h4 class="comment_name">
                                    {{ $comment_list->user_name->name }}
                                    <span class="comment-time"><i class="fa-solid fa-calendar-days mr-1"></i>{{ $comment_list->created_at->format('M d,Y') }}</span>
                                </h4>
                                <p>{{ $comment_list->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['route'=>['reply_store',$reply->id],'method'=>'POST']) !!}
                            <div class="form-group">
                                <p class="msg"><i class="fa-solid fa-square-plus"></i><span class="comment">{{__("Add Comment")}}</span></p>
                                <textarea name="comment" id="" cols="30" rows="5" placeholder="Write a comment..." class="form-control mt-4"></textarea>
                            </div>
                            <div class="text-left">
                                {{Form::submit(__('submit'),array('class'=>'btn btn-lg btn-primary rounded-pill'))}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>>
@endsection
