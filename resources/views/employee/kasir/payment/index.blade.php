@extends('layouts.paymentLayout')
@section('container')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Payments Table </h3>
            <div class="float-left my-2">
                <form action="{{ route('payment.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search . . . " name="search" value="{{ request('search') }}">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right my-2 mb-4">
                            <a class="btn btn-success" href="{{ route('payment.create') }}"> Input Payment</a>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-error">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>ID Employee</th>
                                    <th>Payment</th>
                                    <th>Change</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginate as $payment)
                                <tr>
                                    <td>{{ $payment ->id }}</td>
                                    <td>{{ $payment ->employee_id }}</td>
                                    <td>{{ $payment ->payment }}</td>
                                    <td>{{ $payment ->change }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('payment.show',$payment->id) }}">Detail</a>
                                        <a class="btn btn-primary" href="{{ route('print_payment',$payment->id) }}">Print</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="btn">
                        {{ $paginate->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection