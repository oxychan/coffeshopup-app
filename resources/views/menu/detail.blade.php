@extends('menu.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Detail Menu
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Id: </b>{{$menu->id}}</li>
                    <li class="list-group-item"><b>Name: </b>{{$menu->name}}</li>
                    <li class="list-group-item"><b>Price: </b>{{$menu->price}}</li>
                    <li class="list-group-item"><b>Stock: </b>{{$menu->stock}}</li>
                    @if ($menu->menu_photo_path != NULL)
                    @php
                    $img = $menu->menu_photo_path
                    @endphp
                    @else
                    @php
                    $img = 'images/default_menu.png'
                    @endphp
                    @endif
                    <li class="list-group-item"><b>Picture: </b><img width="50px"
                            src="{{ asset('storage/' . $img) }}"></li>
                </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('menu.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection