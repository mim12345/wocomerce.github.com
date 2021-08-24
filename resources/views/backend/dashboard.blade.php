@extends('backend.master')
@section('header_css')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

@endsection

@section('content')

    <div class="content">
        <div class="container-fluid">
            <h4 class="header-title mb-4">Account Overview</h4>
            <div class="row">
                <div class="col-xl-3 col-md-6 text-center">
                    <div class="card bg-primary text-white mb-4">
                        <div class="row">
                            <div class="card-body " style="font-size: 15px">Today Orders Recived <h2> 552</h2>
                            </div>
                            <div class="card-body" style="font-size: 15px">Today Orders Delivered <h2> 552</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 text-center">
                    <div class="card bg-warning text-white mb-4">
                        <div class="row">
                            <div class="card-body " style="font-size: 15px">Today Sells <h2> 552</h2>
                            </div>
                            <div class="card-body" style="font-size: 15px">Orders Recived <h2> 552</h2>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6 text-center">
                    <div class="card bg-success text-white mb-4">
                        <div class="row">
                            <div class="card-body " style="font-size: 15px">Orders Recived <h2> 552</h2>
                            </div>
                            <div class="card-body" style="font-size: 15px">Orders Recived <h2> 552</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 text-center">
                    <div class="card bg-danger text-white mb-4">
                        <div class="row">
                            <div class="card-body " style="font-size: 15px">Orders Recived <h2> 552</h2>
                            </div>
                            <div class="card-body" style="font-size: 15px">Orders Recived <h2> 552</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-12">
                    <div class="card-box">

                        <div class="col-6">
                            {!! $chart->container() !!}

                            {!! $chart->script() !!}
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container -->

    </div>
@endsection

@section('footer_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>




@endsection
