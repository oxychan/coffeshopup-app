@extends('layouts.allMenuLayout')

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
				<div id="paginate_data">
					@include('user.beverage-paginate')
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div id="food-menus">
					@include('user.food-paginate')
				</div>
			</div>
			
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
	<script>
		$(document).ready( function() {
			// getBeverageData();
			// getFoodData();

			function getBeverageData(query = '', page) {
				$.ajax({
					type: "GET",
					url: "/all-menus/beverages?page=" + page,
					data: {query:query},
					success: function(data) {					
						$('#paginate_data').html('');	
						$('#paginate_data').html(data);
					}
				});
			}

			function getFoodData(query = '', page) {
				$.ajax({
					type: "GET",
					url: "/all-menus/foods?page=" + page,
					data: {query: query},
					success: function(data) {
						$('#food-menus').html('');
						$('#food-menus').html(data);	
					}
				});
			}

			$(document).on('keyup', '#search', function() {
				var query = $(this).val();				
				
				if ($('#pills-home-tab').hasClass('active')) {
					var page = $('#hidden_page_beverage').val();
					getBeverageData(query, page);
				} else {
					var page = $('#hidden_page_food').val();
					getFoodData(query, page);
				}
			});

			function convertIDR(number) {
				return number.toLocaleString('id-ID', { 
					style: 'currency', 
					currency: 'IDR' 
				});
			}

			$(document).on('click', '.pagination a', function(event) {
				event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				var query = $('#query').val();
				

				if ($('#pills-home-tab').hasClass('active')) {
					$('#hidden_page_beverage').val = page;
					getBeverageData(query, page);
				} else {
					$('#hidden_page_food').val = page;
					getFoodData(query, page);
				}
				                                                            
			}) ;

			function showModalMenu(id) {
				$.ajax({
					type: 'GET',
					url: '/menu/show/'+id,
					success: function(data) {
						$('.modal-body').html('');
						$('.modal-body').append(
							'<img src="/storage/' + data.menu.menu_photo_path + '" alt="menu" width="150px" heigh="150px"><br>\
							<strong>'+ data.menu.name + '</strong>\
							<p>Stock ' + data.menu.stock + '</p>\
							<input type="number" name="qty" id="qty">\
							<input type="button" value="Add to cart" class="btn btn-warning">'
						);

						$('#staticBackdrop').modal('show');
						
					}
				});
			}

			$(document).on('click', '.menu', function() {
				var data = $(this).data('menuid');
				showModalMenu(data);				
			}); 
			
		} );

	</script>
@endsection