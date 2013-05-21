<?php
/*
 * untitled.php
 * 
 * Copyright 2012 budi prasetyo a.k.a. metamorph <metamorph@Cyber-Station>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
if($_GET['module'] == 'f_status_spm')
{
	echo "<style type='text/css'>
			em { font-weight: bold; padding-right: 1em; vertical-align: top; }
		</style>
			<script>
			$(document).ready(function(){
				$('#form').validate();
				$('#tanggal').datepicker();
			});
	
		
		</script>
		<div id='stylized' class='myform'>
			<form id='form' name='form' method='post'  enctype='multipart/form-data'  action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Form monitoring proses SPM</h1>
					<p>Form untuk melakukan monitoring proses SPM menjadi SP2D</p>
					<label>Kode Satker
					<span class='small'>Isikan kode satker</span>
					</label>
					<input type='text' id='kdsatker' class='required' minlength='6' name='kdsatker' maxlength='6'  onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'nospm')\" />
	
					<label>Nomor SPM
					<span class='small'>Isikan nomor SPM</span>
					</label>
					<input type='text' id='nospm' class='required' minlength='1' name='nospm' maxlength='10' onkeypress='return handleEnter(this, event)' onkeyup=\"moveOnMax(this,'submit')\" />
					
					<input type='submit' value='Cari' class='button' id='submit' name='Caristatusspm' />
					<div class='spacer'></div>
				</form>
		</div>";
}
/* Tampilkan hasil pencarian status SPM di tabel -----------------------------------------------------------------------------*/
elseif($_POST['Caristatusspm'])
{
	include_once("config/koneksisp2d13.php");
	$kdsatker 	= $_POST['kdsatker'];
	$nospm		= sprintf("%05s",$_POST['nospm']);
	echo "<div id='stylized' class='myform'>
			<form id='form' name='form' method='post' action='"; echo(htmlentities($_SERVER['PHP_SELF'])); echo "'>
			<h1>Tabel Status Proses SPM</h1>
					<p>Hasil pencarian atas proses SPM menjadi SP2D </p>
			</form>
		</div>
					<br />
					<br />
					<div id='normaltable'>
			
					<table class='normaltable' width='100%'>
					<tr>
					<th width='8%' height='35'>No.</th>
					<th width='20%'>Kode Satker</th>
					<th width='10%'>No. SPM</th>
					<th width='15%'>Jumlah Kotor</th>
					<th width='15%'>Jumlah Bersih</th>
					<th width='10%'>No. SP2D</th>
					<th width='25%' colspan='3'>Status</th>
					</tr>";
			
			$qDataSpm		= mysql_query("SELECT kddept,kdunit,kddekon,kdsatker,nospm,nosp2d,totnilmak,totnilmap,kdstaspm FROM d_spmind WHERE kdsatker='".$kdsatker."' AND nospm ='".$nospm."' UNION SELECT kddept,kdunit,kddekon,kdsatker,nospm,nosp2d,totnilmak,totnilmap,kdstaspm FROM m_spmind WHERE kdsatker='".$kdsatker."' AND nospm ='".$nospm."' ")or die(mysql_error);
			$no	=1;
			$oddcol			= "#CCFF99";
			$evencol		= "#CCDD88";
			while($rDataSpm	= mysql_fetch_object($qDataSpm)){
				if($no % 2 == 0) {$color = $evencol;}
				else{$color = $oddcol;}
				if($rDataSpm->nosp2d == ""){ $nosp2d = "No.SP2D belum ada";}
				else{$nosp2d = $rDataSpm->nosp2d;}
				
				echo "<tr bgcolor='$color'>
						<td height='55'>".$no."</td>
						<td>".$rDataSpm->kddept."-".$rDataSpm->kdunit."-".$rDataSpm->kddekon."-".$rDataSpm->kdsatker."</td>
						<td>".$rDataSpm->nospm."</td>
						<td>".number_format($rDataSpm->totnilmak,0,',','.')."</td>
						<td>".number_format($rDataSpm->totnilmap,0,',','.')."</td>
						<td>".$nosp2d."</td>
						<td class='blackgreen'>";
							switch($rDataSpm->kdstaspm)
							{
											case 1:
												echo $status = 'Cetak tanda terima di Front Office';
												break;
											case 2:
												echo $status = 'Sedang proses menjadi SP2D';
												break;
											case 3:
												echo $status = 'Sedang cetak net SP2D';
												break;
											case 4:
												echo $status = 'SP2D dilakukan pencatatan Daftar Penguji';
												break;
											case 5:
												echo $status = 'SP2D dilakukan pencetakan Daftar Penguji';
												break;
											case 6:
												echo $status = 'SPM dikembalikan';
												break;
											case 9:
												echo $status = 'SP2D telah dikirim ke Bank Operasional';
												break;
							}
						echo "</td>
					</tr>";
				$no++;
			}
			echo "</table>
				</div>
			</form>";
}
?>
