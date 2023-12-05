@extends('admin.Layout.admin')
@section('title','Note')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Plan')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('note.index') }}">{{__('Plan')}}</a></div>
                    <div class="breadcrumb-item">{{__('Plan')}}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">{{__(' Plan card')}}</h4>
                                    @if(\Illuminate\Support\Facades\Auth::user()->type == 'super admin')
                                        <a href="#" data-size="md" data-url="{{ route('plan.create') }}" data-ajax-popup="true" data-title="{{__('Add Plan')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Plan') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($plan as $plan_list)
                    <div class="col-md-4">
                        <div class="card pricing-card pricing-plan-basic ">
                            <div class="card-body">

                                <p class="pricing-plan-title"> {{ $plan_list->plan_name }} </p>
                                <h3 class="pricing-plan-cost ml-auto">${{ $plan_list->plan_price }}/{{ $plan_list->duration }}</h3>
                                <ul class="pricing-plan-features text-dark">
                                    <li class="plan-detail">
                                        <p><i class="fa-solid fa-circle fa-2xs mr-3 " style="color: #07df15;"></i><span>{{ $plan_list->maximum_user }} User Create </span></p>
                                        <p><i class="fa-solid fa-circle fa-2xs mr-3 " style="color: #07df15;"></i><span>{{ $plan_list->maximum_contact }} Contact Create </span></p>
                                        <p><i class="fa-solid fa-circle fa-2xs mr-3 " style="color: #07df15;"></i><span>{{ $plan_list->maximum_note }} Note Create </span></p>
                                    </li>
                                </ul>

                                @if(\Illuminate\Support\Facades\Auth::user()->type != 'super admin')
                                    @if($user->plan_id != $plan_list->id)
                                        <div class="d-flex justify-content-center">
                                            <div class="form-group">
                                                <input type="text" name="code" id="coupon_code_{{ $plan_list->id }}" class="form-control coupon" placeholder="Enter Coupon Code">
                                            </div>
                                            <div class="form-group ms-3 mt-1 ml-3">
                                                <button class="btn btn-outline-primary" data-planid="{{ $plan_list->id }}" type="button" id="apply_now"><i class="fa-solid fa-check mr-1"></i>Apply Now</button>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <form action="{{ route('razorpay.payment.index',$plan_list->id) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="totalamount" id="amount_{{ $plan_list->id }}">

                                    @if(\Illuminate\Support\Facades\Auth::user()->type != 'super admin')
                                        @if($planexpiryDate == date('d-m-Y'))
                                            <button type="submit" class="btn  btn-info">{{__('Subscribe')}}</button>
                                        @elseif($user->plan_id == $plan_list->id)
                                            <h5 class="h6 my-4 text-dark ">{{__('Expired Date')}} {{ $user->plan_expiry_date }}</h5>
                                        @else
                                            <button type="submit" class="btn  btn-info">{{__('Subscribe')}}</button>
                                        @endif
                                    @endif
                                </form>

                                @if(\Illuminate\Support\Facades\Auth::user()->type == 'super admin')
                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="#" data-size="md" data-url="{{ route('plan.edit',$plan_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm ml-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="javascript:void(0)">
                                            <button class="btn btn-danger btn-sm ml-2 " data-toggle="tooltip" data-placement="top" title="Delete" id="delete" data-id="{{$plan_list->id}}"><i class="fa-solid fa-trash-can"></i></button>
                                        </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['plan.destroy',$plan_list->id],'id'=>'delete-booking-'.$plan_list->id]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '#apply_now', function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var idplan = $(this).data('planid');

                var couponcode = $('#coupon_code_' + idplan).val();

                $.ajax({
                    url: "{{ route('coupon_apply') }}",
                    method: "POST",
                    data: {
                        id: idplan,
                        code: couponcode,
                    },
                    success: function (response) {
                        console.log(response);
                        $('#amount_' + idplan).val(response);
                    }
                });
            });
        });

    </script>

@endsection

