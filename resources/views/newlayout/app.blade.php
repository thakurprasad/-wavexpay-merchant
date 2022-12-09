<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Wavexpay - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('newdesign/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link rel="icon" type="image/x-icon" href="{{url('https://wavexpay.com/assets/images/favicon.png') }}">
  <!-- Custom styles for this template-->
  <link href="{{ asset('newdesign/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('newdesign/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/global-custom.css') }}" rel="stylesheet">
<script src="{{ asset('newdesign/vendor/jquery/jquery.min.js') }}"></script>
  @yield('page-style')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('newlayout.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('newlayout.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Wavexpay 2022</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          <a class="btn btn-primary" onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="javascript::void(0)">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <!-- <script src="{{ asset('newdesign/vendor/jquery/jquery.min.js') }}"></script> -->
  <script src="{{ asset('newdesign/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('newdesign/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('newdesign/js/sb-admin-2.min.js') }}"></script>

  


  <!-- Page level plugins -->
  <script src="{{ asset('newdesign/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('newdesign/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('newdesign/js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('newdesign/js/global-functions.js') }}"></script>






  @yield('page-script')

<script type="text/javascript">
  $('#change_mode').on('change', function() {
    location.href = "<?= url('/set-gateway-mode') ?>/"+$(this).val();
  });
</script>


</body>

</html>
