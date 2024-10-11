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
            <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
            <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
            <li class="nav-item"><a href="{{ route('decor') }}" class="nav-link">Decoration</a></li>
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
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg-decor.jpeg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4">Fast &amp; Easy Way To Rent A Decoration</h1>
	            <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts</p>
	            <a href="https://www.youtube.com/watch?v=4nfq18MG7Mo" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
	            	<div class="icon d-flex align-items-center justify-content-center">
	            		<span class="ion-ios-play"></span>
	            	</div>
	            	<div class="heading-title ml-5">
		            	<span>Easy steps for renting a decoration</span>
	            	</div>
	            </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-md-12 featured-top">
            <div class="row no-gutters">
              <div class="col-md-4 d-flex align-items-center">
                <form action="{{ route('transaksi.store') }}" method="POST" class="request-form ftco-animate bg-primary" id="rentalForm">
                  @csrf
                  <h2>Make your trip</h2>
                  <input type="hidden" name="user_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->name : '' }}">
                  <div class="form-group">
                      <label for="" class="label">Event location</label>
                      <input type="text" class="form-control" name="event_location" placeholder="City, Airport, Station, etc" required>
                  </div>
                  <div class="d-flex">
                      <div class="form-group mr-2">
                          <label for="" class="label">Event Starts date</label>
                          <input type="date" class="form-control" name="event_start_date" required>
                      </div>
                      <div class="form-group ml-2">
                          <label for="" class="label">Event Ends date</label>
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
                  @auth('web')
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary py-3 px-4" data-toggle="modal" data-target="#confirmationModal">Rent A Decor Now</button>
                  </div>
                  @endauth
                </form>
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
              <div class="col-md-8 d-flex align-items-center">
                <div class="services-wrap rounded-right w-100">
                  <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Decorations</h3>
                  <div class="row d-flex mb-4">
                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                      <div class="services w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                          <div class="text w-100">
                            <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                          </div>
                        </div>      
                      </div>
                      <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                        <div class="services w-100 text-center">
                          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                          <div class="text w-100">
                            <h3 class="heading mb-2">Select the Best Deal</h3>
                          </div>
                        </div>      
                      </div>
                      <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                        <div class="services w-100 text-center">
                          <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                            <div class="text w-100">
                              <h3 class="heading mb-2">Reserve Your Rental Decor</h3>
                            </div>
                          </div>      
                        </div>
                      </div>
                      <p><a href="{{ route('decor') }}" class="btn btn-primary py-3 px-4">Reserve Your Perfect Decor</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-no-pt bg-light">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">What we offer</span>
                <h2 class="mb-2">Featured Decorations</h2>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="carousel-car owl-carousel">
              @if($pakets->isEmpty())
                <div class="col text-center">
                  <p>Data belum tersedia</p>
                </div>
              @else
                @foreach($pakets as $paket)
                  <div class="item">
                    <div class="car-wrap rounded ftco-animate">
                      <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset($paket->gambar) }}');">
                      </div>
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
                      </div>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section ftco-about">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/decor-1.jpeg);">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">About us</span>
	            <h2 class="mb-4">Welcome to Decoration Rental</h2>

	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p>On her way she met a copy. The copy warned the Little Blind Text, 
                that where it came from it would have been rewritten a thousand times and 
                everything that was left from its origin would be the word "and" and 
                the Little Blind Text should turn around and return to its own, safe country. 
                A small river named Duden flows by their place and supplies it with the necessary regelialia. 
                It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p><a href="{{ route('decor') }}" class="btn btn-primary py-3 px-4">Search Decor</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Services</span>
            <h2 class="mb-3">Our Latest Services</h2>
          </div>
        </div>
				<div class="row">
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Wedding Ceremony</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">City Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Airport Transfer</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
					<div class="col-md-3">
						<div class="services services-2 w-100 text-center">
            	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
            	<div class="text w-100">
                <h3 class="heading mb-2">Whole City Tour</h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section ftco-intro" style="background-image: url(images/bg-decor.jpeg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-end">
					<div class="col-md-6 heading-section heading-section-white ftco-animate">
            <h2 class="mb-3">Do You Want To Earn With Us? So Don't Be Late.</h2>
            <a href="{{ route('decor') }}" class="btn btn-primary btn-lg">Become A Decoration</a>
          </div>
				</div>
			</div>
		</section>

    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row">
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="60">0</strong>
                <span>Year <br>Experienced</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="1090">0</strong>
                <span>Total <br>Decor</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text text-border d-flex align-items-center">
                <strong class="number" data-number="2590">0</strong>
                <span>Happy <br>Customers</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text d-flex align-items-center">
                <strong class="number" data-number="67">0</strong>
                <span>Total <br>Branches</span>
              </div>
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
              <h2 class="ftco-heading-2"><a href="{{ route('home')}}" class="logo">Decoration<span> Rental</span></a></h2>
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
    </script>
  </body>
</html>