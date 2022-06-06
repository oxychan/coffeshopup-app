@extends('menu.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Menu</h2>
        </div>
        <div class="float-left my-2">
            <form action="{{ route('menu.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search . . . " name="search"
                        value="{{ request('search')}}">
                    <button class="btn btn-success" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('menu.create') }}"> Input Menu</a>
        </div>
    </div>
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

<table class="table table-bordered">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Picture</th>
        <th width="500px">Action</th>
    </tr>
    @foreach ($paginate as $menu)
    <tr>
        <td>{{ $menu ->id }}</td>
        <td>{{ $menu ->name }}</td>
        <td>{{ $menu ->price }}</td>
        <td>{{ $menu ->stock }}</td>
        @if ($menu->menu_photo_path != NULL)
        @php
        $img = $menu->menu_photo_path
        @endphp
        @else
        @php
        $img = 'images/b1.png'
        @endphp
        @endif
        <td><img class="rounded-circle" width="50px" src="{{ asset('storage/' . $img)}}" alt="" srcset=""></td>
        <td>
            <form action="{{ route('menu.destroy',['menu'=>$menu->id]) }}" method="POST">
                <a class="btn btn-info" href="{{ route('menu.show',$menu->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('menu.edit',$menu->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning" href="{{ route('mahasiswa.khs',$menu->id) }}">Nilai</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $paginate->links()}}
@endsection