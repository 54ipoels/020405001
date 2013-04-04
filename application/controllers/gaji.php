<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gaji extends Application {

	// loading the database
	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_gaji');
		$this->load->model('m_asset');
		$this->ag_auth->restrict('user');
    }
	
	/*
	======================================================================================================
	 FUNCTION MASTER GAJI 
	======================================================================================================
	*/
	
	function master_gaji()
	{
		$data['showdata'] = $this->m_asset->ambil_data_master_gaji();
		$data['page'] = 'master_gaji';		
		$data['view_gaji'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	function add_gaji()
	{
		$data['page'] = 'add_gaji';		
		$data['add_gaji'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	function edit_gaji($id)
	{
		$data['showdata'] = $this->m_asset->ambil_data_master_gaji_by_id($id);
		$data['page'] = 'edit_gaji';		
		$data['edit_gaji'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	function delete_gaji($id)
	{
		$this->m_asset->delete_gaji($id);
		redirect('gaji/master_gaji');
	}
	function submit_gaji()
	{
		if($this->input->post('submit_gaji_add'))
		{
			$grade = $this->input->post('grade');  
			$min = $this->input->post('min');  
			$max = $this->input->post('max');  
			$update_by = "admin";
			$result = $this->m_asset->add_gaji($grade, $min, $max, $update_by);
			redirect ('gaji/master_gaji');
		}
		if($this->input->post('submit_gaji_edit'))
		{
			$result = $this->m_asset->edit_gaji();
			redirect ('gaji/master_gaji');
		}
	}
	
	/*
	======================================================================================================
	 FUNCTION PENGGAJIAN
	======================================================================================================
	*/
	
	function gaji_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'gaji_pegawai';		
		$data['view_gaji_pegawai'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	function add_penggajian()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'add_gaji_peg';		
		$data['add_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function view_detail_penggajian()
	{	
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_asset->ambil_data_penggajian_by_id($id); 
		$show = $data['showdata'];
		foreach ($show as $row){}
		$data['pot_pegawai'] = $this->m_gaji->ambil_data_pot_pegawai_id($row['pgj_id_peg']); 
		$data['pot_perusahaan'] = $this->m_gaji->ambil_data_pot_perusahaan_id($row['pgj_id_peg']); 
		$pot_pegawai = $data['pot_pegawai'];
		foreach ($data['pot_perusahaan'] as $pr){
			$data['pot_per'] = $pr['pot_per_as_jiwa'] + $pr['pot_per_jk'] + $pr['pot_per_siharta'] + $pr['pot_per_other'] + $pr['pot_per_jht'] + $pr['pot_per_tht'] + $pr['pot_per_pensiun'];
		}
		foreach ($pot_pegawai as $pp){
			$data['pot_peg'] = $pp['pot_peg_siperkasa'] + $pp['pot_peg_kokarga'] + $pp['pot_peg_kosigarden'] + $pp['pot_peg_flexy'] + $pp['pot_peg_other'] + $pp['pot_peg_ggc'] + $pp['pot_peg_jht'] + $pp['pot_peg_tht'] + $pp['pot_peg_pensiun'];
		}
		$gaji = $row['pgj_gaji_bruto'] + $row['pgj_insentive'] - round($data['pot_peg'],0);
		$data['gaji_nett'] = ceil($gaji/100)*100;
		$data['terbilang']= $this->terbilang($data['gaji_nett']);
		$data['month']=	$this->namabulan($this->uri->segment(4));
		$data['year']=$this->uri->segment(5);
		$data['pembulatan'] = $data['gaji_nett'] - $gaji;
		//$data['penerimaan'] = $row['pgj_terima'];
		$data['page'] = 'view_detail_gaji_peg';		
		$data['view_detail_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	
	function edit_penggajian()
	{
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($id); 
		foreach ($data['showdata'] as $row){}
		$data['pot_pegawai'] = $this->m_gaji->ambil_data_pot_pegawai_id($row['pgj_id_peg']); 
		$data['pot_perusahaan'] = $this->m_gaji->ambil_data_pot_perusahaan_id($row['pgj_id_peg']); 
		$data['page'] = 'edit_gaji_peg';		
		$data['edit_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$data['bulan'] = $this->namabulan($this->uri->segment(4));
		
		$this->load->view('gaji/index',$data);	
	}
	
	function submit_edit_penggajian($id)
	{
		$master_potongan = $this->m_gaji->ambil_master_potongan();
		foreach ($master_potongan as $mp){}
		$this->m_gaji->submit_edit_penggajian($id, $mp);
		
		redirect('gaji/edit_penggajian/'.$this->input->post('id_peg').'/'.$this->input->post('month').'/'.$this->input->post('year'));
	}
	
	function edit_pot_pegawai($id_peg)
	{
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($this->uri->segment(6)); 
		$data['pot_pegawai'] = $this->m_gaji->ambil_data_pot_pegawai_id($id_peg); 
		
		$data['page'] = 'edit potongan pegawai';		
		$data['edit_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$data['bulan'] = $this->namabulan($this->uri->segment(4));
		
		$this->load->view('gaji/index',$data);
	}
	
	function submit_edit_pot_pegawai($id)
	{
		$this->m_gaji->submit_edit_pot_pegawai($id);
		redirect('gaji/edit_penggajian/'.$this->input->post('id_peg').'/'.$this->input->post('month').'/'.$this->input->post('year'));
	}
	
	function edit_pot_perusahaan($id_peg)
	{
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($this->uri->segment(6)); 
		$data['pot_perusahaan'] = $this->m_gaji->ambil_data_pot_perusahaan_id($id_peg); 
		
		$data['page'] = 'edit potongan perusahaan';		
		$data['edit_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$data['bulan'] = $this->namabulan($this->uri->segment(4));
		
		$this->load->view('gaji/index',$data);
	}
	
	function submit_edit_pot_perusahaan($id)
	{
		$this->m_gaji->submit_edit_pot_perusahaan($id);
		redirect('gaji/edit_penggajian/'.$this->input->post('id_peg').'/'.$this->input->post('month').'/'.$this->input->post('year'));
	}
	
	function view_penggajian_list()
	{
		$unit = $this->input->post('unit'); //unit_code
		$month = $this->input->post('month');
		$year = $this->input->post('year'); 
		$data['page'] = 'view_gaji_peg';		
		$data['view_gaji_peg'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		
		if ($this->input->post('unit') == 'all')
		{
			$unit = '%';
		} 
		
		$this->m_gaji->create_table();
		$gaji_temp = $this->m_gaji->ambil_data_penggajian($unit,$month,$year);
		$this->m_gaji->insert_gaji_sementara($gaji_temp);
		$data['showdata'] = $this->m_gaji->get_gaji();
		$data['view_gaji_pegawai'] = 'class="this"';
		$this->m_gaji->drop_table();
		
		//print_r($data['showdata']);
		$this->load->view('gaji/index',$data);
	}
	
	function submit_penggajian()
	{	
		$unit = $this->input->post('unit');
		$id_peg = $this->input->post('nipp');
		$data['form_gaji'] = 'id="current"';
		
		$master_potongan = $this->m_gaji->ambil_master_potongan();
		foreach ($master_potongan as $mp){}
		
		if ($id_peg == 'all')
		{
			$nipp_unit = $this->m_asset->ambil_data_pegawai($unit);
			
			//print_r($data['master_potongan']);
			$this->m_gaji->input_data_gaji_per_unit($nipp_unit, $mp);
		} else {
			$this->m_gaji->input_data_gaji($id_peg, $mp);
		}
		
		redirect('gaji/gaji_pegawai');
	}
	
	function terbilang($angka) {
		$angka = (float)$angka; 
		$bilangan = array(
				'',
				'Satu',
				'Dua',
				'Tiga',
				'Empat',
				'Lima',
				'Enam',
				'Tujuh',
				'Delapan',
				'Sembilan',
				'Sepuluh',
				'Sebelas'
		);
	 
		if ($angka < 12) {
			return $bilangan[$angka];
		} else if ($angka < 20) {
			return $bilangan[$angka - 10] . ' belas';
		} else if ($angka < 100) {
			$hasil_bagi = (int)($angka / 10);
			$hasil_mod = $angka % 10;
			return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
		} else if ($angka < 200) {
			return sprintf('seratus %s', $this->terbilang($angka - 100));
		} else if ($angka < 1000) {
			$hasil_bagi = (int)($angka / 100);
			$hasil_mod = $angka % 100;
			return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
		} else if ($angka < 2000) {
			return trim(sprintf('seribu %s', $this->terbilang($angka - 1000)));
		} else if ($angka < 1000000) {
			$hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
			$hasil_mod = $angka % 1000;
			return sprintf('%s ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
		} else if ($angka < 1000000000) {
			$hasil_bagi = (int)($angka / 1000000);
			$hasil_mod = $angka % 1000000;
			return trim(sprintf('%s juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} else if ($angka < 1000000000000) {
			$hasil_bagi = (int)($angka / 1000000000);
			$hasil_mod = fmod($angka, 1000000000);
			return trim(sprintf('%s milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} else if ($angka < 1000000000000000) {
			$hasil_bagi = $angka / 1000000000000;
			$hasil_mod = fmod($angka, 1000000000000);
			return trim(sprintf('%s triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} 
	}
	
	//function menamai bulan dengan inputan angka
	function namabulan($bulan)
	{
		if($bulan == "1") { $bulan = "JANUARI"; }
		else if($bulan == "2") { $bulan = "FEBRUARI"; }
		else if($bulan == "3") { $bulan = "MARET"; }
		else if($bulan == "4") { $bulan = "APRIL"; }
		else if($bulan == "5") { $bulan = "MEI"; }
		else if($bulan == "6") { $bulan = "JUNI"; }
		else if($bulan == "7") { $bulan = "JULI"; }
		else if($bulan == "8") { $bulan = "AGUSTUS"; }
		else if($bulan == "9") { $bulan = "SEPTEMBER"; }
		else if($bulan == "10") { $bulan = "OKTOBER"; }
		else if($bulan == "11") { $bulan = "NOVEMBER"; }
		else if($bulan == "12") { $bulan = "DESEMBER"; }
		return $bulan;
	}
	
	function angkabulan($bulan)
	{
		if($bulan == "JANUARI") { $bulan = "01"; }
		else if($bulan == "FEBRUARI") { $bulan = "02"; }
		else if($bulan == "MARET") { $bulan = "03"; }
		else if($bulan == "APRIL") { $bulan = "04"; }
		else if($bulan == "MEI") { $bulan = "05"; }
		else if($bulan == "JUNI") { $bulan = "06"; }
		else if($bulan == "JULI") { $bulan = "07"; }
		else if($bulan == "AGUSTUS") { $bulan = "08"; }
		else if($bulan == "SEPTEMBER") { $bulan = "09"; }
		else if($bulan == "OKTOBER") { $bulan = "10"; }
		else if($bulan == "NOVEMBER") { $bulan = "11"; }
		else if($bulan == "DESEMBER") { $bulan = "12"; }
		return $bulan;
	}
	
	//function untuk mengambil nilai 01 dari nilai 1
	function month($month)
	{
		$array = array('1'=>'01', '2'=>'02', '3'=>'03', '4'=>'04', '5'=>'05', '6'=>'06', '7'=>'07', '8'=>'08', '9'=>'09', '10'=>'10', '11'=>'11', '12'=>'12' );
		$newmonth = element($month, $array);
		return $newmonth;
	}
}
