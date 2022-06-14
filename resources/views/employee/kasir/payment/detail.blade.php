@extends('layouts.paymentLayout')
@section('container')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('payment.index') }}">Payment / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Detail Payment</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>ID Payment</th>
                                <td>{{$payment->id}}</td>
                            </tr>
                            <tr>
                                <th>ID Employee</th>
                                <td>{{$payment->employee_id}}</td>
                            </tr>
                            <tr>
                                <th>ID User</th>
                                <td>{{$payment->order->user_id}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{$payment->order->total}}</td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td>{{$payment->payment}}</td>
                            </tr>
                            <tr>
                                <th>Change</th>
                                <td>{{$payment->change}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$payment->order->order_date}}</td>
                            </tr>
                        </table>
                        <a class="btn btn-success mt-3" href="{{ route('payment.index') }}">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection