<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarik_absensi extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_tarik_absensi');
		$this->load->model('m_filter_absensi');
	}
	
	public function index()
	{
		$ip = $this->uri->segment(4);
		$ipcek = $ip/1000;
		if($ipcek !== 0){
			
			$key = "0";
			$Connect = fsockopen($ip, "80", $errno, $errstr, 1);
				
			if($Connect)
			{
				$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
				$newLine="\r\n";
				fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
				fputs($Connect, "Content-Type: text/xml".$newLine);
				fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
				fputs($Connect, $soap_request.$newLine);
				$buffer="";
				while($Response=fgets($Connect, 1024))
				{
					$buffer=$buffer.$Response;
				}
			}
			else
			{
				echo 'fail';
			}
				
			$buffer = $this->parse_data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
			$buffer = explode("\r\n",$buffer);
			
				
			for($a=1;$a<count($buffer);$a++)
			{
				$data = $this->parse_data($buffer[$a],"<Row>","</Row>");
				$pin = $this->parse_data($data,"<PIN>","</PIN>");
				$datetime = $this->parse_data($data,"<DateTime>","</DateTime>");
				$status = $this->parse_data($data,"<Status>","</Status>");
				$verified = $this->parse_data($data,"<Verified>","</Verified>");
								
				#masukkan data dari mesin ke database tampung / backup
					
				#data pada finger print tidak dihapus
				if(($pin !== "") AND ($datetime !=="" )){
					$cekdup = $this->m_tarik_absensi->cek_dup_backup_mesin($pin,$datetime,$status);
					if($cekdup == 0)
					{
						$cek = $this->m_tarik_absensi->cek_data_backup_mesin($pin,$datetime,$status);
						if($cek > 0){ 
							$grab = 0;  
						} else {
							$grab = 1;
						}
						$this->m_tarik_absensi->input_data_backup_mesin($pin,$datetime,$status,$grab);
					}
				}
			}
			$this->filter_absensi();
		} else {
			echo "Error IP was not detected";
		}
	}
	
	
	# Parse Data untuk tarik data absensi dari mesin sidik jari, default bawaan pabrik
	function parse_data($data,$p1,$p2)
	{
		$data=" ".$data;
		$hasil="";
		$awal=strpos($data,$p1);
		if($awal!=""){
			$akhir=strpos(strstr($data,$p1),$p2);
			if($akhir!=""){
				$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
			}
		}
		return $hasil;
		echo 'hasil' . $hasil;	
	}
	
	
	public function filter_absensi()
	{
		$this->m_filter_absensi->copy_dbmesin_to_datatampung();
		
		$backup = $this->m_filter_absensi->get_data_tampung();
		if($backup !== 0){
			foreach ($backup as $row){
				print_r($row);
				$year 		=substr($row['dt_datetime'],0,4);
				$nipp		=$row['dt_nipp'];
				$datetime	=$row['dt_datetime'];
				$status		=$row['dt_status'];
				if(($datetime !== "0000-00-00 00:00:00") OR ($nipp !== "") ){
					$dup = $this->m_filter_absensi->cek_dup_tabel_absensi($nipp,$datetime,$status);
					foreach ($dup as $row_dup)
					{
						$this->m_filter_absensi->cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year);
					}
				}
			}
			$this->m_filter_absensi->truncate_data_tampung(); // mengosongkan tabel datatampung  dengan menyisakan 1 data terakhir sebagai kondisi selanjutnya 
		}
	}
	
	
}


?>