<?php
function rupiah($bilangan)
{
$pecahan=number_format($bilangan,0,',','.');
echo"$pecahan";
return $pecahan;
}

function bil($bilangan1)
{
$denominasi=number_format($bilangan1,0,',','.');
return $denominasi;
}

function tanggal($tgll)
{
$pecah=explode("-",$tgll);
$pecahan=mktime(0,0,0,$pecah[1],$pecah[2],$pecah[0]);
$tanggalan=date("d F Y",$pecahan);
echo"$tanggalan";
return $tanggalan;
}

function tgl($tgl2)
{
$expl=explode("-",$tgl2);
$pecahan=mktime(0,0,0,$expl[1],$expl[2],$expl[0]);
$tanggal=date("d-m-Y",$pecahan);
return $tanggal;
}
?>

