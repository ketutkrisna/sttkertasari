
          <!-- Page Heading -->
          <div class="d-flex align-items-center justify-content-between mb-2">
            <h4 class="mb-0 mt-1 text-gray-800">Jumlah Anggota</h4>
          </div>

          <div class="row">

          <?php foreach($countanggota as $ca){ ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-6 col-sm-6 col-md-4 col-xl-3 mb-1">
              <div class="card shadow h-100 py-0">
                <div class="card-body py-1">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1"><?=$ca['status_anggota']; ?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$ca['status']; ?> orang</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-12 mb-1">
              <div class="card shadow h-100 py-0">
                <div class="card-body py-1">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total aktif & non aktif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$countaktif['aktif']+$countnonaktif['nonaktif']; ?> orang</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php foreach($countkelamin as $ck){ ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-6 col-sm-6 col-md-4 col-xl-3 mb-1">
              <div class="card shadow h-100 py-0">
                <div class="card-body py-1">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">
                      <?php if($ck['kelamin_anggota']=='laki-laki'){ ?>
                        <i class="fas fa-mars" style="color:#f51d1d;font-size:15px;font-weight:bold;"></i>
                      <?php }else{ ?>
                        <i class="fas fa-venus" style="color:#f72ad5;font-size:15px;font-weight:bold;"></i>
                      <?php } ?>
                        <?=$ck['kelamin_anggota']; ?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$ck['kelamin']; ?> Orang</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          </div>

          <!-- Page Heading -->
      <?php if($this->session->userdata('level_user')){ ?>
          <button class="d-inline-block btn btn-sm btn-primary shadow-sm mt-4" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-user-plus fa-sm text-white"></i> Tambah</button>
      <?php }else{ ?>
          <button class="d-inline-block btn btn-sm btn-primary shadow-sm mt-4" data-toggle="modal" data-target="#modalTambahuser"><i class="fas fa-user-plus fa-sm text-white"></i> Masukan data anda</button>
      <?php } ?>
          <div class="d-flex align-items-center justify-content-between mt-3 mb-3">
            <h4 class="mb-0 mt-0 text-gray-800">Daftar Anggota</h4>
            <a target="_blank" href="<?=base_url('users/cetakanggota'); ?>" class="d-inline-block btn btn-sm btn-primary shadow-sm mt-0 "><i class="fas fa-download fa-sm text-white-50"></i> Download PDF</a>
          </div>

          <?=$this->session->flashdata('message'); ?>

          <!-- Content Row -->
          <div class="row tampilajaxcari">

            <!-- Earnings (Monthly) Card Example -->
          <?php foreach($allanggota as $ag): ?>
            <?php
              if($ag['status_anggota']=='aktif'){
                $border='border-left-primary';
              }else if($ag['status_anggota']=='non aktif'){
                $border='border-left-success';
              }else if($ag['status_anggota']=='menikah'){
                $border='border-left-warning';
              }else{
                $border='border-left-danger';
              }
              if($ag['jabatan_anggota']=='anggota'){
                $warna='#fff';
                $pengurus='';
              }else{
                $warna='#ddd';
                $pengurus='<i class="fas fa-award fa-1x text-warning"></i>';
              }
            ?>
            <div class="col-md-6 mb-1">
              <div class="card <?=$border; ?> shadow h-100 py-0 reqdetail" data-toggle="modal" data-target="#modalDetail" data-idanggota="<?=$ag['id_anggota']; ?>">
                <div class="card-body py-1">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 d-flex">
                      <div style="margin-right:5px">
                        <img class="rounded-circle materialboxed fotoprofil" src="<?=base_url('assets/img/anggota/'.$ag['foto_anggota']); ?>" width="40" height="40">
                      </div>
                      <div>
                        <div class="h5 mb-0 font-weight-bold text-primary"><?=$ag['nama_anggota']; ?> <?=$pengurus; ?></div>
                        <div class="text-xs font-weight-bold text-gray-800 mb-1"><?=$ag['jabatan_anggota']; ?></div>
                      </div>
                    </div>
                    <div class="col-auto">
            <?php if($ag['kelamin_anggota']=='laki-laki'){ ?>
                      <i class="fas fa-mars fa-1x" style="color:#f51d1d"></i>
            <?php }else{ ?>
                      <i class="fas fa-venus fa-1x" style="color:#f72ad5"></i>
            <?php } ?>
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

  <!-- Modal detail anggota -->
  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span class="gantitext">Detail anggota</span> <span class="loader"><img src="<?=base_url('assets/img/loader.gif'); ?>" width="22"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <div class="datahide">
        <div class="modal-body">
          <!-- <img style="border-radius:5px;" src="<?=base_url('assets/img/anggota/1.jpg'); ?>" width="100%" class="mb-3"> -->
          <span class="fotoa"></span>
      <?php if($this->session->userdata('level_user')){ ?>
          <span style="position:absolute;top:21px;left:21px;border-radius:0 5px 5px 5px" class="btn-sm btn btn-danger hapusfotoprofil">Hapus foto profil</span>
      <?php } ?>
          <div class="divdetail">
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary namaa"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">nama</div>
                </div>
              </div>
            </div>
          </div>
      <?php if($this->session->userdata('level_user')){ ?>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary tanggala"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">tanggal lahir</div>
                </div>
              </div>
            </div>
          </div>
      <?php } ?>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary kelamina"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">jenis kelamin</div>
                </div>
              </div>
            </div>
          </div>
      <?php if($this->session->userdata('level_user')){ ?>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary tlpa"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">nomer telp</div>
                </div>
              </div>
            </div>
          </div>
      <?php } ?>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary alamata"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">alamat</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary jabatana"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">jabatan</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary statusa"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">status</div>
                </div>
              </div>
            </div>
          </div>
          <div class="card border-left-info shadow h-100 py-0">
            <div class="card-body py-0">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-primary masuka"></div>
                    <div class="text-xs font-weight-bold text-gray-800 mb-1">masuk anggota</div>
                </div>
              </div>
            </div>
          </div>
          </div>

          <form action="<?=base_url('admin/updateanggota'); ?>" method="post" enctype="multipart/form-data">
            <div class="divedit">
              <input type="hidden" name="idanggotae" class="idanggotae">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" style="width:90px;">Nama</span>
              </div>
              <input type="text" class="form-control namae" placeholder="masukan nama.." aria-label="Username" aria-describedby="basic-addon1" name="namae" autocomplete="off" required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl lahir</span>
              </div>
              <input type="date" class="form-control lahire" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="lahire" autocomplete="off">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Kelamin</label>
              </div>
              <select class="custom-select kelamine" id="inputGroupSelect01" name="kelamine" required>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" style="width:90px;">Tlp</span>
              </div>
              <input type="number" class="form-control tlpe" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="tlpe" autocomplete="off">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" style="width:90px;">Alamat</span>
              </div>
              <textarea class="form-control alamate" aria-label="With textarea" placeholder="Ketik isi baru..." name="alamate"></textarea>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Jabatan</label>
              </div>
              <select class="custom-select jabatane" id="inputGroupSelect01" name="jabatane" required>
                <option value="anggota">Anggota</option>
                <option value="humas">Humas</option>
                <option value="bendahara">Bendahara</option>
                <option value="wakil ketua">Wakil ketua</option>
                <option value="ketua">Ketua</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Status</label>
              </div>
              <select class="custom-select statuse" id="inputGroupSelect01" name="statuse" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non aktif</option>
                <option value="menikah">Menikah</option>
                <option value="drop out">Drop out</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl masuk</span>
              </div>
              <input type="date" class="form-control masuke" placeholder="Tgl jadi anggota.." aria-label="Username" aria-describedby="basic-addon1" name="masuke" autocomplete="off">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" style="width:90px;">foto</span>
              </div>
              <div class="custom-file">
                <input type="file" name="fotoupdate" class="tambahfoto">
              </div>
            </div>
            </div>
          
        </div>
    <?php if($this->session->userdata('level_user')){ ?>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger mr-auto hapusanggota delete">Delete</button>
          <button type="button" class="btn btn-danger mr-auto batal">Batal</button>
          <button type="button" class="btn btn-primary ml-auto edit">Edit</button>
          <button type="submit" name="updatea" class="btn btn-primary ml-auto simpan">Update</button>
        </div>
    <?php } ?>
          </form>
        </div><!-- tutup datahide -->
      </div>
    </div>
  </div>

  <!-- Modal tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?=base_url('admin/tambahanggota'); ?>" method="post" enctype="multipart/form-data">
            <!-- <div class="modal-body"> -->

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Nama</span>
                  </div>
                  <input type="text" class="form-control tambahnama" placeholder="masukan nama.." aria-label="Username" aria-describedby="basic-addon1" name="namaanggota" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl lahir</span>
                  </div>
                  <input type="date" class="form-control tambahtelepon" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="lahiranggota" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Kelamin</label>
                  </div>
                  <select class="custom-select tambahkelamin" id="inputGroupSelect01" name="kelaminanggota" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tlp</span>
                  </div>
                  <input type="number" class="form-control tambahtelepon" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="tlpanggota" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Alamat</span>
                  </div>
                  <textarea class="form-control" aria-label="With textarea" placeholder="Masukan alamat..." name="alamatanggota"></textarea>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Jabatan</label>
                  </div>
                  <select class="custom-select tambahjabatan" id="inputGroupSelect01" name="jabatananggota" required>
                    <option value="anggota">Anggota</option>
                    <option value="humas">Humas</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="wakil ketua">Wakil ketua</option>
                    <option value="ketua">Ketua</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Status</label>
                  </div>
                  <select class="custom-select tambahstatus" id="inputGroupSelect01" name="statusanggota" required>
                    <option value="aktif">Aktif</option>
                    <option value="non aktif">Non aktif</option>
                    <option value="menikah">Menikah</option>
                    <option value="drop out">Drop out</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl masuk</span>
                  </div>
                  <input type="date" class="form-control tambahmasuk" placeholder="Tgl jadi anggota.." aria-label="Username" aria-describedby="basic-addon1" name="masukanggota" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:90px;">foto</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="fotoanggota" class="tambahfoto">
                  </div>
                </div>

            <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        </div>
          </form>
      </div>
    </div>
  </div>


  <!-- Modal tambah user anggota -->
  <div class="modal fade" id="modalTambahuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?=base_url('users/tambahanggotauser'); ?>" method="post" enctype="multipart/form-data">
            <!-- <div class="modal-body"> -->

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Nama</span>
                  </div>
                  <input type="text" class="form-control tambahnama" placeholder="masukan nama.." aria-label="Username" aria-describedby="basic-addon1" name="namaanggotauser" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl lahir</span>
                  </div>
                  <input type="date" class="form-control tambahtelepon" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="lahiranggotauser" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Kelamin</label>
                  </div>
                  <select class="custom-select tambahkelamin" id="inputGroupSelect01" name="kelaminanggotauser" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tlp</span>
                  </div>
                  <input type="number" class="form-control tambahtelepon" placeholder="masukan no tlp.." aria-label="Username" aria-describedby="basic-addon1" name="tlpanggotauser" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Alamat</span>
                  </div>
                  <textarea class="form-control" aria-label="With textarea" placeholder="Masukan alamat..." name="alamatanggotauser"></textarea>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Jabatan</label>
                  </div>
                  <select class="custom-select tambahjabatan" id="inputGroupSelect01" name="jabatananggotauser" required>
                    <option value="anggota">Anggota</option>
                    <option value="humas">Humas</option>
                    <option value="bendahara">Bendahara</option>
                    <option value="wakil ketua">Wakil ketua</option>
                    <option value="ketua">Ketua</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01" style="width:90px;">Status</label>
                  </div>
                  <select class="custom-select tambahstatus" id="inputGroupSelect01" name="statusanggotauser" required>
                    <option value="aktif">Aktif</option>
                    <option value="non aktif">Non aktif</option>
                    <option value="menikah">Menikah</option>
                    <option value="drop out">Drop out</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="width:90px;">Tgl masuk</span>
                  </div>
                  <input type="date" class="form-control tambahmasuk" placeholder="Tgl jadi anggota.." aria-label="Username" aria-describedby="basic-addon1" name="masukanggotauser" autocomplete="off" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="width:90px;">foto</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" name="fotoanggotauser" class="tambahfoto">
                  </div>
                </div>

            <!-- </div> -->
        </div>
        <div class="modal-footer">
          <button type="submit" name="simpanuser" class="btn btn-primary">Simpan</button>
        </div>
          </form>
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

      function umur(umur){
        var dob = new Date(umur);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        return age;
      }

      $('.materialboxed').materialbox();

      $('.divedit').hide();
      $('.batal').hide();
      $('.simpan').hide();

      $('.batal').on('click',function(){
        $('.divedit').hide();
        $('.batal').hide();
        $('.simpan').hide();

        $('.divdetail').fadeIn();
        $('.delete').fadeIn();
        $('.edit').fadeIn();
      });

      $('.edit').on('click',function(){
        $('.divedit').fadeIn();
        $('.batal').fadeIn();
        $('.simpan').fadeIn();

        $('.divdetail').hide();
        $('.delete').hide();
        $('.edit').hide();
      });

      $('.tampilkannav').addClass('bg-white');
      $('.tampilkannav').css('border-bottom','1px solid #ccc');

      $('body').on('click','.fotoprofil', function(e){
        // $('.materialboxed').materialbox();
        e.stopPropagation();
      });
      $('body').on('click','#materialbox-overlay',function(e){
        e.stopPropagation();
      });
            
      // var timejs=jam.toString().substring(0,jam.toString().length-3);
      // console.log(jam);
      $('.loader').hide();
      $('body').on('click','.reqdetail',function(){
        var idanggota=$(this).data('idanggota');
        $('.divedit').hide();
        $('.batal').hide();
        $('.simpan').hide();

        $('.divdetail').fadeIn();
        $('.delete').fadeIn();
        $('.edit').fadeIn();

        $('.gantitext').text('Detail Anggota');
        $('.loader').show();
        $('.datahide').hide();
        $.ajax({
          url: '<?=base_url('users/ajaxdetailanggota'); ?>',
          method: "POST",
          data: {idanggota:idanggota},
          dataType: "json",
          success:function(data){
            var waktusaatini=new Date().getTime();
            var timesaatini=waktusaatini.toString().substring(0,waktusaatini.toString().length-3);
            var waktumasuk = new Date(data.masuk_anggota);
            var waktumasuks = waktumasuk.getTime();
            var timemasuk=waktumasuks.toString().substring(0,waktumasuks.toString().length-3);
            var waktu=Number(timesaatini)-Number(timemasuk);
            // console.log(waktu);
            var updatewaktu=0;
            if(waktu<60){
              updatewaktu=waktu+' detik lalu';
            }else if(waktu>=60&&waktu<=3600){
              var waktumenit=waktu/60;
              updatewaktu=Math.floor(waktumenit)+' menit lalu';
            }else if(waktu>=3600&&waktu<=86400){
              var waktujam=waktu/3600;
              updatewaktu=Math.floor(waktujam)+' jam lalu';
            }else if(waktu>=86400&&waktu<=604800){
              var waktuhari=waktu/86400;
              updatewaktu=Math.floor(waktuhari)+' hari lalu';
            }else if(waktu>=604800&&waktu<=2592000){
              var waktuminggu=waktu/604800;
              updatewaktu=Math.floor(waktuminggu)+' minggu lalu';
            }else if(waktu>=2592000&&waktu<=31536000){
              var waktubulan=waktu/2592000;
              updatewaktu=Math.floor(waktubulan)+' bulan lalu';
            }else{
              var waktutahun=waktu/31536000;
              updatewaktu=Math.floor(waktutahun)+' tahun lalu';
            }
            // console.log(time);
            if(data.foto_anggota=='kosong.jpg'){
              $('.hapusfotoprofil').hide();
            }else{
              $('.hapusfotoprofil').show();
            }

            $('.loader').hide();
            $('.datahide').show();
            $('.fotoa').html('<img class="mb-2 img-thumbnail materialboxed" style="border-radius:5px;" width="100%" src="<?=base_url('assets/img/anggota/');?>'+data.foto_anggota+'">');
            $('.namaa').text(data.nama_anggota);
            $('.tanggala').text(data.lahir_anggota);
            $('.kelamina').text(data.kelamin_anggota);
            $('.tlpa').text(data.nomer_anggota);
            $('.alamata').text(data.alamat_anggota);
            $('.jabatana').text(data.jabatan_anggota);
            $('.statusa').text(data.status_anggota);
            $('.masuka').text(updatewaktu);

            $('.idanggotae').val(data.id_anggota);
            $('.namae').val(data.nama_anggota);
            $('.lahire').val(data.lahir_anggota);
            $('.kelamine').val(data.kelamin_anggota);
            $('.tlpe').val(data.nomer_anggota);
            $('.alamate').val(data.alamat_anggota);
            $('.jabatane').val(data.jabatan_anggota);
            $('.statuse').val(data.status_anggota);
            $('.masuke').val(data.masuk_anggota);
          }
        });
      });

      // load cari mobile
      $('.loadercari').hide();
      $('.keywordnama').on('keyup',function(){
        var keywordnama=$('.keywordnama').val();
        var keywordstatus=$('.keywordstatus').val();
        $('.loadercari').show();
        // $('.tampilajaxcari').html(`<div>
        //                             <img style="position:absolute;left:0;right:0;margin:5px auto;" class="rounded-circle" style="margin-left:5px;align-items:center;" width="80" height="80" src="<?=base_url('assets/img/loader.gif'); ?>">
        //                             </div>`);

        $.ajax({
          url: '<?=base_url('users/carianggota/'); ?>',
          method: "POST",
          data: {keywordnama:keywordnama,keywordstatus:keywordstatus},
          dataType: "html",
          success:function(data){
            $('.loadercari').hide();
            $('.tampilajaxcari').html(data);
          }
        });

      });

      $('.keywordstatus').on('change',function(){
        var keywordnama=$('.keywordnama').val();
        var keywordstatus=$('.keywordstatus').val();
        $('.loadercari').show();

        $.ajax({
          url: '<?=base_url('users/carianggota/'); ?>',
          method: "POST",
          data: {keywordnama:keywordnama,keywordstatus:keywordstatus},
          dataType: "html",
          success:function(data){
            $('.loadercari').hide();
            $('.tampilajaxcari').html(data);
          }
        });

      });


      // load cari dekstop
      $('.loadercaridekstop').hide();
      $('.keywordnamadekstop').on('keyup',function(){
        var keywordnama=$('.keywordnamadekstop').val();
        var keywordstatus=$('.keywordstatusdekstop').val();
        $('.loadercaridekstop').show();

        $.ajax({
          url: '<?=base_url('users/carianggota/'); ?>',
          method: "POST",
          data: {keywordnama:keywordnama,keywordstatus:keywordstatus},
          dataType: "html",
          success:function(data){
            $('.loadercaridekstop').hide();
            $('.tampilajaxcari').html(data);
          }
        });

      });

      $('.keywordstatusdekstop').on('change',function(){
        var keywordnama=$('.keywordnamadekstop').val();
        var keywordstatus=$('.keywordstatusdekstop').val();
        $('.loadercaridekstop').show();

        $.ajax({
          url: '<?=base_url('users/carianggota/'); ?>',
          method: "POST",
          data: {keywordnama:keywordnama,keywordstatus:keywordstatus},
          dataType: "html",
          success:function(data){
            $('.loadercaridekstop').hide();
            $('.tampilajaxcari').html(data);
          }
        });

      });

      $('.hapusanggota').on('click',function(){
        var idanggota=$('.idanggotae').val();
        var pagar=confirm('Pilih OK untuk hapus!');
        if(pagar==false){
          return false;
        }else{
          window.location.href = "<?=base_url('admin/hapusanggota/'); ?>"+idanggota;
        }
      });

      $('.hapusfotoprofil').on('click',function(){
        var idanggotas=$('.idanggotae').val();
        var pagars=confirm('Pilih OK untuk hapus!');
        if(pagars==false){
          return false;
        }else{
          window.location.href = "<?=base_url('admin/hapusfotoprofil/'); ?>"+idanggotas;
        }
      });

      $('.cetakanggota').on('click',function(){
        var keywordnama=$('.keywordnama').val();
        var keywordstatus=$('.keywordstatus').val();
        window.open('<?=base_url('users/cetakanggota/'); ?>'+keywordnama+'/'+keywordstatus,'_blank');
      });


    });
  </script>

</body>

</html>
