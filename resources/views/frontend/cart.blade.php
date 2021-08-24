@extends('frontend.master')

@section('content')

    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @if (session('CartDelete'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Opps!</strong> {{ session('CartDelete') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <hr>
                    @endif

                    @if (session('couponbd'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Opps!</strong> {{ session('couponbd') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <hr>
                @endif

                @if (session('couponA'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Opps!</strong> {{ session('couponA') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <hr>
                    @endif


                    <form action="{{ route('CartUpdate') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $total = 0;
                                @endphp

                                @forelse ( $Carts as $Cart )
                                <input type="hidden" value="{{ $Cart->id }}" name="Cart_id[]">
                                    <tr>
                                        <td class="images"><img
                                                src="{{ url('/img/thumbnail') .'/'. $Cart->product->product_thumbnail }}"
                                                alt="$Cart->product->product_thumbnail" width="50"></td>
                                        <td class="product"><a
                                                href="single-product.html">{{ $Cart->product->product_name }}</a></td>
                                        <td class="ptice">${{ $Cart->product->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" name="product_quantity[]" value="{{ $Cart->product_quantity }}" />
                                        </td>

                                        @php

                                            $total +=$Cart->product->product_price * $Cart->product_quantity

                                        @endphp

                                        <td class="total">${{ $Cart->product->product_price * $Cart->product_quantity }}
                                        </td>
                                        <td class="remove" data-id="{{ $Cart->id}}">  <a href="#"><i
                                                    class="fa fa-times"></i></a></td>
                                    </tr>
                                @empty
                                    <tr>

                                            <td colspan="15">
                                                No Cart Data Available
                                            </td>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                    </ul>

                                    @if (Session::has('coupon'))

                                    @else
                                    <h3>Coupon</h3>
                                    <p>Enter Your Coupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" name="coupon_code" class="CouponValue" placeholder="Coupon Code">
                                        <span class="couponbtn">Apply Coupon</span>
                                    </div>

                                    @endif

                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>

                                        @if (Session::has('coupon'))
                                        <li><span class="pull-left">Subtotal </span>${{ $total }}</li>

                                        <li><span class="pull-left">discount(%) </span> {{ $dis = $total * session()->get('coupon')['coupon_discount'] / 100 }}
                                            ({{ session()->get('coupon')['coupon_discount'] }} %)</li>

                                            <li><span class="pull-left"> Total </span> {{ $total - $dis }}</li>
                                        @else

                                        <li><span class="pull-left"> Total </span> {{ $total }}</li>
                                        @endif

                                    </ul>
                                    <a href="{{ route('checkout') }}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection

@section('footer_js')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.remove').click(function() {
                var dataId = $(this).attr("data-id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                        window.location.href = "{{ url('single/cart-delete/') }}"+ dataId;

                    }
                })

            })

            $('.couponbtn').click(function () {
                var CouponValue = $('.CouponValue').val();

                window.location.href = "{{ url('cart/') }}/"+ CouponValue;
            })
        })
    </script>

@endsection
