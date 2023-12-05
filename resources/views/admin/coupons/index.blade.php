@extends('admin.Layout.admin')
@section('title','Coupons')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h4 class="text-dark">Coupons</h4>
                <div class="section-header-breadcrumb">
                    <div class="livetime rounded"><i class="fa-solid fa-clock mr-1"></i> <span class="liveTime"></span></div>
                    <div class="livedate rounded"><i class="fa-solid fa-calendar-days mr-2"></i> <span class="getDate"></span></div>
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{__('Dashboard')}}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('coupon.index') }}">{{__('Coupons')}}</a></div>
                    <div class="breadcrumb-item">{{__('Table')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between w-100">
                                    <h4 class="">Coupon Table</h4>
                                    @can('coupon-create')
                                        <a href="#" data-size="md" data-url="{{ route('coupon.create') }}" data-ajax-popup="true" data-title="{{__('Add  Coupon')}}" class="btn btn-lg btn-primary rounded p-1 mb-1 ">
                                            {{ __('Add Coupon') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>

                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Code')}}</th>
                                        <th scope="col">{{__('Discount(%)')}}</th>
                                        <th scope="col">{{__('Flat Discount(₹)')}}</th>
                                        <th scope="col">{{__('Limit')}}</th>
                                        <th scope="col">{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupons_list)
                                        <tr>
                                            <td>{{ $coupons_list->name }}</td>
                                            <td>{{ $coupons_list->code }}</td>
                                            <td>{{ $coupons_list->discount }}</td>
                                            <td>{{ $coupons_list->flatdiscount }}</td>
                                            <td>{{ $coupons_list->limit }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('coupon-edit')
                                                        <a href="#" data-size="md" data-url="{{ route('coupon.edit',$coupons_list->id) }}" data-ajax-popup="true" data-title="{{__('Edit Coupon')}}" class="btn btn-success btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    @endcan
                                                    @can('coupon-delete')
                                                        <form action="{{ route('coupon.destroy',$coupons_list->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm ml-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

