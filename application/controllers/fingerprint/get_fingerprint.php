<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_fingerprint extends Application{
	
	/**
	 * PT Gapura Angkasa
	 * Employee Management System.
	 * ver 3.2
	 * 
	 * App id :
	 * App code :
	 *
	 * news controller
	 *
	 * url : http://ems.dps.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fingerprint');
	}
	
	public function index()
	{
		redirect('fingerprint/get_fingerprint/manual');	
	}
	
	public function auto()
	{
		#$key = "0";
		$query = $this->fingerprint->get_ip();
		foreach ($query as $ip ):
		
			$Connect = fsockopen($ip->fm_ip, "80", $errno, $errstr, 30);
			
			if(!$Connect)
			{
				# fail 
				$fp_ip = 	$ip->fm_ip;
				$fp_status = 'fail';
				$this->fingerprint->save_log($fp_ip, $fp_status);
				echo "fail";
			}
			else
			{
						#$Connect = fsockopen($ip->fm_ip, "80", $errno, $errstr, 30);
						$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">0</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
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
						
						$fp_ip = 	$ip->fm_ip;
						$fp_status = 'success';
						$this->fingerprint->save_log($fp_ip, $fp_status);
						
						$buffer = $this->parse_data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
						$buffer = explode("\r\n",$buffer);
				
						for($a=1;$a<count($buffer);$a++)
						{
							$data = $this->parse_data($buffer[$a],"<Row>","</Row>");
							$pin = $this->parse_data($data,"<PIN>","</PIN>");
							$datetime = $this->parse_data($data,"<DateTime>","</DateTime>");
							$status = $this->parse_data($data,"<Status>","</Status>");
							$verified = $this->parse_data($data,"<Verified>","</Verified>");
							$fd_ip = $fp_ip;
							$fd_nipp = $pin;
							$fd_datetime = $datetime;
							$fd_status = $status;
							$fd_grab = '0';
							$fd_update_by = 'system';
							
							$dup = $this->fingerprint->check_dup_data($fd_ip,$fd_nipp,$fd_datetime,$fd_status,$fd_grab, $fd_update_by);
							
							if($dup == 0) # check dup
							{
								# if no duplicate data, data will save to table fingerprint_data
								$this->fingerprint->save_data($fd_ip,$fd_nipp,$fd_datetime,$fd_status,$fd_grab, $fd_update_by);
								
								# del invalid data
								$this->fingerprint->del_invalid_data();
							}
						}
				#fclose($Connect);				
				}
		endforeach;
	}
	
	
	function verify_in()
	{
		# get from table data with grab=0
		$query_in = $this->fingerprint->get_unverify_data_in();
		
		
		
		foreach($query_in as $item_in):
			$id = $item_in->fd_id;
			$nipp = $item_in->fd_nipp;
			$datetime = $item_in->fd_datetime;
			
			# get first in
			$query_first_in = $this->fingerprint->get_first_in($nipp, $datetime);
			
			foreach($query_first_in as $item_first_in):
				$fd_nipp_in = $item_first_in->fd_nipp;
				$fd_datetime_in = $item_first_in->fd_datetime;
				
				# insert first in into verify table
				$verifiy_id = $this->fingerprint->save_first_in($fd_nipp_in, $fd_datetime_in);
				
				# inject to schedule
				$query_id_sched= $this->fingerprint->get_id_sched_in($fd_nipp_in, $fd_datetime_in);
				foreach($query_id_sched as $item_sched):
					$id_sched = $item_sched->fschpegabs_id;
					
					if(!$id_sched == NULL )
					{
						# save item to schdule
						$this->fingerprint->inject_schedule_in($id_sched, $datetime);
					
						# change status to grab = 1 on every saved item to schedule
						$this->fingerprint->update_grab_verify($verifiy_id);
					}
				endforeach;
				
			endforeach;
			
		# update grab=1
		$this->fingerprint->update_grab($id);	
			
		endforeach;
	}
	
	
	function verify_out()
	{
		# get from table data with grab=0
		$query_out = $this->fingerprint->get_unverify_data_out();
		
		foreach($query_out as $item_out):
			$id = $item_out->fd_id;
			$nipp = $item_out->fd_nipp;
			$datetime = $item_out->fd_datetime;
			
			# get first out
			$query_last_out = $this->fingerprint->get_last_out($nipp, $datetime);
			
			foreach($query_last_out as $item_first_out):
				$fd_nipp_out = $item_first_out->fd_nipp;
				$fd_datetime_out = $item_first_out->fd_datetime;
				
				# insert first in into verify table
				$verifiy_id = $this->fingerprint->save_last_out($fd_nipp_out, $fd_datetime_out);
				
				# inject to schedule
				$query_id_sched= $this->fingerprint->get_id_sched_out($fd_nipp_out, $fd_datetime_out);
				foreach($query_id_sched as $item_sched):
					$id_sched = $item_sched->fschpegabs_id;
					
					if(!$id_sched == NULL )
					{
						# save item to schdule
						$this->fingerprint->inject_schedule_out($id_sched, $fd_datetime_out);
					
						# change status to grab = 1 on every saved item to schedule
						$this->fingerprint->update_grab_verify($verifiy_id);
					}
				endforeach;
				
			endforeach;
			
			# update grab=1
			$this->fingerprint->update_grab($id);
			
		endforeach;
	}
	/*function inject_in()
	{
		$data['query'] = $this->fingerprint->get_id_sched_in($nipp, $datetime, $status);
		foreach($query as $item):$id_sched = $item->fschpegabs_id;endforeach;
		$this->fingerprint->inject_schedule_in($id_sched, $datetime);
										
		# change status to grab = 1
		$this->fingerprint->update_grab($id);
	}*/
	
	
	public function manual()
	{
		#$key = "0";
		$fp_ip = $this->uri->segment(4, 0);
		if($fp_ip == '0'){redirect('perkerja');}
		echo $fp_ip;
		$Connect = fsockopen($fp_ip, "80", $errno, $errstr, 1);
			
			if($Connect)
			{
				$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">0</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
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
				
				
				$fp_status = 'success';
				
				$this->fingerprint->save_log($fp_ip, $fp_status);
			}
			else
			{
				
				$fp_status = 'fail';
				
				$this->fingerprint->save_log($fp_ip, $fp_status);
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
				$fd_ip = $fp_ip;
				$fd_nipp = $pin;
				$fd_datetime = $datetime;
				$fd_status = $status;
				$fd_grab = '0';
				$fd_update_by = 'system';
				$this->fingerprint->save_data($fd_ip,$fd_nipp,$fd_datetime,$fd_status,$fd_grab, $fd_update_by);
			}
		
	}
	
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
    
	/*public function get_first_in()
	{
		$fd_nipp = $this->uri->segment(4, 0);
		$fd_datetime = $this->uri->segment(5, 0);
		$fd_status = $this->uri->segment(6, 0);
		
		
		$query = $this->fingerprint->get_first_in($fd_nipp, $fd_datetime, $fd_status);
		
		#echo $item;
		foreach($query as $item):
		$fd_id = $item->id;
		$fd_datetime = $item->fd_datetime;
		endforeach;
		
			#return $item;
			
			print_r($query);
			
		echo $fd_id;
		
	}*/
	
	/*function get_fsch_id()
	{
		$fd_nipp =  '2980924';
		$fd_datetime = '2013-07-01 10:00:00';
		$fd_status = '0';
		
		$data['query'] = $this->fingerprint->get_id_sched($fd_nipp, $fd_datetime, $fd_status);
		#foreach($query as $item):$id = $item->id;endforeach;
		#print_r($data);
	}*/
	
	
	/*function inject_sched()
	{
		# action for each status------
								
								if($status == '0') # in
								{
									# get first id
									$query = $this->fingerprint->get_first_in($fd_nipp, $fd_datetime, $fd_status);
									foreach($query as $item):
										$id = $item->id;
										$nipp = $item->fd_nipp;
										$datetime = $item->fd_datetime;
										$status = $item->fd_status;
									endforeach;
									
									if (!$id == NULL)
									{
										# inject into schedule in
										$data['query'] = $this->fingerprint->get_id_sched_in($nipp, $datetime, $status);
										foreach($query as $item):$id_sched = $item->fschpegabs_id;endforeach;
										$this->fingerprint->inject_schedule_in($id_sched, $datetime);
										
										# change status to grab = 1
										$this->fingerprint->update_grab($id);
									}
			
								}
								elseif($status == '1') # out
								{
									# get last id
									$query = $this->fingerprint->get_last_out($fd_nipp, $fd_datetime, $fd_status);
									foreach($query as $item):$id = $item->id;endforeach;
									
									# inject into schedule out
									
									# change status to grab = 1
								}
								elseif($status == '2') # break in
								{
								}
								elseif($status == '3') # break out
								{
								}
								elseif($status == '4') # overtime in
								{
								}
								else # overtime out
								{
								}
								
								# action for each status------
	}*/
	
}
/* End of file news.php */
/* Location: ./application/controllers/information/news.php */