<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tips extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('tips_model');
	}

	public function index(){
		$data['title']		= 'Halaman Data Tips Kesehatan';
		$data['sub_title']	= "Data Tips Kesehatan";
		$data['tips']		= $this->tips_model->fetchAll();
		$data['konten'] 	= "tips/tips";
		$this->load->view('layout/wrapper', $data, FALSE); 
	}

	public function add(){
		$data['title']		= 'Halaman Data Tips Kesehatan';
		$data['sub_title']	= "Add Tips Kesehatan";
		$data['konten'] 	= "tips/add_tips";
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function actionAdd(){
		if($this->input->post('btnSimpan') !== NULL){
			$valid = $this->form_validation;
			$valid->set_rules('judul', 'Judul', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('isi', 'Isi', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('pengarang', 'Pengarang', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('tanggal', 'Tanggal', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);

			if($valid->run() === FALSE) {
				$data['title']		= 'Halaman Data Tips';
				$data['sub_title']	= "Add Tips";
				$data['konten'] 	= "tips/add_tips";
				$this->load->view('layout/wrapper', $data, FALSE);
			}
			else{
				if(!empty($_FILES['gambar']['name'])){				
					$config['upload_path']   = $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/';
					$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
					$config['max_size']      = '12000'; // KB
					$config['file_name']	 = round(microtime(true)*1000);
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('gambar')){
						$data['title']		= 'Halaman Data Tips';
						$data['sub_title']	= "Add Tips";
						$data['konten'] 	= "tips/add_tips";
						$data['error'] 		= $this->upload->display_errors();
						$this->load->view('layout/wrapper', $data, FALSE);
					}
					else{
						$upload_data        		= array('uploads' => $this->upload->data());
						// Foto Edit
						$config['image_library']  	= 'gd2';
						$config['source_image']   	= $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/'.$upload_data['uploads']['file_name'];
						$config['create_thumb']   	= FALSE;
						$config['quality']       	= "100%";
						$config['maintain_ratio']   = TRUE;
						$config['width']       		= 360; // Pixel
						$config['height']       	= 360; // Pixel
						$config['x_axis']       	= 0;
						$config['y_axis']       	= 0;
						$config['thumb_marker']   	= '';
						//load library images
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$dataTips 	= array(
							'judul'		=> $this->input->post('judul'),
							'isi'		=> $this->input->post('isi'),
							'gambar'	=> $upload_data['uploads']['file_name'],
							'pengarang'	=> $this->input->post('pengarang'),
							'tanggal'	=> $this->input->post('tanggal')
						);
						// var_dump($dataTips);die();
						$this->tips_model->insert($dataTips);
						$this->session->set_flashdata('respon', 'Data berhasil di Inputkan');
						redirect('admin/tips','refresh');
					}
				}
				else{
					$dataTips 	= array(
						'judul'		=> $this->input->post('judul'),
						'isi'		=> $this->input->post('isi'),
						'pengarang'	=> $this->input->post('pengarang'),
						'tanggal'	=> $this->input->post('tanggal')
					);
					$this->tips_model->insert($dataTips);
					$this->session->set_flashdata('respon', 'Data berhasil di Inputkan');
					redirect('admin/tips','refresh');
				}
			}
		}
		else{
			show_404();
		}
	}

	public function fetchSingle($id){
		$dataTips = $this->tips_model->fetchId( $id );
    	$data['title']		= 'Halaman Data Tips';
		$data['sub_title']	= "Update Tips";
		$data['tips']		= $dataTips;
		$data['konten'] 	= "tips/update_tips";
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function actionUpdate(){
		if($this->input->post('btnSimpan')!== NULL){
			$id = $this->input->post('id');
			$valid = $this->form_validation;
			$valid->set_rules('judul', 'Judul', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('isi', 'Isi', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('pengarang', 'Pengarang', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('tanggal', 'Tanggal', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			if($valid->run() === FALSE) {
				$dataInfo = $this->info_model->fetchId( $id );
		    	$data['title']		= 'Halaman Data Berita Kesehatan';
				$data['sub_title']	= "Update Data Berita Kesehatan";
				$data['info']		= $dataInfo;
				$data['konten'] 	= "info/update_info";
				$this->load->view('layout/wrapper', $data, FALSE);
			}
			else{
				if(!empty($_FILES['gambar']['name'])){				
					$config['upload_path']   = $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/';
					$config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
					$config['max_size']      = '12000'; // KB
					$config['file_name']	 = round(microtime(true)*1000);
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('gambar')){
						$data['title']		= 'Halaman Data Tips';
						$data['sub_title']	= "Update Tips";
						$data['konten'] 	= "tips/update_tips";
						$data["tips"] 	    = $this->tips_model->fetchId($id);
						$data['error']	    = $this->upload->display_errors();
						$this->load->view('layout/wrapper', $data, FALSE);
					}
					else{
						if($this->input->post('old_image') !== 'NO FOTO'){
				            $hapus_gambar = $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/'.$this->input->post('old_image');
				            unlink($hapus_gambar);
						}
						$upload_data        		= array('uploads' =>$this->upload->data());
						// Foto Edit
						$config['image_library']  	= 'gd2';
						$config['source_image']   	= $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/'.$upload_data['uploads']['file_name'];
						$config['create_thumb']   	= FALSE;
						$config['quality']       	= "100%";
						$config['maintain_ratio']   = TRUE;
						$config['width']       		= 360; // Pixel
						$config['height']       	= 360; // Pixel
						$config['x_axis']       	= 0;
						$config['y_axis']       	= 0;
						$config['thumb_marker']   	= '';
						//load library images
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$dataTips 	= array(
							'judul'		=> $this->input->post('judul'),
							'isi'		=> $this->input->post('isi'),
							'gambar'	=> $upload_data['uploads']['file_name'],
							'pengarang'	=> $this->input->post('pengarang'),
							'tanggal'	=> $this->input->post('tanggal')
						);
						$this->tips_model->update( $id, $dataTips );
						$this->session->set_flashdata('respon', 'Data berhasil di Ubah');
						redirect('admin/tips','refresh');
					}
				}
				else{
					$dataTips 	= array(
						'judul'		=> $this->input->post('judul'),
						'isi'		=> $this->input->post('isi'),
						'pengarang'	=> $this->input->post('pengarang'),
						'tanggal'	=> $this->input->post('tanggal')
					);
					$this->tips_model->update( $id, $dataTips );
					$this->session->set_flashdata('respon', 'Data berhasil di Ubah');
					redirect('admin/tips','refresh');
				}
			}
		}
		else{
			show_404();
		}
	}

	public function deleteTips( $id ){
		if ($this->input->post('btnSimpan') !== NULL){
			if($this->input->post('old_image') !== 'NO FOTO'){
				$hapus_gambar = $_SERVER['DOCUMENT_ROOT'].'/testmark05/assets/dist/img/content/'.$this->input->post('old_image');
				unlink($hapus_gambar);
			}
			$deleteData = $this->tips_model->delete( $id );
			$this->session->set_flashdata('respon', 'Data berhasil di Hapus');
			redirect('admin/tips','refresh');
		}
		else{
			show_404();
		}
	}
}

/* End of file Tips.php */
/* Location: ./application/controllers/Tips.php */