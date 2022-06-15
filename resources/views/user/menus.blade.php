@extends('layouts.masterLayout')

@section('container')
<div class="d-flex" style="height: 74px; background-color: rgba(20, 2, 0, 0.8);"></div>
<section class="menu-area pt-4" id="coffee">
	<div class="container">
		<div class="row d-flex justify-content-center">
			<form action="#" method="GET">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Search . . . " name="query" id="search">
					<button class="btn btn-default" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
			</form>
		</div>

		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<div class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
					<span><i class="fa-solid fa-cup-togo"></i></span>
					Beverage
				</div>
			</li>
			<li class="nav-item" role="presentation">
			  <div class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
					Food
			  </div>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="row all-menus" id="beverage-menus">

				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="row all-menus" id="food-menus">

				</div>
			</div>
			
		</div>
		<div class="row" id="menu">
				
		</div>
	</div>
</section>
@endsection

@section('scripts')
	<script>
		$(document).ready( function() {
			getBeverageData();
			getFoodData();

			function getBeverageData(query = '') {
				$.ajax({
					type: "GET",
					url: "/all-menus/beverages",
					data: {query:query},
					dataType: "json",
					success: function(data) {					
						$('#beverage-menus').html('');	
						$.each(data.menus, function (key, menu) {
							$('#beverage-menus').append(
								'<div class="col-sm-4" id="menu" >\
									<div class="single-menu">\
										<div class="row">\
											<div class="col-md-6">\
												<img src="' + menu.menu_photo_path + '" alt="menu" width="150px" height="150px">\
											</div>\
											<div class="col-md-6">\
												<h4>'+ menu.name + '</h4>\
												<hr>\
												<span><strong>Stock : </strong>' + menu.stock +' </span><br>\
												<span><strong>Rp.' + menu.price + '</strong></span>\
											</div>\
										</div>\
									</div>\
								</div>'
							);
						});							
					}
				});
			}

			function getFoodData(query = '') {
				$.ajax({
					type: "GET",
					url: "/all-menus/foods",
					dataType: "json",
					data: {query: query},
					success: function(data) {
						$('#food-menus').html('');	
						$.each(data.menus, function(key, menu) {
							$('#food-menus').append(
								'<div class="col-sm-4" id="menu" >\
									<div class="single-menu">\
										<div class="row">\
											<div class="col-md-6">\
												<img src="' + menu.menu_photo_path + '" alt="menu" width="150px" height="150px">\
											</div>\
											<div class="col-md-6">\
												<h4>'+ menu.name + '</h4>\
												<hr>\
												<span><strong>Stock : </strong>' + menu.stock +' </span><br>\
												<span><strong>Rp.' + menu.price + '</strong></span>\
											</div>\
										</div>\
									</div>\
								</div>'
							);
						});
					}
				});
			}

			$(document).on('keyup', '#search', function() {
				var query = $(this).val();
				if ($('#pills-home-tab').hasClass('active')) {
					getBeverageData(query);
				} else {
					getFoodData(query);
				}
			});
		} );

	</script>
@endsection