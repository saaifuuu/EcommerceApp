@extends('backend.layouts.app')

@section('title', 'Order detail')

@section('content')
    <section class="content-header">
        <h1>
            Order's Detail
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="{{ route('backend.order.list') }}"><i class="fa fa-dashboard"></i> Order</a></li>
            <li class="active">Order Detail</li>
        </ol>
    </section>

    <!-- Content Wrapper. Contains page content -->
    <div class="content ">
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{{ route('backend.order.pdf',['id' => $order->id]) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

                <a href="{{ route('backend.order.pdf',['id' => $order->id]) }}" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </a>

            </div>
        </div>

        {{--<div class="pad margin no-print">--}}
            {{--<div class="callout callout-info" style="margin-bottom: 0!important;">--}}
                {{--<h4><i class="fa fa-info"></i> Note:</h4>--}}
                {{--This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> {{ config('app.name', 'JahangirEnterprice') }}
                        <small class="pull-right">Date: {{ date('F j, Y, g:i:s a', strtotime( $order->created_at)) }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Jahangir Enterprice</strong><br>
                        Haji Khalek Gamsa Super Market,<br>
                        Shekherchar Bazar, Mosjid road, <br>
                        Gamsa potti,Madhabdi. <br>
                        Phone: +88 017 11 227 959<br>
                        Email: jh.jahangir227@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</strong><br>
                        {{ $order->billing_address }}<br>
                        {{ $order->billing_town }}, {{ $order->billing_city}} &nbsp;
                        {{ $order->billing_zip_code }} <br>
                        Phone: {{ $order->billing_phone_no }}<br>
                        Email: {{ $order->billing_email }}
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #{{ $order->id + 1000 }}</b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product slug</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->productName }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->rate }}</td>
                            <td>{{ $product->rate * $product->amount }} ৳</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Payment Methods:</p>
                    <p>Payer name: {{ $order->billing_first_name }} {{ $order->billing_last_name }}</p>


                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                         Payment Method: {{ $order->billing_payment_gateway }} <br>
                         Paid Amount: {{ $order->billing_total }} <br>
                         Transection ID: {{ $order->billing_id }} <br>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>{{ $order->billing_subtotal }} ৳</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>{{ $order->shipping_fee }} ৳</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td>{{ $order->discount }} ৳</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>{{ $order->billing_total }} ৳</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->


@endsection