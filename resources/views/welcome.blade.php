<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KCP Shop</title>
  <link rel = "icon" href ="{{ asset('dist/img/logo_1.png')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}"/>
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"/>
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}"/>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('dist/img/logo_1.png')}} " height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard')}}" class="brand-link">
        <img src="{{ asset('dist/img/logo_1.png')}} " alt="AdminLTE Logo" class="brand-image" style="opacity: .9">
        <span class="brand-text font-weight-light">KCP Shop</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('dist/img/user2-160x160.jpg')}} " class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="{{ route('dashboard')}}" class="d-block">Halo, {{ Auth::user()->nama_user }} !</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{-- Administrator--}}
            @if(Auth::user()->id_role == 5 || 7 || 12 || 14 || 17)
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Administrator
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('user.index')}}" class="nav-link">
                        <p>Master User</p>
                      </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('master-role.index')}}" class="nav-link">
                        <p>Master Role</p>
                      </a>
                  </li>
                </ul>
              </li>
              @endif

              {{-- Master --}}
            @if(Auth::user()->id_role == 5 || 7 || 11 || 12 || 17 || 24)
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Master
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('master-part.index')}}" class="nav-link">
                        <p>Part</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('master-diskon.index')}}" class="nav-link">
                        <p>Part Diskon</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('master-sales.index')}}" class="nav-link">
                        <p>Toko Sales</p>
                      </a>
                  </li>
                </ul>
              </li>
            @endif

              {{-- Admin --}}
            @if(Auth::user()->id_role == 5 || 7 || 9 || 12 || 17)
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Admin
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('validasi-so.index')}}" class="nav-link">
                        <p>Validasi Sales Order</p>
                      </a>
                  </li>
                </ul>
              </li>
            @endif

            {{-- GUDANG --}}
            @if(Auth::user()->id_role == 3 || 5 || 7 || 8 || 10 || 12 || 13 || 17 || 18 || 19 || 21 || 22 || 23)
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Gudang
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('master-part.index')}}" class="nav-link">
                        <p>Master Part</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('kode-rak-lokasi.index')}}" class="nav-link">
                        <p>Master Kode Rak</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('stok-gudang.index')}}" class="nav-link">
                        <p>Stok Gudang</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('intransit.index')}}" class="nav-link">
                        <p>Intransit</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('packingsheet.index')}}" class="nav-link">
                        <p>Packingsheet / PS</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('laporan-kiriman-harian.index')}}" class="nav-link">
                        <p>Kiriman Harian / LKH</p>
                      </a>
                  </li>
                </ul>
              </li>
            @endif

              {{-- FINANCE --}}
              @if(Auth::user()->id_role == 2 || 5 || 6 || 7 || 11 || 12 || 17)
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Finance
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('pembelian-non-aop.index')}}" class="nav-link">
                        <p>Pembelian Non AOP</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('pembayaran-non-aop.index')}}" class="nav-link">
                        <p>Pembayaran Non AOP</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('master-plafond.index')}}" class="nav-link">
                        <p>Master Plafond</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon"></i>
                        <p>
                          Penerimaan Piutang
                          <i class="right fas fa-angle-right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('account-receivable.index')}}" class="nav-link">
                              <p>Account Receiveable / AR</p>
                            </a>
                        </li>
                      </ul>
                  </li>
                </ul>
              </li>
              @endif

              @if(Auth::user()->id_role == 4 || 5 || 6 || 7 || 9 || 11 || 12 || 17 || 20 || 24)
              {{-- MARKETING --}}
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Marketing
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('surat-pesanan.index')}}" class="nav-link">
                        <p>Surat Pesanan/SP</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('sales-order.index')}}" class="nav-link">
                        <p>Sales Order/SO</p>
                      </a>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="{{ route('back-order.index')}}" class="nav-link">
                        <p>Back Order/BO</p>
                      </a>
                  </li> --}}
                  <li class="nav-item">
                      <a href="{{ route('invoice.index')}}" class="nav-link">
                        <p>Invoice</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('surat-jalan.index')}}" class="nav-link">
                        <p>Surat Jalan</p>
                      </a>
                  </li>

                </ul>
              </li>
              @endif

              @if(Auth::user()->id_role == 2 || 5 || 6 || 7 || 12 || 16 || 12 || 17)
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon"></i>
                  <p>
                    Kasir
                    <i class="right fas fa-angle-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('kas-masuk.index')}}" class="nav-link">
                        <p>Kas Masuk</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('kas-keluar.index')}}" class="nav-link">
                        <p>Kas Keluar</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('invoice.index')}}" class="nav-link">
                        <p>Report Kas</p>
                      </a>
                  </li>
                </ul>
              </li>

              @endif
              <li class="nav-item">
                <a href="{{ route('logout')}}" class="nav-link">
                  <i class="nav-icon fa fa-sign-out"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>


          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
      <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="#">PT. KCP</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>

  <!-- Include DataTables JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        function closeAlertAfterTime(alertId, milliseconds) {
            setTimeout(function () {
                var alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.style.display = 'none'; 
                }
            }, milliseconds);
        }
        closeAlertAfterTime('myAlert', 3500);
    </script>

    <script>
      $(function () {
        $("#example1")
          .DataTable({
            paging: true,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)")
                  
        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });

      // Password toggle
      function myPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

    </script>

  @yield('script')

  </body>
</html>
