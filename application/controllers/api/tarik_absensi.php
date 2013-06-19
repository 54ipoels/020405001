<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarik_absensi extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_tarik_absensi');
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
			
			echo "<table>";
			echo "<tr>";
			echo "<td>NIPP</td><td>Date</td><td>Status</td><td>Grab</td><td>Verified</td>";
				
			for($a=1;$a<count($buffer);$a++)
			{
				$data = $this->parse_data($buffer[$a],"<Row>","</Row>");
				$pin = $this->parse_data($data,"<PIN>","</PIN>");
				$datetime = $this->parse_data($data,"<DateTime>","</DateTime>");
				$status = $this->parse_data($data,"<Status>","</Status>");
				$verified = $this->parse_data($data,"<Verified>","</Verified>");
								
				#masukkan data dari mesin ke database tampung / backup
				
				$cek = $this->m_tarik_absensi->cek_data_backup_mesin($pin,$datetime,$status);
				if($cek > 0){ 
					$grab = 0;
				} else {
					$grab = 1;
				}
				$this->m_tarik_absensi->input_data_backup_mesin($pin,$datetime,$status,$grab);
					
				echo "<tr><td>" . $pin . "</td><td>" . $datetime . "</td><td>" . $status . "</td><td>". $grab ."</td><td>" . $verified . "</td></tr>";
			}
				
			echo "</tr>";
			echo "</table>";
			echo "<br>"; 
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
	
	
	
}


?>