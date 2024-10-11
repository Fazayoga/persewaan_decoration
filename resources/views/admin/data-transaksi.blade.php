<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Data Transaksi</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                            <img src="{{ asset('images/brand-logo.png') }}" alt="Logo D" width="25" height="25" />
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
                    <li class="menu-item active open">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div data-i18n="Data Master">Data Master</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('data-barang')}}" class="menu-link">
                                    <div data-i18n="Data Paket">Data Paket</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('data-customer')}}" class="menu-link">
                                    <div data-i18n="Data Customer">Data Customer</div>
                                </a>
                            </li>
                            <li class="menu-item active">
                                <a href="{{ route('data-transaksi')}}" class="menu-link">
                                    <div data-i18n="Data Transaksi">Data Transaksi</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>
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
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            @auth('admin')
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/' . Auth::guard('admin')->user()->image) : asset('../img/avatars/1.png') }}" alt="Profile Image" class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ Auth::guard('admin')->user()->image ? asset('storage/' . Auth::guard('admin')->user()->image) : asset('../img/avatars/1.png') }}" alt="Profile Image" class="w-px-40 h-auto rounded-circle" />
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
                                        <a class="dropdown-item" href="{{ route('logout-admin') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Data Transaksi</h4>
                        @auth('admin')
                        <div class="card">
                            <h5 class="card-header">Data Transaksi</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Pelanggan</th>
                                            <th>Paket</th>
                                            <th>Lokasi Acara</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Akhir</th>
                                            <th>Waktu Mulai</th>
                                            <th>Waktu Akhir</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($transaksi->isEmpty())
                                            <tr>
                                                <td colspan="10" class="text-center">No bookings found.</td>
                                            </tr>
                                        @else
                                            @foreach($transaksi as $item)
                                            <tr>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->paket->nama_paket }}</td>
                                                <td>{{ $item->event_location }}</td>
                                                <td>{{ $item->event_start_date }}</td>
                                                <td>{{ $item->event_end_date }}</td>
                                                <td>{{ $item->event_start_time }}</td>
                                                <td>{{ $item->event_end_time }}</td>
                                                <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge bg-label-{{ 
                                                        $item->status === 'paid' ? 'success' : 
                                                        ($item->status === 'failed' ? 'danger' : 
                                                        ($item->status === 'cancelled' ? 'secondary' : 'warning')) 
                                                    }}">
                                                        {{ ucfirst($item->status) }}
                                                    </span>                                            
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" 
                                                            data-bs-target="#editTransaksiModal" 
                                                            data-id="{{ $item->id }}" 
                                                            data-status="{{ $item->status }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('transaksi.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
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
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Please Log In</h6>
                            <p class="mb-0">You must log in to access this page. Please log in first.</p>
                        </div>
                        @endauth
                        <hr class="my-5" />
                    </div>
                    
                    <div class="modal fade" id="editTransaksiModal" tabindex="-1" aria-labelledby="editTransaksiModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editTransaksiForm" action="#" method="POST"> <!-- Default action -->
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Transaksi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="editTransaksiId" name="id" value="">
                                        <div class="mb-3">
                                            <label for="editStatus" class="form-label">Status</label>
                                            <select class="form-select" id="editStatus" name="status" required>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="failed">Failed</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
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
                </div>
            </div>
        </div>
    </div>
    <script src="../vendor/libs/jquery/jquery.js"></script>
    <script src="../vendor/libs/popper/popper.js"></script>
    <script src="../vendor/js/bootstrap.js"></script>
    <script src="../vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/js/menu.js"></script>
    <script src="../js/admin/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Define the base URL for the update action
            var baseUrl = "{{ url('data-transaksi') }}";
    
            // Event listener for the edit button
            $('#editTransaksiModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var transaksiId = button.data('id'); // Get the transaction ID
                var status = button.data('status'); // Get the current status
    
                // Update the modal with the data retrieved
                var modal = $(this);
                modal.find('#editTransaksiId').val(transaksiId);
                modal.find('#editStatus').val(status);
                modal.find('form').attr('action', baseUrl + '/' + transaksiId); // Set the form action to update status
            });
        });
    </script>        
</body>
</html>