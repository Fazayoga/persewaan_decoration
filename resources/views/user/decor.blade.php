<!DOCTYPE html>
<html lang="en">
  	<head>
		<title>Decoration Rental</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/animate.css')}}">
		<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">
		<link rel="stylesheet" href="{{ asset('css/aos.css')}}">
		<link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css')}}">
		<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css')}}">
		<link rel="stylesheet" href="{{ asset('css/flaticon.css')}}">
		<link rel="stylesheet" href="{{ asset('css/icomoon.css')}}">
		<link rel="stylesheet" href="{{ asset('css/style.css')}}">
	</head>
<body>

		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">Decoration<span> Rental</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
					<li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
					<li class="nav-item active"><a href="{{ route('decor') }}" class="nav-link">Decoration</a></li>
					<li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
				
					@auth('web')
					<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link">Profile</a></li>
					<li class="nav-item">
						<a href="{{ route('logout') }}" class="nav-link"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
						</form>
					</li>
					@else
					<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
					@endauth
			  	</ul>
	      	</div>
	    </div>
	</nav>
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/decor-5.jpeg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Decors <i class="ion-ios-arrow-forward"></i></span></p>
				<h1 class="mb-3 bread">Choose Your Decor</h1>
			</div>
			</div>
		</div>
    </section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row">
				@if($pakets->isEmpty())
					<div class="col text-center">
						<p>Data belum tersedia</p>
					</div>
				@else
					@foreach($pakets as $paket)
						<div class="col-md-4">
							<div class="car-wrap rounded ftco-animate">
								<div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset($paket->gambar) }}');"></div>
								<div class="text">
									<h2 class="mb-0"><a href="#" onclick="showDetails({{ $paket->id }}, '{{ $paket->nama_paket }}', '{{ asset($paket->gambar) }}', '{{ $paket->harga }}', '{{ $paket->deskripsi }}')">{{ $paket->nama_paket }}</a></h2>
									<div class="d-flex mb-3">
										<span class="cat">{{ $paket->nama_paket }}</span>
										<p class="price ml-auto">
											@if($paket->harga >= 999999)
												Rp {{ number_format($paket->harga / 1000000, 1, ',', '.') }} Jt
											@else
												Rp {{ number_format($paket->harga, 0, ',', '.') }}
											@endif
											<span>/day</span>
										</p>
									</div>
									@auth('web')
									<p class="d-flex mb-0 d-block">
										<a href="#" class="btn btn-primary py-2 mr-1" onclick="openBookingModal({{ $paket->id }})">Book now</a>
										<a href="#" class="btn btn-secondary py-2 ml-1" onclick="showDetails({{ $paket->id }}, '{{ $paket->nama_paket }}', '{{ asset($paket->gambar) }}', '{{ $paket->harga }}', '{{ $paket->deskripsi }}')">Details</a>
									</p>
									@endauth
								</div>
							</div>
						</div>
						<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="detailModalLabel">Package Details</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p id="modal-content">Loading details...</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" onclick="openBookingModal({{ $paket->id }})">Book now</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="bookingModalLabel">Make Your Booking</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="{{ route('transaksi.decor-store') }}" method="POST" class="request-form ftco-animate bg-primary" id="rentalForm">
											@csrf
											<h2>Make your trip</h2>
											<input type="hidden" name="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : '' }}">
											<div class="form-group">
												<label for="event_location" class="label">Event location</label>
												<input type="text" class="form-control" name="event_location" placeholder="City, Airport, Station, etc" required>
											</div>
											<div class="d-flex">
												<div class="form-group mr-2">
													<label for="event_start_date" class="label">Event Starts date</label>
													<input type="date" class="form-control" name="event_start_date" required>
												</div>
												<div class="form-group ml-2">
													<label for="event_end_date" class="label">Event Ends date</label>
													<input type="date" class="form-control" name="event_end_date" required>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="label">Event Start time</label>
												<input type="time" class="form-control" name="event_start_time" required>
											</div>
											<div class="form-group">
												<label for="" class="label">Event End time</label>
												<input type="time" class="form-control" name="event_end_time" required>
											</div>
											<div class="form-group">
												<label for="paket_id" class="label">Select Item</label>
												<select name="paket_id" class="form-control" required>
													<option value="" disabled selected>Select an item</option>
													@if(isset($pakets) && $pakets->isNotEmpty())
														@foreach($pakets as $paket)
															<option class="label text-dark" value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">
																{{ $paket->nama_paket }} -
																@if($paket->harga >= 999999)
																	Rp {{ number_format($paket->harga / 1000000, 1, ',', '.') }} Juta
																@else
																	Rp {{ number_format($paket->harga, 0, ',', '.') }}
																@endif
															</option>
														@endforeach
													@else
														<option value="" disabled>No items available</option>
													@endif
												</select>
											</div>										
											<div class="form-group">
												<button type="button" class="btn btn-secondary py-3 px-4" data-toggle="modal" data-target="#confirmationModal">Rent A Decor Now</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
							  <h5 class="modal-title" id="confirmationModalLabel">Order Confirmation</h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
							  <p>Thank you for your order! Please confirm to proceed with your booking.</p>
							  <p>
								<a href="#" id="whatsappLink" class="btn btn-primary" target="_blank">WhatsApp Confirmation</a>
							  </p>
							  <button type="button" class="btn btn-success" id="confirmOrder">Confirm and Proceed</button>
							</div>
						  </div>
						</div>
					  </div>
					</div>
				@endif
			</div>
			<div class="row mt-5">
				<div class="col text-center">
					<div class="block-27">
						<ul>
							<li class="{{ $pakets->onFirstPage() ? 'disabled' : '' }}">
								<a href="{{ $pakets->previousPageUrl() }}">&lt;</a>
							</li>
							@for($i = 1; $i <= $pakets->lastPage(); $i++)
								<li class="{{ $i === $pakets->currentPage() ? 'active' : '' }}">
									<a href="{{ $pakets->url($i) }}">{{ $i }}</a>
								</li>
							@endfor
							<li class="{{ $pakets->hasMorePages() ? '' : 'disabled' }}">
								<a href="{{ $pakets->nextPageUrl() }}">&gt;</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>	

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="{{ route('home') }}" class="logo">Decoration<span> Rental</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
			<div class="col-md-12 text-center">
			  <p>Copyright &copy;
				<script>document.write(new Date().getFullYear());</script> 
				Decoration Rental
			  </p>
			</div>
		  </div>
      </div>
    </footer>
    
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

	<script src="js/user/jquery.min.js"></script>
	<script src="js/user/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/user/popper.min.js"></script>
	<script src="js/user/bootstrap.min.js"></script>
	<script src="js/user/jquery.easing.1.3.js"></script>
	<script src="js/user/jquery.waypoints.min.js"></script>
	<script src="js/user/jquery.stellar.min.js"></script>
	<script src="js/user/owl.carousel.min.js"></script>
	<script src="js/user/jquery.magnific-popup.min.js"></script>
	<script src="js/user/aos.js"></script>
	<script src="js/user/jquery.animateNumber.min.js"></script>
	<script src="js/user/bootstrap-datepicker.js"></script>
	<script src="js/user/jquery.timepicker.min.js"></script>
	<script src="js/user/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/user/google-map.js"></script>
	<script src="js/user/main.js"></script>
	<script>
		$(document).ready(function() {
			function calculateTotalCost() {
			const selectedPaket = $('select[name="paket_id"] option:selected');
			const pricePerDay = selectedPaket.data('harga'); // Ambil harga per hari dari data atribut
			const startDate = new Date($('input[name="event_start_date"]').val());
			const endDate = new Date($('input[name="event_end_date"]').val());
			
			const timeDifference = endDate.getTime() - startDate.getTime();
			const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)) + 1; // Menambahkan 1 agar termasuk hari pertama

			const totalCost = pricePerDay * daysDifference;

			console.log('Total Cost:', totalCost);

			$('#totalCost').text(`Total Cost: Rp. ${new Intl.NumberFormat().format(totalCost)}`);
			return totalCost;
			}

			$('input[name="event_end_date"]').on('change', function() {
			calculateTotalCost();
			});
			
			$('#confirmationModal').on('show.bs.modal', function (event) {
			const form = $('#rentalForm');
			const formData = form.serializeArray();
			const name = formData.find(field => field.name === 'user_id').value;
			const eventLocation = formData.find(field => field.name === 'event_location').value;
			const startDate = formData.find(field => field.name === 'event_start_date').value;
			const startTime = formData.find(field => field.name === 'event_start_time').value;
			const endTime = formData.find(field => field.name === 'event_end_time').value;
			const selectedPaket = $('select[name="paket_id"] option:selected');
			const totalCost = calculateTotalCost();

			const whatsappUrl = `http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0ACustomer%20Name:%20${encodeURIComponent(name)}%0AEvent%20Location:%20${encodeURIComponent(eventLocation)}%0AEvent%20Rental%20Date:%20${encodeURIComponent(startDate)}%0AEvent%20Rental%20Start%20Time:%20${encodeURIComponent(startTime)}%0AEvent%20Rental%20End%20Time:%20${encodeURIComponent(endTime)}%0ATotal%20Cost:%20Rp.%20${encodeURIComponent(totalCost)}`;

			$('#whatsappLink').attr('href', whatsappUrl);
			});
			$('#confirmOrder').on('click', function(event) {
				event.preventDefault(); 
				$('#confirmationModal').modal('hide'); 
				$('#rentalForm').submit();
			});
		});

		function showDetails(id, name, image, price, description) {
			document.getElementById('modal-content').innerHTML = `
				<img src="${image}" alt="${name}" class="img-fluid">
				<h3>${name}</h3>
				<p>${description}</p>
				<p>Price: Rp ${new Intl.NumberFormat().format(price)}</p>
			`;
			$('#detailModal').modal('show');
		}
		function openBookingModal() {
			$('#bookingModal').modal('show');
		}

		function handleSelectChange(selectElement) {
			const selectedId = selectElement.value; // Get the selected ID
			const selectedText = selectElement.options[selectElement.selectedIndex].text; // Get the selected option text
			document.getElementById("selectedId").innerText = `Selected ID: ${selectedId} (${selectedText})`;
			// Here you can also update other UI elements if needed
		}
		function openBookingModal(packageId) {
			// Set nilai select paket_id berdasarkan packageId yang diterima
			$('select[name="paket_id"]').val(packageId);
			
			// Trigger change event untuk memastikan perhitungan dilakukan setelah memilih paket
			$('select[name="paket_id"]').trigger('change');
			
			// Tampilkan modal pemesanan
			$('#bookingModal').modal('show');
		}
	</script>	
	</body>
</html>