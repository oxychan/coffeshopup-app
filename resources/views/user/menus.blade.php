@extends('layouts.masterLayout')

@section('container')
<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="menu-area pt-4" id="coffee">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<form action="#">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Search . . . " name="search">
					<button class="btn btn-default" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
			</form>
		</div>
		{{-- <div class="row jsutify-content-end">
			<div class="col-md-12 mb-3 d-flex justify-content-end">
				<a href="#" class="primary-btn text-uppercase">Show More</a>
			</div>
		</div>
		<div class="row">
			@foreach ($menus as $menu)
				<div class="col-lg-4" id="menu" onclick="window.location.href = '/test/{{ $menu->id }}'" style="height: 230px !important">
					<div class="single-menu">
						<div class="row">
							<div class="col-md-6">
								<img src="/storage/{{ $menu->menu_photo_path }}" alt="menu" width="150px" height="150px">
							</div>
							<div class="col-md-6">
								<h4>{{ substr($menu->name, 0, 25) }}</h4>
								<hr>
								<span><strong>Stock : </strong>{{ $menu->stock }}</span><br>
								<span><strong>Rp. {{ $menu->price }}</strong></span>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div> --}}
	</div>
</section>
@endsection