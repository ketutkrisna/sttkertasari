<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level_user')){
			redirect('users');
		}
	}

	public function index()
	{
		$data['profileuser']=$this->db->get_where('users',['id_user'=>$this->session->userdata('id_user')])->row_array();
		$userid=$this->session->userdata('id_user');
		$passwordlama=htmlspecialchars($this->input->post('passwordlama',true));
		$matchpassword=$this->db->get_where('users',['id_user'=>$userid])->row_array();
		// var_dump($matchpassword);die;

		$this->form_validation->set_rules('passwordlama','passwordlama','trim|required',
			[
				'required'=>'Password harus diisi'
			]);
		$this->form_validation->set_rules('passwordbaru','Password','trim|required|min_length[5]|matches[passwordconfirm]',[
				'required'=>'Password harus diisi',
				'min_length'=>'Panjang password min 5 karakter',
				'matches'=>'Confirm password tidak sama'
			]);
		$this->form_validation->set_rules('passwordconfirm','confirmpassword','trim|required|matches[passwordbaru]',
			[
				'required'=>'Password harus diisi',
				'matches'=>'Confirm password tidak sama'
			]);

		if ($this->form_validation->run() == FALSE){
			// $this->load->view('users/setpassword',$data);
			$this->load->view('admin/password');
		}else{
			if($matchpassword['password_user']!=$passwordlama){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Password lama 
		              <strong>Salah</strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('admin');
				// $this->load->view("templates/header",$data);
				// $this->load->view("home/setpassword",$data);
				return false;
			}else{
				$this->db->set('password_user', htmlspecialchars($this->input->post('passwordbaru',true)));
				$this->db->where('id_user', $userid);
				$this->db->update('users');
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Success password
		              <strong>berhasil</strong> diubah.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('admin');
				// $this->load->view("templates/header",$data);
				// $this->load->view("home/setpassword",$data);
				return false;
			}
		}
	}

	public function ubahpassword()
	{
		$passwordlama=htmlspecialchars($this->input->post('passwordlama',true));
		$passwordbaru=htmlspecialchars($this->input->post('passwordbaru',true));
		$passwordconfirm=htmlspecialchars($this->input->post('passwordconfirm',true));
	}

	public function tambahanggota()
	{
		$nama=htmlspecialchars($this->input->post('namaanggota',true));
		$lahir=htmlspecialchars($this->input->post('lahiranggota',true));
		$kelamin=htmlspecialchars($this->input->post('kelaminanggota',true));
		$tlp=htmlspecialchars($this->input->post('tlpanggota',true));
		$alamat=htmlspecialchars($this->input->post('alamatanggota',true));
		$jabatan=htmlspecialchars($this->input->post('jabatananggota',true));
		$status=htmlspecialchars($this->input->post('statusanggota',true));
		$masuk=htmlspecialchars($this->input->post('masukanggota',true));

		if($_FILES['fotoanggota']['name']){
			if($_FILES['fotoanggota']['size']==''||$_FILES['fotoanggota']['size']>2048000){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
		              <strong>max 2MB</strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota');
				return false;
			}else{
				$config['upload_path']          = './assets/img/anggota/';
	            $config['allowed_types']        = 'jpg|png|gif';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotoanggota')){
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Format file harus
				              <strong>JPG|PNG|GIF</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users/anggota');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
				              <strong>max 2MB</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users/anggota');
						return false;
	            	}
	            }
	            // insert to produks
				$data = array(
				        'id_anggota' => null,
				        'foto_anggota' => $foto,
				        'nama_anggota' => $nama,
				        'lahir_anggota' => $lahir,
				        'kelamin_anggota' => $kelamin,
				        'nomer_anggota' => $tlp,
				        'alamat_anggota' => $alamat,
				        'jabatan_anggota' => $jabatan,
				        'status_anggota' => $status,
				        'masuk_anggota' => $masuk
						);
				$this->db->insert('anggota', $data);
				// $idproduk = $this->db->insert_id();
				// notifikasi berhasil
				// $this->session->set_flashdata('newnotiftambah',$idproduk);
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Anggota
		              <strong>Berhasil</strong> ditambahkan.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota');
				return false;
	        }
		}else{
			$data = array(
				        'id_anggota' => null,
				        'foto_anggota' => 'kosong.jpg',
				        'nama_anggota' => $nama,
				        'lahir_anggota' => $lahir,
				        'kelamin_anggota' => $kelamin,
				        'nomer_anggota' => $tlp,
				        'alamat_anggota' => $alamat,
				        'jabatan_anggota' => $jabatan,
				        'status_anggota' => $status,
				        'masuk_anggota' => $masuk
						);
				$this->db->insert('anggota', $data);
				// $idproduk = $this->db->insert_id();
				// notifikasi berhasil
				// $this->session->set_flashdata('newnotiftambah',$idproduk);
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Anggota
		              <strong>Berhasil</strong> ditambahkan.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota');
				return false;
		}
	}

	public function updateanggota()
	{
		$idanggota=htmlspecialchars($this->input->post('idanggotae',true));
		$nama=htmlspecialchars($this->input->post('namae',true));
		$lahir=htmlspecialchars($this->input->post('lahire',true));
		$kelamin=htmlspecialchars($this->input->post('kelamine',true));
		$tlp=htmlspecialchars($this->input->post('tlpe',true));
		$alamat=htmlspecialchars($this->input->post('alamate',true));
		$jabatan=htmlspecialchars($this->input->post('jabatane',true));
		$status=htmlspecialchars($this->input->post('statuse',true));
		$masuk=htmlspecialchars($this->input->post('masuke',true));

		$fotopertama=$this->db->get_where('anggota',['id_anggota'=>$idanggota])->row_array();

		if($_FILES['fotoupdate']['name']){
			if($_FILES['fotoupdate']['size']==''||$_FILES['fotoupdate']['size']>2048000){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
		              <strong>max 2MB</strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota/');
				return false;
			}else{
				$config['upload_path']          = './assets/img/anggota/';
	            $config['allowed_types']        = 'jpg|png|gif';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotoupdate')){
	            	if($fotopertama['foto_anggota'] != 'kosong.jpg'){
	            		unlink(FCPATH . '/assets/img/anggota/' .$fotopertama['foto_anggota']);
	            	}
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Format file harus
				              <strong>JPG|PNG|GIF</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users/anggota/');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
				              <strong>max 2MB</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users/anggota/');
						return false;
	            	}
	            }
	            // update to mobils
				$this->db->set('foto_anggota', $foto);
				$this->db->set('nama_anggota', $nama);
				$this->db->set('lahir_anggota', $lahir);
				$this->db->set('kelamin_anggota', $kelamin);
				$this->db->set('nomer_anggota', $tlp);
				$this->db->set('alamat_anggota', $alamat);
				$this->db->set('jabatan_anggota', $jabatan);
				$this->db->set('status_anggota', $status);
				$this->db->set('masuk_anggota', $masuk);
				$this->db->where('id_anggota', $idanggota);
				$this->db->update('anggota');
				// notifikasi berhasil
				// $this->session->set_flashdata('newnotiftambah',$idproduk);
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Data
		              <strong>Berhasil</strong> diupdate.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota/');
				return false;
	        }
		}else{
			$foto=$fotopertama['foto_anggota'];
			// update to mobils
			$this->db->set('foto_anggota', $foto);
			$this->db->set('nama_anggota', $nama);
			$this->db->set('lahir_anggota', $lahir);
			$this->db->set('kelamin_anggota', $kelamin);
			$this->db->set('nomer_anggota', $tlp);
			$this->db->set('alamat_anggota', $alamat);
			$this->db->set('jabatan_anggota', $jabatan);
			$this->db->set('status_anggota', $status);
			$this->db->set('masuk_anggota', $masuk);
			$this->db->where('id_anggota', $idanggota);
			$this->db->update('anggota');
			// notifikasi berhasil
			// $this->session->set_flashdata('newnotiftambah',$idproduk);
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Data
		              <strong>Berhasil</strong> diupdate.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
			redirect('users/anggota/');
			return false;
		}
	}

	public function hapusanggota($idanggota)
	{
		$fotoanggota=$this->db->get_where('anggota',['id_anggota'=>$idanggota])->row_array();
		if($fotoanggota['foto_anggota']=='kosong.jpg'){

		}else{
			unlink(FCPATH . '/assets/img/anggota/' .$fotoanggota['foto_anggota']);
		}
		$this->db->where('id_anggota', $idanggota);
		$this->db->delete('anggota');

		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Anggota
	              <strong>Berhasil</strong> dihapus.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
		redirect('users/anggota');
		return false;
	}

	public function hapusfotoprofil($idanggota)
	{
		$fotoanggota=$this->db->get_where('anggota',['id_anggota'=>$idanggota])->row_array();
		if($fotoanggota['foto_anggota']=='kosong.jpg'){
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Gagal,
	              <strong>tidak ada</strong> foto profil!
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
			redirect('users/anggota');
			return false;
		}else{
			unlink(FCPATH . '/assets/img/anggota/' .$fotoanggota['foto_anggota']);

			$this->db->set('foto_anggota', 'kosong.jpg');
			$this->db->where('id_anggota', $idanggota);
			$this->db->update('anggota');

			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Foto profil
		              <strong>Berhasil</strong> dihapus!
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
			redirect('users/anggota');
			return false;
		}
	}

	public function tambahposting()
	{
		$judulposting=htmlspecialchars($this->input->post('judulposting',true));
		$isiposting=htmlspecialchars($this->input->post('isiposting',true));
		$tglposting=time();

		if($_FILES['fotoposting']['name']){
			if($_FILES['fotoposting']['size']==''||$_FILES['fotoposting']['size']>2048000){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
		              <strong>max 2MB</strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users');
				return false;
			}else{
				$config['upload_path']          = './assets/img/posting/';
	            $config['allowed_types']        = 'jpg|png|gif';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotoposting')){
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Format file harus
				              <strong>JPG|PNG|GIF</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
				              <strong>max 2MB</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users');
						return false;
	            	}
	            }
	            // insert to produks
				$data = array(
				        'id_posting' => null,
				        'foto_posting' => $foto,
				        'judul_posting' => $judulposting,
				        'isi_posting' => $isiposting,
				        'tanggal_posting' => $tglposting
						);
				$this->db->insert('posting', $data);
				// $idproduk = $this->db->insert_id();
				// notifikasi berhasil
				// $this->session->set_flashdata('newnotiftambah',$idproduk);
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Postingan
		              <strong>Berhasil</strong> ditambahkan.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users');
				return false;
	        }
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Foto
	              <strong>Tidak boleh</strong> kosong.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
			redirect('users');
			return false;
		}
	}

	public function hapuskomen()
	{
		// sleep(4);
		$idkomentar=htmlspecialchars($this->input->post('iddeletekomen',true));
		$idposting=htmlspecialchars($this->input->post('idpostkomen',true));

		$this->db->where('id_komentar', $idkomentar);
		$this->db->delete('komentar');
		// $this->db->delete('members',['id_member' => $idmemberbaru]);
		$querykomentar="SELECT * from komentar where id_postkomen=$idposting";
        $data['forkomen']=$this->db->query($querykomentar)->result_array();
        $this->load->view('viewajax/viewajaxkomen',$data);
	}

	public function ajaxeditpostingan()
	{
		// sleep(3);
		$idpostingan=htmlspecialchars($this->input->post('idpostingan',true));

		$ajaxedit=$this->db->get_where('posting',['id_posting'=>$idpostingan])->row_array();
		echo json_encode($ajaxedit);
	}

	public function editposting()
	{
		$idpostingedit=htmlspecialchars($this->input->post('idpostingedit',true));
		$juduledit=htmlspecialchars($this->input->post('juduledit',true));
		$isiedit=htmlspecialchars($this->input->post('isiedit',true));

		$fotopertama=$this->db->get_where('posting',['id_posting'=>$idpostingedit])->row_array();

		if($_FILES['fotoedit']['name']){
			if($_FILES['fotoedit']['size']==''||$_FILES['fotoedit']['size']>2048000){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
		              <strong>max 2MB</strong>.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users');
				return false;
			}else{
				$config['upload_path']          = './assets/img/posting/';
	            $config['allowed_types']        = 'jpg|png|gif';
	            $config['max_size']             = 2048;

	            $this->load->library('upload', $config);

	            if($this->upload->do_upload('fotoedit')){
	            	// if($fotopertama['foto_posting'] != 'kosong.jpg'){
	            		unlink(FCPATH . '/assets/img/posting/' .$fotopertama['foto_posting']);
	            	// }
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,GIF,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Format file harus
				              <strong>JPG|PNG|GIF</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Ukuran gambar terlalu besar 
				              <strong>max 2MB</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users');
						return false;
	            	}
	            }
	            // update to mobils
				$this->db->set('foto_posting', $foto);
				$this->db->set('judul_posting', $juduledit);
				$this->db->set('isi_posting', $isiedit);
				$this->db->where('id_posting', $idpostingedit);
				$this->db->update('posting');
				// notifikasi berhasil
				// $this->session->set_flashdata('newnotiftambah',$idproduk);
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Postingan
		              <strong>Berhasil</strong> diupdate.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users');
				return false;
	        }
		}else{
			$foto=$fotopertama['foto_posting'];
			// update to mobils
			$this->db->set('foto_posting', $foto);
			$this->db->set('judul_posting', $juduledit);
			$this->db->set('isi_posting', $isiedit);
			$this->db->where('id_posting', $idpostingedit);
			$this->db->update('posting');
			// notifikasi berhasil
			// $this->session->set_flashdata('newnotiftambah',$idproduk);
			$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Postingan
		              <strong>Berhasil</strong> diupdate.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
			redirect('users');
			return false;
		}
	}

	public function hapusposting($idposting)
	{
		$fotoposting=$this->db->get_where('posting',['id_posting'=>$idposting])->row_array();
		unlink(FCPATH . '/assets/img/posting/' .$fotoposting['foto_posting']);
		$this->db->where('id_posting', $idposting);
		$this->db->delete('posting');

		$this->db->where('id_postkomen', $idposting);
		$this->db->delete('komentar');

		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Postingan
	              <strong>Berhasil</strong> dihapus.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
		redirect('users');
		return false;
	}

	public function ajaxeditkegiatan()
	{
		$idkegiatan=htmlspecialchars($this->input->post('idkegiatan',true));
		$dataajax=$this->db->get_where('kegiatan',['id_kegiatan'=>$idkegiatan])->row_array();
		echo json_encode($dataajax);
		return false;
	}

	public function tambahkegiatan()
	{
		$namatambah=htmlspecialchars($this->input->post('namatambah',true));
		$isitambah=htmlspecialchars($this->input->post('isitambah',true));
		$tgltambah=time();

		$data = array(
		        'id_kegiatan' => null,
		        'nama_kegiatan' => $namatambah,
		        'isi_kegiatan' => $isitambah,
		        'tanggal_kegiatan' => $tgltambah
				);
		$this->db->insert('kegiatan', $data);

		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Kegiatan
	              <strong>Berhasil</strong> ditambah.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
		redirect('users/kegiatan');
		return false;
	}

	public function updatekegiatan()
	{
		$idkegiatanedit=htmlspecialchars($this->input->post('idkegiatanedit',true));
		$namaedit=htmlspecialchars($this->input->post('namaedit',true));
		$isiedit=htmlspecialchars($this->input->post('isiedit',true));

		$this->db->set('nama_kegiatan', $namaedit);
		$this->db->set('isi_kegiatan', $isiedit);
		$this->db->where('id_kegiatan', $idkegiatanedit);
		$this->db->update('kegiatan');

		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Kegiatan
	              <strong>Berhasil</strong> diupdate.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
		redirect('users/kegiatan');
		return false;
	}

	public function hapuskegiatan($idkegiatan)
	{
		$this->db->where('id_kegiatan', $idkegiatan);
		$this->db->delete('kegiatan');

		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Kegiatan
	              <strong> Berhasil</strong> dihapus.
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>');
		redirect('users/kegiatan');
		return false;
	}


}
