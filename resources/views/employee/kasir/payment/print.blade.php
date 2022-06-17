@extends('layouts.paymentLayout')
@section('container')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
    media="print">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('payment.index') }}">Payment
                            / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Detail Payment</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover mb-2">
                            <tr>
                                <th>ID Payment</th>
                                <td>{{$payment->id}}</td>
                            </tr>
                            <tr>
                                <th>ID Employee</th>
                                <td>{{$payment->employee_id}}</td>
                            </tr>
                            <tr>
                                <th>Email User</th>
                                <td>{{$payment->order->user->email}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$payment->order->order_date}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover mb-4">
                            <tr>
                                <th>Nama menu</th>
                                <th>QTY</th>
                                <th>Subtotal</th>
                            </tr>
                            @foreach ($payment->order->orderDetail as $orderDetail)
                            <tr>
                                <td>{{ $orderDetail->menu->name }}</td>
                                <td>{{ $orderDetail->qty }}</td>
                                <td>{{
                                    $orderDetail->menu->price * $orderDetail->qty
                                    }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th></th>
                                <th>Total</th>
                                <td>{{$payment->order->total}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Payment</th>
                                <td>{{$payment->payment}}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Change</th>
                                <td>{{$payment->change}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection