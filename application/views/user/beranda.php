      <?php  
        function IPpengunjung() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if(getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if(getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if(getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if(getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'IP Tidak Dikenali';
         
            return $ipaddress;
        }
        date_default_timezone_set('Asia/Jakarta');
      ?>


          <div class="row mt-0" style="margin-top:-83px!important">
        <!-- Earnings (Monthly) Card Example -->
          <div class="col-12">
            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center overflow-hidden bg-white shadow welcomes" style="padding:10px 0 10px 0;position:absolute;left:0;right:0;margin:auto;width:20px;height:55px;line-height:40px;transition:.2s;opacity:0;border-radius:5px;top:0px">
              <div class="welcome text-primary overflow-hidden" style="margin-top:0px">Welcome to STT Kertasari</div>
            </div>
          </div>
          <div class="col-6 col-sm-6 mb-1">
            <div class="card shadow h-100 py-0 geserfoto" style="opacity:0;transform:translate(-100px,0);transition:1s;" data-toggle="modal" data-target="#modalgaleri">
              <div class="card-body py-1">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">S</div> -->
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" style="padding:10px 0 10px 0">
                      <i class="fas fa-images fa-sm fa-fw text-primary" style="font-size:25px"></i> Galeri
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-sm-6 mb-1">
            <div class="card playvideo shadow h-100 py-0 geservideo" style="opacity:0;transform:translate(100px,0);transition:1s" data-toggle="modal" data-target="#modalvideo">
              <div class="card-body py-1">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <!-- <div class="text-xs font-weight-bold text-uppercase mb-1">S</div> -->
                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" style="padding:10px 0 10px 0">
                      <i class="fas fa-play-circle fa-sm fa-fw text-primary" style="font-size:25px"></i> Video
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <!-- Page Heading -->
            <div class="mt-2">
              <?=$this->session->flashdata('message'); ?>
            </div>
            
          <div class="d-flex align-items-center justify-content-between mt-3 mb-0">
            <h1 class="h3 mb-2 text-gray-800 mr-auto">Kabar Berita</h1>
        <?php if($this->session->userdata('level_user')): ?>
            <button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#modalposting">Add postingan</button>
        <?php endif; ?>
          </div>

          <!-- Content Row -->
          <div class="row">

        <?php foreach($postings as $ps): ?>
            <div class="col-lg-6" id="idtujuan<?=$ps['id_posting']; ?>">
              <!-- Illustrations -->
              <div class="card shadow mb-2">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-0 d-flex flex-row align-items-center" style="padding:0">
                  <img class="p-2 rounded-circle" src="<?=base_url('assets/img/icons.png'); ?>" width="50" height="50">
                  <h6 style="padding-left:0!important" class="m-0 font-weight-bold text-primary p-2"><?=$ps['judul_posting']; ?></h6>
                  <div class="dropdown no-arrow ml-auto p-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if($this->session->userdata('level_user')){ ?>
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                  <?php } ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">settings</div>
                      <span class="dropdown-item editposting" data-idposting="<?=$ps['id_posting']; ?>" data-toggle="modal" data-target="#modaleditposting">Edit</span>
                      <a class="dropdown-item" onclick="return confirm('Pilih OK untuk hapus!');" href="<?=base_url('admin/hapusposting/'.$ps['id_posting']); ?>">Delete</a>
                      <!-- <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                  </div>
                </div>
                <div class="card-body"style="padding:0;">
                  <div class="text-center position-relative">
                    <img class="img-fluid img-thumbnail" style="width:100%;" src="<?=base_url('assets/img/posting/'.$ps['foto_posting']); ?>" alt="">
                    <a class="btn-sm btn-primary" href="<?=base_url('assets/img/posting/'.$ps['foto_posting']); ?>" style="position:absolute;left:5px;top:5px;">Lihat penuh</a>
                    <a class="btn-sm btn-primary" download href="<?=base_url('assets/img/posting/'.$ps['foto_posting']); ?>" style="position:absolute;right:5px;top:5px;"><i class="fas fa-download fa-sm text-white-20"></i></a>
                  </div>
                  <div class="isiberita" style="padding:15px;margin-top:-10px">
                    <p class="small"><?=$ps['isi_posting']; ?></p>
                    <div class="d-flex justify-content-between" style="color:#aaa;font-size:13px;margin-top:-10px"> 
                      <span class="small">Support: STT Kertasari</span>
                      <span>
                      <?php 
                        $waktu=time()-$ps['tanggal_posting'];
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
                      </span>
                    </div>
                    <hr style="margin-top:3px;">
                    <div class="d-flex justify-content-between" style="margin-top:-10px">
                      <div style=""><span class="refrescount<?=$ps['id_posting']; ?>"><?=$ps['komentar']; ?></span> Komentar</div>
                      <!-- <div class="lihatkomen">Lihat</div> -->
                      <a class="refreskomen" data-toggle="collapse" href="#collapsepost<?=$ps['id_posting']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample" data-idrefres="<?=$ps['id_posting']; ?>">
                        Lihat
                      </a>
                    </div>

                    <div class="hideinputkomen collapse" id="collapsepost<?=$ps['id_posting']; ?>" style="margin-top:15px">

                <?php
                  $idpost=$ps['id_posting']; 
                  $querykomentar="SELECT * from komentar where id_postkomen=$idpost";
                  $forkomen=$this->db->query($querykomentar)->result_array();

                  $ipcek=IPpengunjung();
                  $matchip="SELECT * from komentar where ip_komentar='$ipcek'";
                  $matchipok=$this->db->query($matchip)->result_array();
                ?>

                <div class="viewkomen<?=$ps['id_posting']; ?>">
                <?php foreach($forkomen as $fk): ?>
                    <div class="d-flex" style="margin-bottom:10px;">
                      <img class="rounded-circle" width="30" height="30" src="<?=base_url('assets/img/'.$fk['foto_komentar']); ?>">
                      <span style="margin-left:5px;border:1px solid #ddd;padding:7px;border-radius:0 15px 15px 15px;background-color:#ededed;">
                        <span class="mr-2"><b><?=$fk['nama_komentar']; ?></b>
                      <?php if($fk['level_komentar']=='admin'){echo '<i class="fas fa-award fa-1x text-warning"></i>';} ?>
                        </span> 
                        <span style="font-size:12px;float:right;">
                          <?php 
                            $waktu=time()-$fk['tanggal_komentar'];
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
                        </span><br>
                          <?=$fk['isi_komentar']; ?><br>
                        <?php if($this->session->userdata('level_user')){ ?>
                          <span class="deletekomen text-danger" data-iddeletekomen="<?=$fk['id_komentar']; ?>" data-idpostkomen="<?=$fk['id_postkomen'] ?>">Hapus</span>
                        <?php } ?>
                      </span>
                    </div>
                <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-center">
                  <span class="loaderkomen loaderkomen<?=$ps['id_posting']; ?>"><img src="<?=base_url('assets/img/loader.gif'); ?>" width="30"></span>
                </div>

                    <div class="input-group mt-2">
                      <!-- <form action="<?=base_url('users/tambahkomen'); ?>" method="post"> -->
                      <input type="hidden" class="kirimip" name="ip" value="<?=IPpengunjung(); ?>">
                      <input type="hidden" class="kirimidpost" name="ip" value="<?=$ps['id_posting']; ?>">
                <?php if($this->session->userdata('level_user')){ ?>
                      <div class="input-group input-group-sm mb-1">
                        <input type="hidden" value="anonimouse" class="form-control kosong1 kirimnama<?=$ps['id_posting']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukan nama anda.." data-idposting="<?=$ps['id_posting']; ?>" required>
                      </div>
                <?php }else{ ?>
                  <?php if($matchipok){ ?>
                      <div class="input-group input-group-sm mb-1">
                        <input type="hidden" value="anonimouse" class="form-control kosong1 kirimnama<?=$ps['id_posting']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukan nama anda.." data-idposting="<?=$ps['id_posting']; ?>" required>
                      </div>
                  <?php }else{ ?>
                      <div class="input-group input-group-sm mb-1">
                        <input type="text" class="form-control kosong1 kirimnama<?=$ps['id_posting']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukan nama anda.." data-idposting="<?=$ps['id_posting']; ?>" required>
                      </div>
                  <?php } ?>
                <?php } ?>
                      <textarea class="form-control kosong2 kirimisi<?=$ps['id_posting']; ?>" aria-label="With textarea" placeholder="Ketik komentar..." data-idposting="<?=$ps['id_posting']; ?>"></textarea>
                      <div class="input-group-prepend">
                        <span style="border-radius:0 5px 5px 0;z-index:0" class="input-group-text btn btn-primary bg-primary text-white aturkomen aturkomen<?=$ps['id_posting']; ?> tambahkomen" data-idposting="<?=$ps['id_posting']; ?>">OK</span>
                      </div>
                      <!-- </form> -->
                    </div>

                    </div>

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

 <!-- Modal posting -->
<div class="modal fade" id="modalposting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Posting berita baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?=base_url('admin/tambahposting'); ?>" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:70px;">foto</span>
          </div>
          <div class="custom-file">
            <input type="file" name="fotoposting" class="tambahfoto" required>
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:70px;">Judul</span>
          </div>
          <input type="text" class="form-control" placeholder="masukan judul postingan.." aria-label="Username" aria-describedby="basic-addon1" name="judulposting" autocomplete="off">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:70px;">Isi</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" placeholder="Masukan isi postingan..." name="isiposting"></textarea>
        </div>
 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="addpost" class="btn btn-primary">Posting</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modaleditposting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit postingan <span class="loader"><img src="<?=base_url('assets/img/loader.gif'); ?>" width="22"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="hidebodyedit">
      <div class="modal-body">

        <img class="img-thumbnail gambarlama" src="<?=base_url('assets/img/komenadmin.png'); ?>" width="100%">
        <form action="<?=base_url('admin/editposting'); ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="idpostingedit" class="idpostingedit">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" style="width:70px;">foto</span>
          </div>
          <div class="custom-file">
            <input type="file" name="fotoedit" class="tambahfoto">
          </div>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:70px;">Judul</span>
          </div>
          <input type="text" class="form-control juduledit" placeholder="masukan judul postingan.." aria-label="Username" aria-describedby="basic-addon1" name="juduledit" autocomplete="off">
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1" style="width:70px;">Isi</span>
          </div>
          <textarea class="form-control isiedit" aria-label="With textarea" placeholder="Masukan isi postingan..." name="isiedit"></textarea>
        </div>
 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="addpost" class="btn btn-primary">Update</button>
      </div>
        </form>
        </div><!-- tutuphideedit -->
    </div>
  </div>
</div>

<!-- Modal galeri -->
  <div class="modal fade" id="modalgaleri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="padding: 0">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body" style="padding: 0">
          
          <div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
          <?php $toco=0; foreach($slidegaleri as $sg): ?>
            <?php 
              if($toco==0){
                $actives='active';
              }else{
                $actives='';
              }
            ?>
              <li data-target="#carouselExampleIndicator" data-slide-to="<?=$toco++; ?>" class="<?=$actives; ?>"></li>
          <?php endforeach; ?>
            </ol>
            <div class="carousel-inner" style="border-radius:10px;">
          <?php foreach($slidegaleri as $sg): ?>
            <?php
              if($maxid['maxid']==$sg['id_posting']){
                $aslides='active';
              }else{
                $aslides='';
              } 
            ?>
              <div class="carousel-item <?=$aslides; ?>">
              <a href="#idtujuan<?=$sg['id_posting']; ?>" class="page-scroll">
                <img src="<?=base_url('assets/img/posting/'.$sg['foto_posting']);?>" class="d-block w-100 img-thumbnail" alt="..." style="height:250px">

              <div class="carousel-caption d-md-block">
                <!-- <h5 class="text-white">oke</h5> -->
                <!-- <p>Klik gambar untuk menuju ke postingan</p> -->
              </a>
              </div>
              </div>
          <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicator" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicator" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
        <!-- <div class="modal-footer">
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div> -->
      </div>
    </div>
  </div>

  <!-- Modal video -->
  <div class="modal fade" id="modalvideo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="padding: 0">
        <div class="modal-body" style="padding: 0">
          
          <div class="embed-responsive embed-responsive-16by9">
            <video id="tampilvideo" class="tampilvideo img-thumbnail" controls>
              <source src="<?=base_url('assets/video/1.mp4'); ?>" type="video/mp4"/>
            </video>
          </div>
          <!-- <button class="closevideo" style="position:absolute;color:red;top:-28px;right:0px;border:2px solid red;padding:0 5px 0 5px;background-color:white;font-weight:bold;">X</button> -->

        </div>
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
  <script src="<?=base_url('assets/');?>js/myscript.js"></script>

  <!-- Page level plugins -->
  <script src="<?=base_url('assets/');?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?=base_url('assets/');?>js/demo/chart-area-demo.js"></script>
  <script src="<?=base_url('assets/');?>js/demo/chart-pie-demo.js"></script>

  <!-- script pribadi -->
  <script>
    $(document).ready(function(){
      

      // $('.hideinputkomen').hide();
      // $('.lihatkomen').on('click',function(){
      //   $('.hideinputkomen').slideToggle();
      // });
      $('.page-scroll').on('click',function(e){
        var tujuan=$(this).attr('href');
        var elementtujuan=$(tujuan);
        $('html,body').animate({
          'scrollTop':(Math.floor(elementtujuan.offset().top)-60)
        },1000);
        e.preventDefault();
      });

      $(window).on('load',function(){
        $('.geservideo').css({
          'transform':'translate(0,0)',
          'opacity':'1'
        });
        $('.geserfoto').css({
          'transform':'translate(0,0)',
          'opacity':'1'
        });
        $('.ucapanselamat').css('opacity','1');
      });

      $(window).on('scroll',function(){
        var nilai=$(this).scrollTop()/1.2;
        var welcome=$(this).scrollTop()/17.5;
        var welcomes=$(this).scrollTop()/0.7;
        var top=$(this).scrollTop();
        // console.log(Math.floor(welcomes));
        $('.geserfoto').css({
          'transform':'translate(-'+Math.floor(nilai)+'px,0)',
          'opacity':'1',
          'transition':'.1s'
        });
        $('.geservideo').css({
          'transform':'translate('+Math.floor(nilai)+'px,0)',
          'opacity':'1',
          'transition':'.1s'
        });
        if(welcome>9){
          $('.welcome').css('opacity','1');
        }else{
          $('.welcome').css('opacity','.'+Math.floor(welcome));
        }
        $('.welcomes').css('opacity','1');
        if(welcomes>287){
          $('.welcomes').css('width','287px');
        }else{
          $('.welcomes').css('width',welcomes+'px');
        }

        if(top>375){
          $('.tampilkannav').addClass('bg-white');
          $('.tampilkannav').css('border-bottom','1px solid #ccc');
        }else{
          $('.tampilkannav').removeClass('bg-white');
          $('.tampilkannav').css('border-bottom','0px solid #ccc'); 
        }

        var matahari=$(this).scrollTop()/1.2;
        var orang=$(this).scrollTop()/3;
        var pura=$(this).scrollTop()/6;
        var awan=$(this).scrollTop()/2;
        var awanx=$(this).scrollTop()/8;
        var gradasi=$(this).scrollTop()/1000;
        // console.log(Math.floor(top));
        $('.matahari').css({
          'transform':'translate(0px,'+Math.floor(matahari)+'px)'
        });
        $('.awan').css({
          'transform':'translate(-'+Math.floor(awanx)+'px,'+Math.floor(awan)+'px)'
        });
         $('.orang').css({
          'transform':'translate(0px,'+Math.floor(orang)+'px)'
        });
         $('.pura').css({
          'transform':'translate(0px,'+Math.floor(pura)+'px)'
        });
         $('.gradasi').css({
          'transform':'translate(0px,-'+Math.floor(gradasi)+'px)'
        });

        // var texty=$(this).scrollTop()/1.5;
        // var textx=$(this).scrollTop()/1.2;
        // console.log(texty);
        // if(top>250){
        //   $('.ucapanselamat').css('transition','1s');
        //   $('.ucapanselamat').hide();
        // }else{
        //   $('.ucapanselamat').show();
        // }
        // $('.ucapanselamat').css('transform','translate('+Math.floor(textx)+'px,0px)');
      });

      // $('.materialboxed').on('click',function(e){
      //   e.stopPropagation();
      // });

      // $('.playvideo').on('click',function(){
      //   // $('.tampilvideo').attr('autoplay','on');
      //   // $('.tampilvideo').trigger('play'); 
      // });
      // // var stop=document.getElementById('tampilvideo');
      $('body').on('click','#modalvideo',function(){
        $('.tampilvideo').trigger('pause'); 
      });

      // $('.carousel').carousel({'pause':'mouseenter'});
      $('.materialboxed').materialbox();
      $('.loaderkomen').hide();
      $('body').on('click','.tambahkomen',function(){
        var idposting=$(this).data('idposting');
        var kirimip=$('.kirimip').val();
        var kirimidpost=$('.kirimidpost').val();
        var kirimnama=$('.kirimnama'+idposting).val();
        var kirimisi=$('.kirimisi'+idposting).val();
        $('.aturkomen'+idposting).removeClass('tambahkomen');
        $('.loaderkomen'+idposting).show();
        // console.log(idposting);
        // return false;
        $.ajax({
          url: '<?=base_url('users/tambahkomen/'); ?>',
          method: "POST",
          data: {idposting:idposting,kirimip:kirimip,kirimidpost:kirimidpost,kirimnama:kirimnama,kirimisi:kirimisi},
          dataType: "html",
          success:function(data){
            // console.log(data);
            $('.loaderkomen'+idposting).hide();
            $.post( '<?=base_url('users/refrescountkomen/'); ?>', { idposting: idposting})
                .done(function( data ) {
                  // console.log(data);
                // $('.viewanggota').html(data);
                $('.refrescount'+idposting).text(data);
            });
            $('.kosong1').val('anonimouse');
            $('.kosong1').attr('type','hidden');
            $('.kirimisi'+idposting).val('');
            $('.viewkomen'+idposting).html(data);

            $('.aturkomen'+idposting).addClass('disabled');
            $('.aturkomen'+idposting).addClass('bg-secondary');
            $('.aturkomen'+idposting).removeClass('tambahkomen');
          }
        });
      });

      $('.refreskomen').on('click',function(){
        var idrefres=$(this).data('idrefres');
        $.ajax({
          url: '<?=base_url('users/refreskomen/'); ?>',
          method: "POST",
          data: {idrefres:idrefres},
          dataType: "html",
          success:function(data){
            // console.log(data);
            $.post( '<?=base_url('users/refrescountkomen/'); ?>', { idposting: idrefres})
                .done(function( data ) {
                  // console.log(data);
                // $('.viewanggota').html(data);
                $('.refrescount'+idrefres).text(data);
            });
            $('.viewkomen'+idrefres).html(data);
          }
        });
      });

      $('.aturkomen').addClass('disabled');
      $('.aturkomen').addClass('bg-secondary');
      $('.aturkomen').removeClass('tambahkomen');
      $('body').on('keyup','.kosong1',function(){
        var idposting=$(this).data('idposting');
        if($('.kirimnama'+idposting).val().length==0 || $('.kirimisi'+idposting).val().length==0){
          $('.aturkomen'+idposting).addClass('disabled');
          $('.aturkomen'+idposting).addClass('bg-secondary');
          $('.aturkomen'+idposting).removeClass('tambahkomen');
        }else{
          $('.aturkomen'+idposting).removeClass('bg-secondary');
          $('.aturkomen'+idposting).removeClass('disabled');
          $('.aturkomen'+idposting).addClass('bg-primary');
          $('.aturkomen'+idposting).addClass('tambahkomen');
        }
      });
      $('body').on('keyup','.kosong2',function(){
        var idposting=$(this).data('idposting');
        if($('.kirimnama'+idposting).val().length==0 || $('.kirimisi'+idposting).val().length==0){
          $('.aturkomen'+idposting).addClass('disabled');
          $('.aturkomen'+idposting).addClass('bg-secondary');
          $('.aturkomen'+idposting).removeClass('tambahkomen');
        }else{
          $('.aturkomen'+idposting).removeClass('bg-secondary');
          $('.aturkomen'+idposting).removeClass('disabled');
          $('.aturkomen'+idposting).addClass('bg-primary');
          $('.aturkomen'+idposting).addClass('tambahkomen');
        }
      });

      $('body').on('click','.deletekomen',function(){
        var iddeletekomen=$(this).data('iddeletekomen');
        var idpostkomen=$(this).data('idpostkomen');
        var pagar=confirm('Klik OK untuk hapus!');
        if(pagar==false){
          return false;
        }else{
          $('.loaderkomen'+idpostkomen).show();
          $.ajax({
            url: '<?=base_url('admin/hapuskomen/'); ?>',
            method: "POST",
            data: {iddeletekomen:iddeletekomen,idpostkomen:idpostkomen},
            dataType: "html",
            success:function(data){
              $('.loaderkomen'+idpostkomen).hide();
              $.post( '<?=base_url('users/refrescountkomen/'); ?>', { idposting: idpostkomen})
                .done(function( data ) {
                $('.refrescount'+idpostkomen).text(data);
              });
              $('.viewkomen'+idpostkomen).html(data);
            }
          });
        }
      });

      $('.loader').hide();
      $('.editposting').on('click',function(){
        var idpostingan=$(this).data('idposting');
        $('.hidebodyedit').hide();
        $('.loader').show();
        $.ajax({
          url: '<?=base_url('admin/ajaxeditpostingan/'); ?>',
          method: "POST",
          data: {idpostingan:idpostingan},
          dataType: "json",
          success:function(data){
            // console.log(data);
            $('.hidebodyedit').show();
            $('.loader').hide();
            $('.idpostingedit').val(data.id_posting);
            $('.juduledit').val(data.judul_posting);
            $('.isiedit').val(data.isi_posting);
            $('.gambarlama').attr("src","<?=base_url('assets/img/posting/'); ?>"+data.foto_posting);
          }
        });
      });


    });
  </script>

</body>

</html>
