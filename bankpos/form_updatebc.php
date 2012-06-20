<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
        "http://www.w3.org/TR/html4/frameset.dtd">
		
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
 <br />
 <br />
	<h2><center>Update Data Sispen Bea Cukai</center></h2>
	<br />
	<form method="post" action="update_bc.php">
	<table border="1" width="25%" align="center">
		<tr>
			<td>Tgl.Buku</td><td><input type="text" name="tgl" maxlength="2" size="1" onkeypress="return handleEnter(this, event)"/></td><td><input type="text" name="bln" maxlength="2" size="1" onkeypress="return handleEnter(this, event)" /></td><td><input type="text" name="thn" maxlength="4" size="3" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
		<tr>
			<td>Kode KPBC</td><td colspan="3"><input type="text" name="kpbc" maxlength="6" size="4" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
		<tr>
			<td>Akun</td><td colspan="3"><input type="text" name="akun" maxlength="6" size="4" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
		<tr>
			<td>Kelompok Akun</td><td colspan="3"><input type="text" name="kelmap" maxlength="1" size="1" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
	</table>
	<br />
	<hr width="40%" size="3"/>
	<table border="1" width="35%" align="center">
		<tr>
			<td colspan="4"><b>Update Field:</b></td>
		</tr>
		<tr>
			<td>Dept-Unit</td><td><input type="text" name="dept" maxlength="3" size="1" onkeypress="return handleEnter(this, event)" /></td><td colspan="2"><input type="text" name="unit" maxlength="2" size="1" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
		<tr>
			<td>Satker-Jenis Kewenangan</td><td colspan="2"><input type="text" name="satker" maxlength="6" size="5" onkeypress="return handleEnter(this, event)" /></td><td><input type="text" name="dekon" maxlength="2" size="1" onkeypress="return handleEnter(this, event)" /></td>
		</tr>
	</table>
	<br />
	<hr width="40%" size="3"/>
	<center><input type="submit" name="submit" value="Ubah Data" /></center>
	</form>
</body>