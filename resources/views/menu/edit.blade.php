@extends('menu.layout')
@section('content')
<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Menu
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
                <form method="post" action="{{ route('menu.update', $menu->id) }}" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $menu->name }}"
                            aria-describedby="name">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ $menu->price }}"
                            aria-describedby="price">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" id="stock" value="{{ $menu->stock }}"
                            aria-describedby="price">
                    </div>
                    <div class="form-group">
                        <label for="image">Picture</label>
                        <input type="file" class="form-control" name="image" value="{{$menu->meu_photo_path}}"></br>
                        @if ($menu->menu_photo_path != NULL)
                        @php
                        $img = $menu->menu_photo_path
                        @endphp
                        @else
                        @php
                        $img = 'images/default_menu.png'
                        @endphp
                        @endif
                        <img width="150px" src="{{ asset('storage/'.$img) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection