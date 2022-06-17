@extends('layouts.paymentLayout')
@section('container')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <a style="text-decoration: none;" class="text-dark" href="{{ route('payment.index') }}">Payment / </a>
                        <a style="text-decoration: none;" class="text-dark font-weight-bold" href="#">Add Payment</a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="post" action="{{ route('payment.store') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="order">ID Order</label>
                                <select name="order" class="form-control">
                                    @foreach ($order as $od)
                                    <option value="{{ $od->id }}">{{ $od->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="employee_id">ID Employee</label>
                                <input type="number" name="employee_id" class="form-control" id="employee_id"
                                    aria-describedby="employee_id">
                            </div>
                            <div class="form-group">
                                <label for="payment">Payment</label>
                                <input type="number" name="payment" class="form-control" id="payment"
                                    aria-describedby="payment">
                            </div>
                            <div class="form-group">
                                <label for="change">Change</label>
                                <input type="number" name="change" class="form-control" id="change"
                                    aria-describedby="change">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection