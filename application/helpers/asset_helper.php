<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); {
	
	function createDateRangeArray($start, $end) 
	{
		$range = array();
		if (is_string($start) === true) $start = strtotime($start);
		if (is_string($end) === true ) $end = strtotime($end);
		if ($start > $end) return createDateRangeArray($end, $start);
		do {
		$range[] = date('Y-m-d', $start);
		$start = strtotime("+ 1 day", $start);
		}
		while($start < $end);
			
		return $range;
	}

	/* lama masih nyimpan didata absen
	function ambil_timein_absensi($fschpeg_id, $tgl, $year)
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('fschpegabs_fschpeg_id', $fschpeg_id);
		$ci->db->like('fschpegabs_sch_time_in', $tgl, 'after');
		$ci->db->limit(1);
		$data = $ci->db->get('v3_fschpeg_absensi_'.$year);
		
		foreach ($data->result() as $row)
		{
			if($row->fschpegabs_off_status == 0)
			{
				return "<a href=\"#\" title=\"".substr($row->fschpegabs_sch_time_in, 11, 5)."\">".substr($row->fschpegabs_sch_time_in, 11, 2)."</a>";
			}
			else if($row->fschpegabs_off_status == 1)
			{
				return "<a href=\"#\" title=\"LIBUR\">L</a>";
			}
			else
			{
				$ci->db->where('lnas_date', $tgl);
				$data2 = $ci->db->get('v3_libur_nasional');
				foreach ($data2->result() as $row2)
				{
					return "<a href=\"#\" title=\"".$row2->lnas_desc."\">HL</a>";
				}
			}
		}
	}
	*/
	
	function ambil_timein_absensi($fschpeg_id, $tgl, $year)
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('fschpegabs_fschpeg_id', $fschpeg_id);
		$ci->db->like('fschpegabs_sch_time_in', $tgl, 'after');
		$ci->db->limit(1);
		$data = $ci->db->get('v3_fschpeg_absensi_'.$year);
		
		foreach ($data->result() as $row)
		{
			$ci->db->where('lnas_date', $tgl);
			$data2 = $ci->db->get('v3_libur_nasional');
				
			foreach ($data2->result() as $row2)
			{
				$desclibur = $row2->lnas_desc;
			}
			
			if(isset($desclibur))
			{
				return "<a href=\"#\" title=\"".$desclibur."\">HL</a>";
			}
			else				
			{	
				if($row->fschpegabs_off_status == 0)
				{
					return "<a href=\"#\" title=\"".substr($row->fschpegabs_sch_time_in, 11, 5)."\">".substr($row->fschpegabs_sch_time_in, 11, 2)."</a>";
				}
				else if($row->fschpegabs_off_status == 1)
				{
					return "<a href=\"#\" title=\"LIBUR\">L</a>";
				}
			}
		}
	}
	
	function ambil_jam_absensi($fschpeg_id, $tgl, $year)
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('fschpegabs_fschpeg_id', $fschpeg_id);
		$ci->db->like('fschpegabs_sch_time_in', $tgl, 'after'); 
		$ci->db->limit(1);
		$data = $ci->db->get('v3_fschpeg_absensi_'.$year);
		
		foreach ($data->result() as $row)
		{
			$status = $row->fschpegabs_off_status;
			
			$ci->db->where('lnas_date', $tgl);
			$data2 = $ci->db->get('v3_libur_nasional');
			foreach ($data2->result() as $row2)
			{
				$status = 1; //libur
			}
				
			return array($row->fschpegabs_sch_time_in, $row->fschpegabs_sch_time_out, $row->fschpegabs_real_time_in, $row->fschpegabs_real_time_out, $status );
		}
	}
	
	
	//hitung selisih jam output dalam menit
	function selisihjam($in,$out) 
	{
	list($tgl,$jam_masuk) = explode(" ", $in);
	list($tgl2,$jam_keluar) = explode(" ", $out);
	
	list($h,$m,$s) = explode(":",$jam_masuk);
	$dtAwal = mktime($h,$m,$s,1,1,1);
	
	list($h,$m,$s) = explode(":",$jam_keluar);
	if ($tgl2 != $tgl)
	{ $h = (int)$h+24;}
	$dtAkhir = mktime($h,$m,$s,1,1,1);
	
	$dtSelisih = $dtAkhir-$dtAwal;
	
	$totalmenit=$dtSelisih/60;
	$jam =explode(".",$totalmenit/60);
	$sisamenit=($totalmenit/60)-$jam[0];
	$sisamenit2=$sisamenit*60;
	$jml_jam=$jam[0];
	$jml_jam = $jml_jam *60;
	$totalmenit = $jml_jam+$sisamenit2;
	return $totalmenit;
	}
	
	function hit_telat_dan_lembur($in, $out, $realin, $realout, $statusoff) 
	{
		$telathk = 0;
		$lemburhk = 0;
		$lemburhl = 0;
		$exvo = 0;
		
		list($tglin,$cekin) = explode(" ", $in);
		list($tglout,$cekout) = explode(" ", $out);
		
		if (($realin != "0000-00-00 00:00:00") && ($realout != "0000-00-00 00:00:00"))
		{
			if($statusoff != 0)
			{
				if($realin < $realout) 
				{ $lemburhl = selisihjam($realin,$realout); }
					else 
				{ $lemburhl = selisihjam($realout,$realin); }
			}
			else
			{
			
				if($cekin < $cekout)
				{
					$jml_jam_jadwal = selisihjam($in,$out);
					$jml_jam_real = selisihjam($realin,$realout);
					
					// cek exvo jika jam masuk kurang atau sama dengan jam 5 pagi maka exvo ditambah 1
					list($tglin, $jamrealin) = explode(" ", $realin);
					if($realin <= "".$tglin." 05:00:00") { $exvo = 1; } 					
					
				}
				else if($cekin > $cekout)
				{
					$jml_jam_jadwal = selisihjam($in, "0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00", $out);							
					$jml_jam_real = selisihjam($realin, "0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00", $realout);
					
					// cek exvo jika jam pulang lebih atau sama dengan jam 1 pagi maka exvo ditambah 1
					list($tglout, $jamrealout) = explode(" ", $realout);
					if($realout >= "".$tglout." 01:00:00") { $exvo = 1; } 	
				}
				
				//---------------------------------------------------------
			
				# jika > artinya bahwa jika total jam jadwal sama dengan total jam realita, maka telat tetap dihitung dan lembur tidak dihitung
				# jika >= artinya bahwa jika total jam jadwal sama dengan total jam realita, maka telat tidak dihitung dan lembur tidak dihitung
				if($jml_jam_real > $jml_jam_jadwal) 
				{ 
					$lemburhk = $jml_jam_real - $jml_jam_jadwal;
					$telathk = 0;
				} 
				else 
				{
					$lemburhk = 0;
					$telathk =  selisihjam($in, $realin);
				}
			
			} //endelse
			
		} //endif
	
		return array($telathk,$lemburhk,$lemburhl,$exvo);
	}

}

?>