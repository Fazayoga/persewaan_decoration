<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Data paket</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../css/demo.css" />
    <link rel="stylesheet" href="../vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="../vendor/js/helpers.js"></script>
    <script src="../js/admin/config.js"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="{{ route('index')}}" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('images/brand-logo.png') }}" alt="Logo D" width="25" height="25" /> <!-- Sesuaikan lebar dan tinggi sesuai kebutuhan -->
                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-0">ecoration</span>
              </a>
            
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>
            
            <div class="menu-inner-shadow"></div>
  
            <ul class="menu-inner py-1">
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Home</span>
              </li>
              <li class="menu-item">
                <a href="{{ route('index')}}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Dashboard</div>
                </a>
              </li>
              <!-- User interface -->
              <li class="menu-item active open">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-box"></i>
                  <div data-i18n="Data Master">Data Master</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item active">
                    <a href="{{ route('data-barang')}}" class="menu-link">
                      <div data-i18n="Data Paket">Data Paket</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('data-customer')}}" class="menu-link">
                      <div data-i18n="Data Customer">Data Customer</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="{{ route('data-transaksi')}}" class="menu-link">
                      <div data-i18n="Data Transaksi">Data Transaksi</div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>
              <!-- Cards -->
              <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-dock-top"></i>
                  <div data-i18n="Account Settings">Account Settings</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item">
                    <a href="{{ route('account')}}" class="menu-link">
                      <div data-i18n="Account">Account</div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </aside>
        <div class="layout-page">
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
          
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search Bar -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."/>
                </div>
              </div>
          
              <!-- Right-side Navbar Content -->
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                @auth('admin')
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                        <!-- Check if the admin has an image or fallback to avatar.png -->
                        <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/' . Auth::guard('admin')->user()->image) : asset('../img/avatars/1.png') }}" alt="Profile Image" class="w-px-40 h-auto rounded-circle"/>
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="#">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar avatar-online">
                                <!-- Same fallback to avatar.png inside dropdown -->
                                <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/' . Auth::guard('admin')->user()->image) : asset('../img/avatars/1.png') }}" alt="Profile Image" class="w-px-40 h-auto rounded-circle"/>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <span class="fw-semibold d-block">{{ Auth::guard('admin')->user()->name }}</span>
                              <small class="text-muted">{{ Auth::guard('admin')->user()->user_type }}</small>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ route('logout-admin') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="bx bx-power-off me-2"></i>
                          <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout-admin') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                      </li>
                    </ul>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login-admin') }}">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register-admin') }}">Register</a>
                  </li>
                @endauth
              </ul>
            </div>
          </nav>

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Data Paket</h4>
              @auth('admin')
              <div class="card">
                <h5 class="card-header">Decoration List</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Decoration Image</th>
                        <th>Decoration Package</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if($pakets->isEmpty())
                        <tr>
                          <td colspan="10" class="text-center">No bookings found.</td>
                        </tr>
                      @else
                        @foreach($pakets as $paket)
                          <tr>
                            <td>
                              <img src="{{ $paket->gambar ? asset($paket->gambar) : asset('images/default.jpg') }}" 
                                  alt="{{ $paket->nama_paket }}" 
                                  class="img-fluid rounded" 
                                  style="width: 150px; height: 150px; object-fit: cover;" />
                            </td>
                            <td><strong>{{ $paket->nama_paket }}</strong></td>
                            <td>{{ $paket->deskripsi }}</td>
                            <td>Rp. {{ number_format($paket->harga, 0, ',', '.') }}</td>
                            <td>
                              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                      data-bs-target="#editPaketModal" 
                                      data-id="{{ $paket->id }}" 
                                      data-nama="{{ $paket->nama_paket }}" 
                                      data-deskripsi="{{ $paket->deskripsi }}" 
                                      data-harga="{{ $paket->harga }}" 
                                      data-gambar="{{ $paket->gambar }}">
                                  Edit
                              </button>
                              <form action="{{ route('paket.delete', $paket->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div><br>
              @else
              <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Please Log In</h6>
                  <p class="mb-0">You must log in to access this page. Please log in first.</p>
              </div>
              @endauth
              @auth('admin')
              <div class="mb-3">
                <a href="{{ route('paket.create') }}" class="btn btn-primary">Tambah Paket</a>
              </div>
              @endauth
              <hr class="my-5" />
            </div>
            <div class="modal fade" id="editPaketModal" tabindex="-1" aria-labelledby="editPaketModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="editPaketForm" action="{{ route('paket.update', 'id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="editPaketModalLabel">Edit Paket</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="editNamaPaket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="editNamaPaket" name="nama_paket" required>
                      </div>
                      <div class="mb-3">
                        <label for="editDeskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3" required></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="editHarga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="editHarga" name="harga" required>
                      </div>
                      <div class="mb-3">
                        <label for="editGambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="editGambar" name="gambar">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  Copyright &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  <a href="{{ route('index') }}" target="_blank" class="footer-link fw-bolder">Decoration Rental</a>
                </div>
              </div>
            </footer>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="../vendor/libs/jquery/jquery.js"></script>
    <script src="../vendor/libs/popper/popper.js"></script>
    <script src="../vendor/js/bootstrap.js"></script>
    <script src="../vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/js/menu.js"></script>
    <script src="../js/admin/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
      // Populate modal with data when edit button is clicked
      const editPaketModal = document.getElementById('editPaketModal');
      editPaketModal.addEventListener('show.bs.modal', event => {
          const button = event.relatedTarget;
          const id = button.getAttribute('data-id');
          const nama = button.getAttribute('data-nama');
          const deskripsi = button.getAttribute('data-deskripsi');
          const harga = button.getAttribute('data-harga');
          const gambar = button.getAttribute('data-gambar');
  
          const form = editPaketModal.querySelector('#editPaketForm');
          form.action = form.action.replace('id', id);
          form.querySelector('#editNamaPaket').value = nama;
          form.querySelector('#editDeskripsi').value = deskripsi;
          form.querySelector('#editHarga').value = harga;
          form.querySelector('#editGambar').value = ''; // reset file input
      });
  </script>
  </body>
</html>
