@extends('admin.Layout.admin')
@section('title','Dashboard')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row">
                @if(\Illuminate\Support\Facades\Auth::user()->plan_expiry_date != null)
                    @if(\Illuminate\Support\Facades\Auth::user()->type != 'super admin')
                        @if($daysUntilExpiry <= 5)
                            <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                                <div class="card">
                                    <div class="card-header ">
                                        <h4 class="text-dark">{{__('Plan Expire')}}</h4>
                                    </div>
                                    <div class="card-body">
                                        @if($expirydate <= \Carbon\Carbon::today())
                                            <h5 class="text-primary">{{__('Please Your plan has expired upgrade the plan')}}</h5>
                                            <a href="{{ route('plan.index') }}" class="btn btn-primary float-right">Upgrade Plan</a>
                                        @else
                                            <h5 class="text-primary">{{__('ALERT! Your plan will expire in')}} {{ $daysUntilExpiry }} {{__('Days')}}</h5>
                                            <a href="{{ route('plan.index') }}" class="btn btn-primary float-right">{{__('Upgrade Plan')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif

                <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                    <div class="card text-dark-all">
                        <div class="card-header">
                            <h4>{{__('Total User')}}</h4>
                        </div>
                        <div class="card-body  progressCounter">
                            <h3><span class="count">{{__($user)}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                    <div class="card text-dark-all">
                        <div class="card-header">
                            <h4>{{__('Total Contact')}}</h4>
                        </div>
                        <div class="card-body  progressCounter">
                            <h3><span class="count">{{__($contact)}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                    <div class="card text-dark-all">
                        <div class="card-header  ">
                            <h4>{{__('Total Support')}}</h4>
                        </div>
                        <div class="card-body progressCounter">
                            <h3><span class="count">{{__($support)}}</span></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                    <div class="card text-dark-all">
                        <div class="card-header">
                            <h4>{{__('Today Expense')}}</h4>
                        </div>
                        <div class="card-body  progressCounter">
                            <h3><span class="count">{{ __($expnse_count) }}</span></h3>
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->type == 'super admin')
                    <div class="col-xxl-3 col-sm-3 cdx-xxl-50">
                        <div class="card text-dark-all">
                            <div class="card-header">
                                <h4>{{__('Total Plan')}}</h4>
                            </div>
                            <div class="card-body  progressCounter">
                                <h3><span class="count">{{ __($plan) }}</span></h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="latest">{{__('Latest Supports')}}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table border">
                                <thead class="border ">
                                <tr class="text-dark-all ">
                                    <th class="border ">{{__('Subject')}}</th>
                                    <th class="border ">{{__('Attchment')}}</th>
                                    <th class="border ">{{__('Created Date')}}</th>
                                    <th class="border ">{{__('Created By')}}</th>
                                    <th class="border ">{{__('Assign User')}}</th>
                                    <th class="border ">{{__('Priority')}}</th>
                                    <th class="border ">{{__('Status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($support_latest as $support_latest_list)
                                    <tr class="border">
                                        <td class="border">{{$support_latest_list->subject}}</td>
                                        <td class="border">
                                            @if($support_latest_list->attchment == '')
                                                <span class="fs"> {{"---"}} </span>
                                            @else
                                                <a href="{{asset('attchment/'.$support_latest_list->attchment)}}" download><i class="fa-solid fa-download"></i></a>
                                            @endif
                                        </td>
                                        <td class="border">{{ \App\Models\Utility::dateformat($support_latest_list->created_at) }}</td>
                                        <td class="border">{{$support_latest_list->user_name->name}}</td>
                                        <td class="border">{{$support_latest_list->user_assign}}</td>
                                        <td class="border">
                                            <span class="badge">{{$support_latest_list->priority}}</span>
                                        </td>
                                        <td class="border">
                                            <span class="badge">{{$support_latest_list->status}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
