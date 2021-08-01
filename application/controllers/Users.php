<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$queryposting="SELECT posting.*, count(id_postkomen) as komentar from posting left join komentar on posting.id_posting=komentar.id_postkomen group by id_posting order by id_posting desc";
		$data['postings']=$this->db->query($queryposting)->result_array();

		$queryslide="SELECT * from posting order by id_posting desc limit 5";
		$data['slides']=$this->db->query($queryslide)->result_array();

		$queryslidegaleri="SELECT * from posting order by id_posting desc";
		$data['slidegaleri']=$this->db->query($queryslidegaleri)->result_array();

		$querymax="SELECT max(id_posting) as maxid from posting";
		$data['maxid']=$this->db->query($querymax)->row_array();
		// $data['komentars']=$this->db->get('komentar')->result_array();

		$data['title']='beranda';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/parallax',$data);
		$this->load->view('templates/bottombar',$data);
		// $this->load->view('templates/slide',$data);
		$this->load->view('user/beranda',$data);
	}

	public function anggota()
	{
		$queryorderanggota="SELECT * from anggota order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		$querycountanggota="SELECT status_anggota, count(*) as status from anggota group by status_anggota order by FIELD(status_anggota,'aktif','non aktif','menikah','drop out')";
		$queryaktif="SELECT count(*) as aktif from anggota where status_anggota='aktif'";
		$querynonaktif="SELECT count(*) as nonaktif from anggota where status_anggota='non aktif'";
		$querykelamin="SELECT kelamin_anggota, count(*) as kelamin from anggota group by kelamin_anggota order by FIELD(kelamin_anggota,'laki-laki','perempuan')";

		$data['allanggota']=$this->db->query($queryorderanggota)->result_array();
		$data['countanggota']=$this->db->query($querycountanggota)->result_array();
		$data['countaktif']=$this->db->query($queryaktif)->row_array();
		$data['countnonaktif']=$this->db->query($querynonaktif)->row_array();
		$data['countkelamin']=$this->db->query($querykelamin)->result_array();
		// var_dump($data['countanggota']);die;
		$data['title']='anggota';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/bottombar',$data);
		$this->load->view('user/anggota',$data);
	}

	public function kegiatan()
	{
		$qkegiatan="SELECT * from kegiatan order by id_kegiatan desc";
		$data['kegiatans']=$this->db->query($qkegiatan)->result_array();

		$data['title']='kegiatan';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('templates/bottombar',$data);
		$this->load->view('user/kegiatan',$data);
	}

	public function aboutsttkertasari()
	{
		$this->load->view('user/aboutstt');
	}

	public function ajaxdetailanggota()
	{
		// sleep(4);
		$idanggota=htmlspecialchars($this->input->post('idanggota',true));
		$datadetail=$this->db->get_where('anggota', ['id_anggota' => $idanggota])->row_array();
		echo json_encode($datadetail);
	}

	public function carianggota()
	{
		// sleep(4);
		$keywordnama=htmlspecialchars($this->input->post('keywordnama',true));
		$keywordstatus=htmlspecialchars($this->input->post('keywordstatus',true));

		if($keywordstatus=='all'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}else if($keywordstatus=='a and n'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' and (status_anggota = 'aktif' or status_anggota = 'non aktif') order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}else if($keywordstatus=='aktif'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' and status_anggota = 'aktif' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}else if($keywordstatus=='non aktif'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' and status_anggota = 'non aktif' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}else if($keywordstatus=='menikah'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' and status_anggota = 'menikah' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}else if($keywordstatus=='drop out'){
			$queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' and status_anggota = 'drop out' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		}
		// $queryorderanggota="SELECT * from anggota where nama_anggota like '%$keywordnama%' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		$data['allanggota']=$this->db->query($queryorderanggota)->result_array();
		$this->load->view('viewajax/ajaxcarianggota',$data);
	}

	public function tambahkomen()
	{
		// sleep(4);
		$idposting=htmlspecialchars($this->input->post('idposting',true));
		$kirimip=htmlspecialchars($this->input->post('kirimip',true));
		$kirimidpost=htmlspecialchars($this->input->post('kirimidpost',true));
		$kirimnama=htmlspecialchars($this->input->post('kirimnama',true));
		$kirimisi=htmlspecialchars($this->input->post('kirimisi',true));
		$tglkomen=time();

		$namanull=trim($kirimnama);
	    if(empty($namanull)){
	    	$querykomentar="SELECT * from komentar where id_postkomen=$idposting";
	        $data['forkomen']=$this->db->query($querykomentar)->result_array();
	        $this->load->view('viewajax/viewajaxkomen',$data);
			return false;
	    }else{
	      $namabaru = preg_replace('/\s+/', ' ', $namanull);
	    }
	    $isinull=trim($kirimisi);
	    if(empty($isinull)){
	    	$querykomentar="SELECT * from komentar where id_postkomen=$idposting";
	        $data['forkomen']=$this->db->query($querykomentar)->result_array();
	        $this->load->view('viewajax/viewajaxkomen',$data);
			return false;
	    }else{
	      $isibaru = preg_replace('/\s+/', ' ', $isinull);
	    }

		// $notip="SELECT * from komentar where ip_komentar!='$kirimip' and nama_komentar='$kirimnama'";
  //       $notipok=$this->db->query($notip)->row_array();

  //       if($notipok){
  //       	echo "nama sudah ada";
  //       	return false;
  //       }

		$matchip="SELECT * from komentar where ip_komentar='$kirimip'";
        $matchipok=$this->db->query($matchip)->row_array();
        // echo $matchipok['nama_komentar'];die;
        if($this->session->userdata('level_user')){
        	$data = array(
		        'id_komentar' => null,
		        'id_postkomen' => $idposting,
		        'foto_komentar' => 'komenadmin.png',
		        'nama_komentar' => 'Admin',
		        'isi_komentar' => $isibaru,
		        'tanggal_komentar' => $tglkomen,
		        'ip_komentar' => $kirimip,
		        'level_komentar' => 'admin'
				);
			$this->db->insert('komentar', $data);
        }else{
	        if($matchipok){
	        	$namasama=$matchipok['nama_komentar'];
	        	$ipsama=$matchipok['ip_komentar'];
	        	$data = array(
			        'id_komentar' => null,
			        'id_postkomen' => $idposting,
			        'foto_komentar' => 'komenuser.jpg',
			        'nama_komentar' => $namasama,
			        'isi_komentar' => $isibaru,
			        'tanggal_komentar' => $tglkomen,
			        'ip_komentar' => $ipsama,
			        'level_komentar' => 'users'
					);
				$this->db->insert('komentar', $data);	
	        }else{
				// insert to komen
				$data = array(
				        'id_komentar' => null,
				        'id_postkomen' => $idposting,
				        'foto_komentar' => 'komenuser.jpg',
				        'nama_komentar' => $namabaru,
				        'isi_komentar' => $isibaru,
				        'tanggal_komentar' => $tglkomen,
				        'ip_komentar' => $kirimip,
				        'level_komentar' => 'users'
						);
				$this->db->insert('komentar', $data);
	        }
        }
		// $datanotif=['notif'=>'Data berhasil ditambah'];
  //       echo json_encode($datanotif);
		$querykomentar="SELECT * from komentar where id_postkomen=$idposting";
        $data['forkomen']=$this->db->query($querykomentar)->result_array();
        $this->load->view('viewajax/viewajaxkomen',$data);
	}

	public function refreskomen()
	{
		$idrefres=htmlspecialchars($this->input->post('idrefres',true));
		$querykomentar="SELECT * from komentar where id_postkomen=$idrefres";
        $data['forkomen']=$this->db->query($querykomentar)->result_array();
        $this->load->view('viewajax/viewajaxkomen',$data);
	}

	public function refrescountkomen()
	{
		$idposting=htmlspecialchars($this->input->post('idposting',true));

		$querycount="SELECT count(*) as count from komentar where id_postkomen=$idposting";
        $datacount=$this->db->query($querycount)->row_array();
        echo $datacount['count'];
        return false;
	}

	public function cetakanggota()
	{
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
		$querya="SELECT * from anggota where status_anggota = 'aktif' or status_anggota = 'non aktif' order by FIELD(jabatan_anggota,'ketua','wakil ketua','bendahara','humas','anggota'), FIELD(status_anggota,'aktif','non aktif','menikah','drop out'), nama_anggota";
		$queryaktif="SELECT count(*) as aktif from anggota where status_anggota='aktif'";
		$querynonaktif="SELECT count(*) as nonaktif from anggota where status_anggota='non aktif'";
		
		$data['cetakanggota']=$this->db->query($querya)->result_array();
		$data['countaktif']=$this->db->query($queryaktif)->row_array();
		$data['countnonaktif']=$this->db->query($querynonaktif)->row_array();

		$html=$this->load->view('pdf/cetakanggota',$data,true);
		$mpdf->WriteHTML($html);
		$mpdf->Output('STT KERTASARI.pdf',\Mpdf\Output\Destination::INLINE);
	}

	public function tambahanggotauser()
	{
		// if(!$this->session->userdata('level_user')){
		// 	redirect('users');
		// }
		$nama=htmlspecialchars($this->input->post('namaanggotauser',true));
		$lahir=htmlspecialchars($this->input->post('lahiranggotauser',true));
		$kelamin=htmlspecialchars($this->input->post('kelaminanggotauser',true));
		$tlp=htmlspecialchars($this->input->post('tlpanggotauser',true));
		$alamat=htmlspecialchars($this->input->post('alamatanggotauser',true));
		$jabatan=htmlspecialchars($this->input->post('jabatananggotauser',true));
		$status=htmlspecialchars($this->input->post('statusanggotauser',true));
		$masuk=htmlspecialchars($this->input->post('masukanggotauser',true));

		if($_FILES['fotoanggotauser']['name']){
			if($_FILES['fotoanggotauser']['size']==''||$_FILES['fotoanggotauser']['size']>2048000){
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Gagal, Ukuran gambar terlalu besar 
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

	            if($this->upload->do_upload('fotoanggotauser')){
	            	$foto=$this->upload->data('file_name');
	            }else{
	            	$error = $this->upload->display_errors('','');
	            	if($error=='The filetype you are attempting to upload is not allowed.'){
	            		$errors=['error'=>'Format file harus JPG,PNG'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Gagal, Format file harus
				              <strong>JPG|PNG|GIF</strong>.
				              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>');
						redirect('users/anggota');
						return false;
	            	}else{
	            		$errors=['error'=>'Max gambar 2MB'];
	            		$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Gagal, Ukuran gambar terlalu besar 
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
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Data anda
		              <strong> Berhasil</strong> ditambahkan.
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
				$this->session->set_flashdata('message','<div class="alert alert-warning alert-dismissible fade show" role="alert">Data anda
		              <strong> Berhasil</strong> ditambahkan.
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		              </button>
		            </div>');
				redirect('users/anggota');
				return false;
		}
	}


}
