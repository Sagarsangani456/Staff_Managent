@extends('admin.Layout.admin')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">{{__('Razorpay Payment')}}</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="">{{__('Razorpay Payment')}}</a></div>
                    <div class="breadcrumb-item">{{__('Razorpay Payment')}}</div>
                </div>
            </div>
            <div id="app">
                <main class="py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 offset-3 col-md-offset-6">

                                @if($message = Session::get('error'))
                                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Error!</strong> {{ $message }}
                                    </div>
                                @endif

                                <div class="card card-default">
                                    <img src="{{ asset('image/razorpay.png') }}" width="30%" height="30%" class="m-auto" alt="">
                                    <h4 class="m-auto text-dark"><span>{{ $plan->plan_name }}</span></h4>

                                    <div class="card-body text-center">
                                        <form action="{{ route('razorpay.payment.store',$plan->id) }}" method="POST">
                                            @csrf
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="rzp_test_l7UTKT47t0bC3J"
                                                    data-amount="{{ $amount * 100 }}"
                                                    data-buttontext="Pay Now"
                                                    data-name="{{ $plan->plan_name }}"
                                                    data-description="Rozerpay"
                                                    data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0IKciZuHjwcYmOM7-L4kicI4qblZY_o8OJw&usqp=CAU"
                                                    data-prefill.name="name"
                                                    data-prefill.email="email"
                                                    data-theme.color="#39B5E0">
                                            </script>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>
    </div>
@endsection
