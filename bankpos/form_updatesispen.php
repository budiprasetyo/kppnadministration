<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<head>
<script language="JavaScript">
/***********************************************
* Disable "Enter" key in Form script- By Nurul Fadilah(nurul@REMOVETHISvolmedia.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function handleEnter (field, event) {
var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
if (keyCode == 13) {
var i;
for (i = 0; i < field.form.elements.length; i++)
if (field == field.form.elements[i])
break;
i = (i + 1) % field.form.elements.length;
field.form.elements[i].focus();
return false;
} 
else
return true;
} 
</script>
</head>
<body>
<br /><h2><center>Update Sispen</center></h2><br />
<hr size="1" width="50%" />
<br />
<form action="update_sispen.php" method="post">
<center>Tanggal <input type="text" name="tgl" size="2" maxlength="2" onkeypress="return handleEnter(this, event)" /> - <input type="text" name="bln" size="2" maxlength="2" onkeypress="return handleEnter(this, event)" /> - <input type="text" name="thn" size="4" maxlength="4" onkeypress="return handleEnter(this, event)" /> s.d. <input type="text" name="Tgl" size="2" maxlength="2" onkeypress="return handleEnter(this, event)" /> - <input type="text" name="Bln" size="2" maxlength="2" onkeypress="return handleEnter(this, event)" /> - <input type="text" name="Thn" size="4" maxlength="4" onkeypress="return handleEnter(this, event)" /></center>
<br />
<hr size="1" width="50%" />
<center>Kelompok Akun <select name="akun" size="0">
	<option value="4" label="4 (pendapatan)" selected>4</option>
	<option value="5" label="5 (pengembalian belanja)">5</option>
	<option value="6" label="6 (pengembalian belanja)">6</option>
	<option value="7" label="7 (pendapatan)">7</option>
	<option value="8" label="8 (pendapatan)">8</option>
</select></center>
<hr size="1" width="50%" />
<br />
<center><input type="submit" name="submit" value="Tampilkan" size="4" /></center>
</form>
</body>