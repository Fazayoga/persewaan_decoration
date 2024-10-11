<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport"content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Account Admin</title>
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
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Home</span>
          </li>
          <ul class="menu-inner py-1">
            <li class="menu-item">
              <a href="{{ route('index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Data Master">Data Master</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('data-barang') }}" class="menu-link">
                    <div data-i18n="Data Paket">Data Paket</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('data-customer')}}" class="menu-link">
                    <div data-i18n="Data Customer">Data Customer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('data-transaksi') }}" class="menu-link">
                    <div data-i18n="Data Transaksi">Data Transaksi</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Account</span>
            </li>
            <li class="menu-item active open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
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
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."/>
                </div>
              </div>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                @auth('admin')
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                  </ul>
                  @auth('admin')
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/' . Auth::guard('admin')->user()->image) : asset('images/default.jpg') }}" alt="user-avatar" class="d-block rounded" height="100" width="100"/>
                        <div class="button-wrapper">
                          <form id="image-form" action="{{ route('admin.upload-image', Auth::guard('admin')->user()->id) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Upload new photo</span>
                                  <i class="bx bx-upload d-block d-sm-none"></i>
                                  <input type="file" id="upload" class="account-file-input" name="image" hidden accept="image/*" onchange="document.getElementById('image-form').submit();"/>
                              </label>
                          </form>
                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB.</p>
                        </div>                        
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action="{{ route('admin.update', Auth::guard('admin')->user()->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ Auth::guard('admin')->user()->name }}" autofocus required />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="{{ Auth::guard('admin')->user()->username }}" autofocus required />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="email" id="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" placeholder="username12@example.com" required />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input class="form-control" type="text" id="phone" name="phone" value="{{ Auth::guard('admin')->user()->phone }}" placeholder="081234567890" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" type="text" id="address" name="address" value="{{ Auth::guard('admin')->user()->address }}" placeholder="Jl. Contoh Alamat No.1" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">New Password (leave empty if not changing)</label>
                            <input class="form-control" type="text" id="password" name="password" placeholder="New Password" />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>                          
                  </div>
                  <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" action="{{ route('admin.delete', Auth::guard('admin')->user()->id) }}" method="POST">
                        @csrf
                        @method('DELETE') 
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" required />
                          <label class="form-check-label" for="accountActivation">
                            I confirm my account deactivation
                          </label>
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                  @else
                  <div class="alert alert-warning">
                      <h6 class="alert-heading fw-bold mb-1">Please Log In</h6>
                      <p class="mb-0">You must log in to access this page. Please log in first.</p>
                  </div> 
                  @endauth                
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
    <script src="../js/admin/pages-account-settings-account.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>