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
	/*
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
	*/
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
		$year=$this->uri->segment(5);;
		$data['showdata'] = $this->m_asset->ambil_data_penggajian_by_id($id,$year); 
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
		$year=$this->uri->segment(5);
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($id,$year); 
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
		$year = $this->input->post('year');
		$this->m_gaji->submit_edit_penggajian($id, $mp, $year);
		
		redirect('gaji/edit_penggajian/'.$this->input->post('id_peg').'/'.$this->input->post('month').'/'.$this->input->post('year'));
	}
	
	function edit_pot_pegawai($id_peg)
	{
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($this->uri->segment(6),$this->uri->segment(5)); 
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
		$data['showdata'] = $this->m_gaji->ambil_data_penggajian_id($this->uri->segment(6),$this->uri->segment(5)); 
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
		
		if ($this->input->post('unit') == 'all' OR $this->input->post('unit') == 'pilih')
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
	
	public function import()
	{
		$data['page'] = 'import data';
		$data['view_import'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	public function run_import(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		
		
		$file   = explode('.',$_FILES['database']['name']);
		$length = count($file);
		if($file[$length -1] == 'csv' ){ 
			$tmp    = $_FILES['database']['tmp_name'];
		
		$handle = fopen($tmp,"r");
		$data = $handle;
		$i=0;
		$j=0;
		do {
			if ($data[0]) {
			if($i>3){
				$id_peg=$this->m_gaji->get_id_peg_by_nipp($data[4]);
				$data_gaji =  array(
						"pgj_id_peg"		=>	$id_peg,
						"pgj_gaji_bruto"	=>  str_replace(",","",$data[7]),
						"pgj_masa_bakti"	=>	$data[10],
						"pgj_koreksi"		=>	$data[8],
						"pgj_insentive"		=>	"",
						"pgj_potongan"		=>	"",
						"pgj_pembulatan"	=>	$data[15],
						"pgj_terima"		=>	str_replace(",","",$data[16]),
						"pgj_bulan"			=>	$bulan,
						//"pgj_tahun"			=>	$tahun,
						"pgj_update_by"		=>	"admin",
					
					);
				
				$data_pot_peg = array(
						"id_peg_pot_peg_gaji"	=>	$id_peg,
						"pot_peg_siperkasa"		=>	str_replace(",","",$data[21]),
						"pot_peg_kokarga"		=>	str_replace(",","",$data[22]),
						"pot_peg_kosigarden"	=>	str_replace(",","",$data[24]),
						"pot_peg_flexy"			=>	"",
						"pot_peg_other"			=>	"",
						"pot_peg_ggc"			=>	"",
						"pot_peg_jht"			=>	str_replace(",","",$data[19]),
						"pot_peg_tht"			=>	str_replace(",","",$data[18]),
						"pot_peg_siharta"		=>	str_replace(",","",$data[20]),
						"pot_peg_kokarasa"		=>	str_replace(",","",$data[23]),
						"pot_peg_koskargo"		=>	str_replace(",","",$data[25]),
						"pot_peg_kokagayo"		=>	str_replace(",","",$data[26]),
						"pot_peg_pensiun"		=>	str_replace(",","",$data[17]),
						"pot_peg_bulan"			=>	$bulan,
						//"pot_peg_tahun"			=>	$tahun,
						"pot_peg_update_by"		=>	"admin",
						
					);	
				
				$data_pot_perusahaan	= array (
						"id_peg_pot_per_gaji"	=>	$id_peg,
						"pot_per_as_jiwa"		=>	str_replace(",","",$data[36]),
						"pot_per_jk"			=>	str_replace(",","",$data[33]),
						"pot_per_jkk"			=>	str_replace(",","",$data[34]),
						"pot_per_siharta"		=>	str_replace(",","",$data[35]),
						"pot_per_other"			=>	"",
						"pot_per_jht"			=>	str_replace(",","",$data[31]),
						"pot_per_tht"			=>	str_replace(",","",$data[30]),
						"pot_per_pensiun"		=>	str_replace(",","",$data[29]),
						"pot_per_bulan"			=>	$bulan,
						//"pot_per_tahun"			=>	$tahun,
						"pot_per_update_by"		=>	"admin",
						);	
				
				if($id_peg > 0){
					$this->m_gaji->insert_data_gaji_pegawai($data_gaji,$tahun);
					$this->m_gaji->insert_data_gaji_pot_pegawai($data_pot_peg,$tahun);
					$this->m_gaji->insert_data_gaji_pot_perusahaan($data_pot_perusahaan,$tahun);
					
				}else{
					$tidak_masuk[$j]=$data[4];
					$j++;
				}
				
			
				}
			$i++;
			
			}
		} while ($data = fgetcsv($handle,1000,","));
			if (isset($tidak_masuk)){
				$data['gagal'] = $tidak_masuk;
			};
			$data['n_gagal']	=	$j;
			if (!$handle){$data['n_gagal']="gagal";}
			$data['page'] = 'hasil import';		
			$data['view_gaji_peg'] = 'class="this"';
			$data['form_gaji'] = 'id="current"';
			$this->load->view('gaji/index',$data);
			
		} else {
			
			redirect('gaji/import');
		} 
		/*
		if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){//jagain barangkali uploadnya selain file excel <img src="http://s0.wp.com/wp-includes/images/smilies/icon_smile.gif?m=1129645325g" alt=":-)" class="wp-smiley"> 
			$tmp    = $_FILES['database']['tmp_name'];//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
			$this->load->library('excel');//Load library excelnya
			$read   = PHPExcel_IOFactory::createReaderForFile($tmp);
			$read->setReadDataOnly(true);
			$excel  = $read->load($tmp);
			$sheets = $read->listWorksheetNames($tmp);//baca semua sheet yang ada
			foreach($sheets as $sheet){
				if($this->db->table_exists($sheet)){//check sheet-nya itu nama table ape bukan, kalo bukan buang aja... nyampah doank :-p
					$_sheet = $excel->setActiveSheetIndexByName($sheet);//Kunci sheetnye biar kagak lepas :-p
					$maxRow = $_sheet->getHighestRow();
					$maxCol = $_sheet->getHighestColumn();
					$field  = array();
					$sql    = array();
					$maxCol = range('A',$maxCol);
					foreach($maxCol as $key => $coloumn){
						$field[$key]    = $_sheet->getCell($coloumn.'1')->getCalculatedValue();//Kolom pertama sebagai field list pada table
					}
					for($i = 2; $i <= $maxRow; $i++){
						foreach($maxCol as $k => $coloumn){
							$sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue();
							echo $sql[$field[$k]];
						
						}
						
						echo "<br>";
						#$this->db->insert($sheet,$sql);//ribet banget tinggal insert doank...
					}
				}
			}
		}else{
			exit('do not allowed to upload');//pesan error tipe file tidak tepat
		}
		redirect('home');//redirect after success
		*/
		
	}
	
	
	/*
	======================================================================================================
	 FUNCTION LEMBUR
	======================================================================================================
	*/
	
	function lembur_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'lembur_pegawai';		
		$data['view_lembur_pegawai'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	
	function view_lembur_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_lembur(); 
		$data['unitshow'] = $this->input->post('unit');
		$data['page'] = 'view_lembur_pegawai';		
		$data['view_lembur_pegawai'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	function view_detail_lembur()
	{	
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_asset->ambil_data_lembur_by_id($id,$this->uri->segment(5)); 
		$show = $data['showdata'];
		foreach ($show as $row){
			$penerimaan = $row['lmb_hari_kerja'] + $row['lmb_hari_libur'] + $row['lmb_ex_voed'] + $row['lmb_shift_all'] - $row['lmb_potongan'] + $row['lmb_apresiasi'] + $row['lmb_koreksi'] + $row['lmb_natura'];
		};
		$data['terbilang']= $this->terbilang($penerimaan);
		$data['month']=	$this->namabulan($this->uri->segment(4));
		$data['year']=$this->uri->segment(5);
		$data['penerimaan'] = $penerimaan;
		$data['page'] = 'view_detail_lembur';		
		$data['view_detail_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	
	function add_lembur()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'add_lembur';		
		$data['add_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function edit_lembur()
	{
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_asset->ambil_data_lembur_by_id($id,$this->uri->segment(5)); 
		$show = $data['showdata'];
		foreach ($show as $row){
			$penerimaan = $row['lmb_hari_kerja'] + $row['lmb_hari_libur'] + $row['lmb_ex_voed'] + $row['lmb_shift_all'] - $row['lmb_potongan'] + $row['lmb_apresiasi'] + $row['lmb_koreksi'] + $row['lmb_natura'];
		};
		$data['penerimaan'] = $penerimaan;
		$data['page'] = 'edit_lembur';		
		$data['edit_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function submit_lembur_pegawai()
	{
		if($this->input->post('submit_lembur_view'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$month = $this->input->post('month'); //unit_code
			$year = $this->input->post('year'); //unit_code
			$id_pegawai = $this->input->post('nipp'); //id_pegawai
			$data['year'] = $this->input->post('year');
			$data['page'] = 'view_lembur_pegawai';		
			$data['view_lembur_pegawai'] = 'class="this"';
			$data['form_gaji'] = 'id="current"';
			
			$data['showdata'] = $this->m_asset->ambil_data_lembur($unit,$id_pegawai,$month,$year); 
			$this->load->view('gaji/index',$data);
		}
		
		
		if($this->input->post('submit_lembur_add'))
		{
			$check = $this->m_asset->add_lembur();
			redirect('gaji/lembur_pegawai');
		}
		//submit dari Add Libur Nasional
		else if($this->input->post('submit_lembur_edit'))
		{
			$result = $this->m_asset->edit_lembur();
			redirect('gaji/lembur_pegawai');
		}
	}
	
	function generate_lembur_pegawai()
	{
		
		if ($unit = $this->input->post('unit') == "pilih")
		{
			redirect('gaji/lembur_pegawai');
		}
		else
		{
			$unit = $this->input->post('unit'); //unit_code
			$month = $this->input->post('month'); //unit_code
			$year = $this->input->post('year'); //unit_code
			
			$data_absen = $this->m_gaji->ambil_data_absen($unit,$month,$year);
			
			$this->m_gaji->proses_hitung_lembur($data_absen,$month,$year);
			
			?>
			<script>alert('Generate Lembur Telah Selesai')</script>
			<?php
			redirect('gaji/lembur_pegawai');
		}
	}
	
	
	/*
	======================================================================================================
	 FUNCTION MASTER LEMBUR
	======================================================================================================
	*/
	
	function master_lembur()
	{	
		#pagination config
		$config['base_url'] = base_url().'index.php/gaji/master_lembur/'; //set the base url for pagination
		$config['total_rows'] = $this->m_gaji->count_master_lembur(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		
		$data['showdata'] = $this->m_gaji->ambil_data_master_lembur($config['per_page'],$page); 
		$data['page'] = 'master_lembur';		
		$data['view_master_lembur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	
	function add_master_lembur()
	{
		$data['page'] = 'add_master_lembur';		
		$data['view_master_lembur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function edit_master_lembur($id)
	{
		$data['showdata'] = $this->m_gaji->ambil_data_master_lembur_by_id($id); 
		$data['page'] = 'edit_master_lembur';		
		$data['view_master_lembur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function submit_master_lembur()
	{
		if($this->input->post('submit_master_lembur_add'))
		{
			$check = $this->m_gaji->add_master_lembur();
			redirect('gaji/master_lembur');
		}
		
		else if($this->input->post('submit_master_lembur_edit'))
		{
			$result = $this->m_gaji->edit_master_lembur();
			redirect('gaji/master_lembur');
		}
	}
	
	/*
	======================================================================================================
	 FUNCTION MASTER GAJI
	======================================================================================================
	*/
	
	function master_gaji()
	{	
		#pagination config
		$config['base_url'] = base_url().'index.php/gaji/master_gaji/'; //set the base url for pagination
		$config['total_rows'] = $this->m_gaji->count_master_potongan_gaji(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		
		$data['showdata'] = $this->m_gaji->ambil_data_master_potongan_gaji($config['per_page'],$page); 
		$data['page'] = 'master_gaji_potongan';		
		$data['view_master_gaji'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);
	}
	
	
	function add_master_gaji_potongan()
	{
		$data['page'] = 'add_master_gaji_potongan';		
		$data['view_master_gaji'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('gaji/index',$data);	
	}
	
	function submit_master_gaji_potongan()
	{
		$check = $this->m_gaji->add_master_gaji_potongan();
		redirect('gaji/master_gaji');
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
