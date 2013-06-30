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
					return "<a href=\"#\" title=\"".substr($row->fschpegabs_sch_time_in, 11, 5)."\">".substr($row->fschpegabs_sch_time_in, 11, 5).'-'.substr($row->fschpegabs_sch_time_out, 11, 5)."</a>";
				}
				else if($row->fschpegabs_off_status == 1)
				{
					return "<a href=\"#\" title=\"LIBUR\">L</a>";
				}
			}
		}
	}
	
	
	function ambil_breakin_absensi($fschpeg_id, $tgl, $year)
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
				if ($row->fschpegabs_sch_break_in == "0000-00-00 00:00:00"){
						return "";
				}
				else{
					if($row->fschpegabs_off_status == 0)
					{
						return "<a href=\"#\" title=\"".substr($row->fschpegabs_sch_break_in, 11, 5)."\">".substr($row->fschpegabs_sch_break_out, 11,5)."-".substr($row->fschpegabs_sch_break_in, 11, 5)."</a>";
						
					}
					else if($row->fschpegabs_off_status == 1)
					{
						return "<a href=\"#\" title=\"LIBUR\">L</a>";
					}
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
		if ($data->num_rows() > 0){
			foreach ($data->result() as $row)
			{
				$status = $row->fschpegabs_off_status;
				
				$ci->db->where('lnas_date', $tgl);
				$data2 = $ci->db->get('v3_libur_nasional');
				foreach ($data2->result() as $row2)
				{
					$status = 1; //libur
				}
					
				return array($row->fschpegabs_sch_time_in, $row->fschpegabs_sch_break_out, $row->fschpegabs_sch_break_in, $row->fschpegabs_sch_time_out, $row->fschpegabs_real_time_in, $row->fschpegabs_real_break_out, $row->fschpegabs_real_break_in, $row->fschpegabs_real_time_out, $status );
			}
		} else {
			return 0;
		}
	}
	
	function get_data_anak($nipp)
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('peg_ank_nipp', $nipp);
		$data = $ci->db->get('v3_peg_anak');
		return $data->result_array();
	}
	
	function count_jumlah_anak($nipp)
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('peg_ank_nipp', $nipp);
		return $ci->db->count_all_results('v3_peg_anak');
	}
	
	
	//hitung selisih jam output dalam menit
	function selisihjam($in,$out) 
	{
		$selisihtime = strtotime($out) - strtotime($in); 
		$totalmenit =  $selisihtime / 60;
		return $totalmenit;
	/*list($tgl,$jam_masuk) = explode(" ", $in);
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
	*/
	
	}
	
	function hit_telat_dan_lembur($in, $b_out, $b_in, $out, $realin, $realb_out, $realb_in, $realout, $statusoff) 
	{
		$telathk = 0;
		$lemburhk = 0;
		$lemburhl = 0;
		$exvo = 0;
		/* asli
		list($tglin,$cekin) = explode(" ", $in);
		list($tglout,$cekout) = explode(" ", $out);
		*/
		list($tglin,$cekin) = explode(" ", $in);
		list($tglout,$cekout) = explode(" ", $out);
		list($tglbreakin,$cekbreakin) = explode(" ", $b_in);
		list($tglbreakout,$cekbreakout) = explode(" ", $b_out);
		
		if (($realin != "0000-00-00 00:00:00") && ($realout != "0000-00-00 00:00:00"))
		{
			if($statusoff != 0)
			{
				if($realin < $realout) 
				{ 	$lemburhl = selisihjam($realin,$realout); 
					#break
					if($realb_out < $realb_in) 
					{	$breakhl = selisihjam($realb_out,$realb_in); }
					else
					{ 	$breakhl = selisihjam($realb_in,$realb_out); }
				} else 
				{ 	$lemburhl = selisihjam($realout,$realin); 
					#break
					if($realb_out < $realb_in) 
					{	$breakhl = selisihjam($realb_out,$realb_in); }
					else
					{ 	$breakhl = selisihjam($realb_in,$realb_out); }
				}
				$lemburhl = $lemburhl - $breakhl;  
			}
			else
			{
			
				if($cekin < $cekout)
				{
					if ($cekbreakout < $cekbreakin){
						$jml_break_jadwal = selisihjam($b_out,$b_in);
						$jml_break_real = selisihjam($realb_out,$realb_in);
					} else {
						$jml_break_jadwal = selisihjam($b_out,"0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00",$b_in) ;
						$jml_break_real = selisihjam($realb_out,"0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00",$realb_in);
					}
					
					$jml_jam_jadwal = selisihjam($in,$out) - $jml_break_jadwal;
					$jml_jam_real = selisihjam($realin,$realout) - $jml_break_real;
					
					// cek exvo jika jam masuk kurang atau sama dengan jam 5 pagi maka exvo ditambah 1
					list($tglin, $jamrealin) = explode(" ", $realin);
					if($realin <= "".$tglin." 05:00:00") { $exvo = 1; } 					
					
				}
				else if($cekin > $cekout)
				{
					if ($cekbreakout < $cekbreakin){
						$jml_break_jadwal = selisihjam($b_out,$b_in);
						$jml_break_real = selisihjam($realb_out,$realb_in);
					} else {
						$jml_break_jadwal = selisihjam($b_out,"0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00",$b_in) ;
						$jml_break_real = selisihjam($realb_out,"0000-00-00 24:00:00") + selisihjam("0000-00-00 00:00:00",$realb_in);
					}
					
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
					$lemburhk = ($jml_jam_real - $jml_jam_jadwal) - $jml_break_jadwal - ($jml_break_real - $jml_break_jadwal);
					$telathk = 0;
				} 
				else 
				{
					$lemburhk = 0;
					$telathk =  selisihjam($in, $realin) + selisihjam($b_in, $realb_in) ;
				}
			
			} //endelse
			
			# ini yg asli
			/* 
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
			*/
			
		} //endif
	
		return array($telathk,$lemburhk,$lemburhl,$exvo);
	}

	function romawi($angka){
		if ($angka == 1) {$romawi = 'I';} 
		else if ($angka == 2) {$romawi = 'II';} 
		else if ($angka == 3) {$romawi = 'III';} 
		else if ($angka == 4) {$romawi = 'IV';} 
		else if ($angka == 5) {$romawi = 'V';} 
		else if ($angka == 6) {$romawi = 'VI';} 
		else if ($angka == 7) {$romawi = 'VII';} 
		else if ($angka == 8) {$romawi = 'VIII';} 
		else if ($angka == 9) {$romawi = 'IX';} 
		else if ($angka == 10) {$romawi = 'X';} 
		else if ($angka == 11) {$romawi = 'XI';} 
		else if ($angka == 12) {$romawi = 'XII';}
		else {$romawi="";}
		return $romawi;
	}
	
	function tanggal_pensiun($tgl_lahir){
		$thn_pensiun = substr($tgl_lahir,6,4) + 56;
		$bln_pensiun = substr($tgl_lahir,3,2);
		$tgl_pensiun = substr($tgl_lahir,0,2);
		if ($tgl_pensiun !== '01'){
			$bln_pensiun=$bln_pensiun+1;
			if($bln_pensiun <=9){
				$bln_pensiun = '0'.$bln_pensiun;
			}else if ($bln_pensiun == 13){ 
				$bln_pensiun='01'; 
				$thn_pensiun = $thn_pensiun + 1;
			} 
						
			$tgl_pensiun='01';
		} 
		$tanggal_pensiun =  $tgl_pensiun."-".$bln_pensiun."-".$thn_pensiun;
		return $tanggal_pensiun;
	}
	
}

?>