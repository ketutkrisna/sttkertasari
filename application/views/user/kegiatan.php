

          <!-- Page Heading -->
          <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0 mt-1 text-gray-800">Jadwal Kegiatan</h4>
            <!-- <a href="#" class="d-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Report</a> -->
          </div>

          <?=$this->session->flashdata('message'); ?>

        <?php if($this->session->userdata('level_user')){ ?>
          <div class="d-flex justify-content-end">
          <button class="d-inline-block btn btn-sm btn-primary shadow-sm mt-0 mb-2" data-toggle="modal" data-target="#modaltambahkegiatan"><i class="fas fa-user-plus fa-sm text-white"></i> Tambah kegiatan</button>
          </div>
        <?php } ?>
          <!-- Content Row -->
          <div class="row">

        <?php foreach($kegiatans as $ks): ?>
            <div class="col-lg-6">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-2">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-0 d-flex flex-row align-items-center" style="padding:0">
                  <img class="p-2 rounded-circle" src="<?=base_url('assets/img/icons.png'); ?>" width="50" height="50">
                  <h6 style="padding-left:0!important" class="m-0 p-2 font-weight-bold text-primary"><?=$ks['nama_kegiatan']; ?></h6>
                  <div class="dropdown no-arrow ml-auto p-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if($this->session->userdata('level_user')){ ?>
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Settings:</div>
                      <button class="dropdown-item ajaxkegiatan" data-idkegiatan="<?=$ks['id_kegiatan']; ?>" data-toggle="modal" data-target="#modaleditkegiatan">Edit</button>
                      <a class="dropdown-item" onclick="return confirm('Pilih OK untuk hapus!');" href="<?=base_url('admin/hapuskegiatan/'.$ks['id_kegiatan']); ?>">Delete</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="small">
                  <?=$ks['isi_kegiatan']; ?>
                  </div>
                  <div class="d-flex justify-content-end" style="color:#aaa;font-size:12px;margin-top:5px">
                    <?php 
                      $waktu=time()-$ks['tanggal_kegiatan'];
                      if($waktu<60){
                        echo $waktu.' detik lalu';
                      }else if($waktu>=60&&$waktu<=3600){
                        $waktumenit=$waktu/60;
                        echo floor($waktumenit).' menit lalu';
                      }else if($waktu>=3600&&$waktu<=86400){
                        $waktujam=$waktu/3600;
                        echo floor($waktujam).' jam lalu';
                      }else if($waktu>=86400&&$waktu<=604800){
                        $waktuhari=$waktu/86400;
                        echo floor($waktuhari).' hari lalu';
                      }else if($waktu>=604800&&$waktu<=2592000){
                        $waktuminggu=$waktu/604800;
                        echo floor($waktuminggu).' minggu lalu';
                      }else if($waktu>=2592000&&$waktu<=31536000){
                        $waktubulan=$waktu/2592000;
                        echo floor($waktubulan).' bulan lalu';
                      }else{
                        $waktutahun=$waktu/31536000;
                        echo floor($waktubulan).' tahun lalu';
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach; ?>

           
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <!-- <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer> -->
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" style="margin-bottom:40px;" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Modal tambah kegiatan -->
<div class="modal fade" id="modaltambahkegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="hidebodyedit">
      <div class="modal-body">

        <form action="<?=base_url('admin/tambahkegiatan'); ?>" method="post">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:90px;">Nama</span>
          </div>
          <input type="text" class="form-control namatambah" placeholder="masukan nama kegiatan.." aria-label="Username" aria-describedby="basic-addon1" name="namatambah" autocomplete="off">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:90px;">Informasi</span>
          </div>
          <textarea class="form-control isitambah" aria-label="With textarea" placeholder="Masukan informasi kegiatan..." name="isitambah"></textarea>
        </div>
 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="tambahkegiatan" class="btn btn-primary">Tambah</button>
      </div>
        </form>
        </div><!-- tutuphideedit -->
    </div>
  </div>
</div>

  <!-- Modal edit kegiatan -->
<div class="modal fade" id="modaleditkegiatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit kegiatan <span class="loader"><img src="<?=base_url('assets/img/loader.gif'); ?>" width="22"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="hidebodyedit">
      <div class="modal-body">

        <form action="<?=base_url('admin/updatekegiatan'); ?>" method="post">
          <input type="hidden" name="idkegiatanedit" class="idkegiatanedit">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:90px;">Nama</span>
          </div>
          <input type="text" class="form-control namaedit" placeholder="masukan nama kegiatan.." aria-label="Username" aria-describedby="basic-addon1" name="namaedit" autocomplete="off">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:90px;">Informasi</span>
          </div>
          <textarea class="form-control isiedit" aria-label="With textarea" placeholder="Masukan informasi kegiatan..." name="isiedit"></textarea>
        </div>
 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="editkegiatan" class="btn btn-primary">Update</button>
      </div>
        </form>
        </div><!-- tutuphideedit -->
    </div>
  </div>
</div>

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

  <!-- Page level plugins -->
  <script src="<?=base_url('assets/');?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?=base_url('assets/');?>js/demo/chart-area-demo.js"></script>
  <script src="<?=base_url('assets/');?>js/demo/chart-pie-demo.js"></script>

  <!-- script pribadi -->
  <script>
    $(document).ready(function(){

      $('.tampilkannav').addClass('bg-white');
      $('.tampilkannav').css('border-bottom','1px solid #ccc');

      $('.loader').hide();
      $('.ajaxkegiatan').on('click',function(){
        var idkegiatan=$(this).data('idkegiatan');

        $('.hidebodyedit').hide();
        $('.loader').show();
        $.ajax({
          url: '<?=base_url('admin/ajaxeditkegiatan/'); ?>',
          method: "POST",
          data: {idkegiatan:idkegiatan},
          dataType: "json",
          success:function(data){
            // console.log(data);
            $('.hidebodyedit').show();
            $('.loader').hide();
            $('.idkegiatanedit').val(data.id_kegiatan);
            $('.namaedit').val(data.nama_kegiatan);
            $('.isiedit').val(data.isi_kegiatan);
          }
        });
      });


    });
  </script>

</body>

</html>
