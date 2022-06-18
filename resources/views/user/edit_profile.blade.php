@extends('layouts.masterLayout')
@section('container')
<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="user-area pt-4 pb-5" id="coffee">
    <div class="container mt-5 bg-white rounded">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <a style="text-decoration: none;" class="text-dark font-xl"
                                    href="{{ route('user.profile') }}">User / </a>
                                <a style="text-decoration: none;" class="text-dark font-weight-bold font-xl" href="#">Edit
                                    User</a>
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
                                <form method="post" action="{{ route('user.update', $user->id) }}" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="image">Photo Profile</label><br>
                                        @if ($user->profile_path != NULL)
                                        @php
                                        $img = $user->profile_path
                                        @endphp
                                        @else
                                        @php
                                        $img = 'images/default_menu.png'
                                        @endphp
                                        @endif
                                        <img class="mb-3" width="150px" src="{{ asset('storage/'.$img) }}">
                                        <input type="file" class="form-control" name="image"
                                            value="{{$user->profile_path}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $user->name }}" aria-describedby="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ $user->email }}" aria-describedby="email">
                                    </div>

                                    <button class="btn text-white" style="background-color: #b68834;">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection