<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Decoration Rental - Profile</title>
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
    
    <!-- Header -->
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
            <li class="nav-item"><a href="{{ route('decor') }}" class="nav-link">Decoration</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
          
            @auth('web')
              <li class="nav-item active"><a href="{{ route('profile') }}" class="nav-link">Profile</a></li>
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
    <!-- END Header -->

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/decor-4.jpeg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Profile <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Profile</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4 ftco-animate text-center">
            <img src="{{ Auth::guard('web')->user()->image ? asset('storage/' . Auth::guard('web')->user()->image) : asset('images/default.jpg') }}" alt="Profile Image" class="img-fluid rounded-circle mb-3">
            <form action="{{ route('user.upload-image', Auth::guard('web')->user()->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                @csrf
                @method('PUT')
                <div class="form-group ml-5">
                    <input type="file" class="form-control-file" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-info">Upload Image</button>
            </form>
          </div>
          <div class="col-md-8 ftco-animate d-flex align-items-center">
            <div class="flex-grow-1">
              <div id="profileInfo" class="mt-1">
                <h1>{{ Auth::guard('web')->user()->name }}</h1>
                <hr>
                <p>Email: {{ Auth::guard('web')->user()->email ? Auth::guard('web')->user()->email : 'Mohon masukkan data Anda' }}</p>
                <p>Phone: {{ Auth::guard('web')->user()->phone ? Auth::guard('web')->user()->phone : 'Mohon masukkan data Anda' }}</p>
                <p>Location: {{ Auth::guard('web')->user()->address ? Auth::guard('web')->user()->address : 'Mohon masukkan data Anda' }}</p>
                <button class="btn btn-primary" id="editProfileBtn">Edit Profile</button>
              </div>
              <div id="editProfileForm" style="display: none;">
                <h3>Edit Profile</h3>
                <form action="{{ route('user.update', Auth::guard('web')->user()->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" value="{{ Auth::guard('web')->user()->name }}" required>
                  </div>
                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" value="{{ Auth::guard('web')->user()->email }}" required>
                  </div>
                  <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" name="phone" value="{{ Auth::guard('web')->user()->phone }}">
                  </div>
                  <div class="form-group">
                      <label for="address">Location</label>
                      <input type="text" class="form-control" name="address" value="{{ Auth::guard('web')->user()->address }}">
                  </div>
                  <div class="form-group">
                      <label for="password">New Password</label>
                      <input type="text" class="form-control" name="password" placeholder="New Password">
                  </div>
                  <button type="submit" class="btn btn-success">Save Changes</button>
                  <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancel</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-md-12 ftco-animate">
            <h4>Your Booking Rentals</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Package Name</th>
                    <th class="p-3">Event Location</th>
                    <th class="p-3">Event Start Date</th>
                    <th class="p-3">Event End Date</th>
                    <th class="p-3">Event Start Time</th>
                    <th class="p-3">Event End Time</th>
                    <th class="p-3">Total Cost</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @if($transaksi->isEmpty())
                    <tr>
                      <td colspan="10" class="text-center">No bookings found.</td>
                    </tr>
                  @else
                    @foreach($transaksi as $t)
                      <tr>
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $t->paket->nama_paket }}</td>
                        <td class="p-3">{{ $t->event_location }}</td>
                        <td class="p-3">{{ $t->event_start_date }}</td>
                        <td class="p-3">{{ $t->event_end_date }}</td>
                        <td class="p-3">{{ $t->event_start_time }}</td>
                        <td class="p-3">{{ $t->event_end_time }}</td>
                        <td class="p-3">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                        <td class="p-3">{{ ucfirst($t->status) }}</td>
                        <td class="p-3">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTransactionModal{{ $t->id }}">
                            Edit
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
        <!-- Modal placed outside the table -->
        @foreach($transaksi as $t)
        <div class="modal fade" id="editTransactionModal{{ $t->id }}" tabindex="-1" aria-labelledby="editTransactionModalLabel{{ $t->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTransactionModalLabel{{ $t->id }}">Edit Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi.update', $t->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="transaksi_id{{ $t->id }}" name="id" value="{{ $t->id }}">
                            <div class="mb-3">
                                <label for="paket_id{{ $t->id }}" class="form-label">Package Name</label>
                                <select class="form paketSelect" id="paket_id{{ $t->id }}" name="paket_id" required>
                                    @foreach($pakets as $paket) <!-- Assuming $pakets contains all available packages -->
                                    <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}" {{ $t->paket_id == $paket->id ? 'selected' : '' }}>
                                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="event_location{{ $t->id }}" class="form-label">Event Location</label>
                                <input type="text" class="form-control" id="event_location{{ $t->id }}" name="event_location" value="{{ $t->event_location }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_start_date{{ $t->id }}" class="form-label">Event Start Date</label>
                                <input type="date" class="form-control eventStartDate" id="event_start_date{{ $t->id }}" name="event_start_date" value="{{ $t->event_start_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_start_time{{ $t->id }}" class="form-label">Event Start Time</label>
                                <input type="time" class="form-control" id="event_start_time{{ $t->id }}" name="event_start_time" value="{{ $t->event_start_time }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_end_date{{ $t->id }}" class="form-label">Event End Date</label>
                                <input type="date" class="form-control eventEndDate" id="event_end_date{{ $t->id }}" name="event_end_date" value="{{ $t->event_end_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="event_end_time{{ $t->id }}" class="form-label">Event End Time</label>
                                <input type="time" class="form-control" id="event_end_time{{ $t->id }}" name="event_end_time" value="{{ $t->event_end_time }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="totalDisplay{{ $t->id }}" class="form-label">Total Cost</label>
                                <input type="text" class="form-control totalDisplay" id="totalDisplay{{ $t->id }}" disabled>
                                <input type="hidden" class="totalHidden" id="totalHidden{{ $t->id }}" name="total">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                <li><a href="#" class="py-2 d-block">Privacy & Cookies Policy</a></li>
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
    <!-- END Footer -->

    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
    
    <script>
      document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('profileInfo').style.display = 'none';
        document.getElementById('editProfileForm').style.display = 'block';
      });
    
      document.getElementById('cancelEditBtn').addEventListener('click', function() {
        document.getElementById('editProfileForm').style.display = 'none';
        document.getElementById('profileInfo').style.display = 'block';
      });

      document.addEventListener('DOMContentLoaded', function() {
        const paketSelects = document.querySelectorAll('.paketSelect');
        const totalDisplays = document.querySelectorAll('.totalDisplay');
        const totalHiddens = document.querySelectorAll('.totalHidden');
        const eventStartDates = document.querySelectorAll('.eventStartDate');
        const eventEndDates = document.querySelectorAll('.eventEndDate');

        // Fungsi untuk menghitung jumlah hari sewa
        function calculateDaysBetween(startDate, endDate) {
          const start = new Date(startDate);
          const end = new Date(endDate);
          const timeDiff = end - start;
          const daysDiff = timeDiff / (1000 * 60 * 60 * 24); // Konversi ms ke hari
          return daysDiff > 0 ? daysDiff + 1 : 1; // Minimal sewa 1 hari
        }

        // Fungsi untuk mengupdate total biaya
        function updateTotalCost(index) {
          const paketSelect = paketSelects[index];
          const totalDisplay = totalDisplays[index];
          const totalHidden = totalHiddens[index];
          const eventStartDate = eventStartDates[index];
          const eventEndDate = eventEndDates[index];

          // Mendapatkan paket yang dipilih
          const selectedOption = paketSelect.options[paketSelect.selectedIndex];
          const paketHarga = selectedOption.getAttribute('data-harga'); // Ambil harga per hari

          // Ambil tanggal mulai dan selesai
          const startDate = eventStartDate.value;
          const endDate = eventEndDate.value;

          // Hitung jumlah hari sewa
          let days = calculateDaysBetween(startDate, endDate);

          // Hitung total biaya
          let totalCost = paketHarga * days;

          // Update tampilan harga total
          totalDisplay.value = `Rp ${new Intl.NumberFormat('id-ID').format(totalCost)}`;
          totalHidden.value = totalCost; // Simpan ke input hidden
        }

        // Panggil fungsi saat dropdown paket atau tanggal berubah
        paketSelects.forEach((paketSelect, index) => {
          paketSelect.addEventListener('change', function() {
            updateTotalCost(index);
          });
        });

        eventStartDates.forEach((eventStartDate, index) => {
          eventStartDate.addEventListener('change', function() {
            updateTotalCost(index);
          });
        });

        eventEndDates.forEach((eventEndDate, index) => {
          eventEndDate.addEventListener('change', function() {
            updateTotalCost(index);
          });
        });

        // Inisialisasi dengan nilai awal saat halaman dimuat
        paketSelects.forEach((_, index) => updateTotalCost(index));
      });
    </script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
