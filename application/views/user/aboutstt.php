<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>tentang sttkertasari</title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url('assets/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url('assets/');?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/');?>css/mystyle.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

         <!-- Topbar -->
        <nav class="navbar fixed-top navbar-expand navbar-light bg-white topbar mb-4 static-top" style="height:55px;border-bottom:1px solid #ccc">
          <!-- Sidebar Toggle (Topbar) -->
          <a class="nav-link" href="<?=base_url('users'); ?>">
            <span class="d-lg-inline" style="font-weight:bold;font-size:18px;line-height:5px;"><i class="fas fa-arrow-left"></i> Beranda</span>
          </a>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-top:70px;padding-bottom:100px;min-height:500px;">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Tentang STT Kertasari</h1>

          <!-- Content Row -->
          <div class="row d-flex justify-content-center mt-4">

            <!-- Grow In Utility -->
            <div class="col-lg-6">

              <div class="card position-relative" style="padding:0 20px 0 20px">
                <!-- <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Grow In Animation Utilty</h6>
                </div> -->
                <div class="card-body d-flex justify-content-center">
                  <img class="img-fluid img-thumbnail justify-content-center" style="width:40%;" src="<?=base_url('assets/img/icons.png'); ?>" alt="">
                </div>
                  <p>STT Kertasari adalah instansi atau kelompok pemuda & pemudi yang berada di daerah jalur 3 mulyasari sp2 kecamatan negeri agung kabupaten way kanan</p>

              </div>

            </div>

           

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- dsini footer -->

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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url('assets/');?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url('assets/');?>js/sb-admin-2.min.js"></script>
  <script src="<?=base_url('assets/');?>js/myscript.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?=base_url('assets/');?>js/demo/chart-area-demo.js"></script>
  <script src="<?=base_url('assets/');?>js/demo/chart-pie-demo.js"></script>

  <script>
    $(document).ready(function(){


      $('.materialboxed').materialbox();
      $('.materialboxed').on('click',function(e){
        e.stopPropagation();
      })

    });
  </script>

</body>

</html>
