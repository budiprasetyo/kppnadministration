<html>
<head>
<title>Halaman Administrator</title>
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body OnLoad="document.login.username.focus();">
<div id="header">
  <div id="content">
		<h2>Login</h2>
    <img src="images/13lock.png" width="97" height="105" hspace="10" align="left">

<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
<table>
<tr><td>Username</td><td> : <input type="text" name="username"></td></tr>
<tr><td>Password</td><td> : <input type="password" name="password"></td></tr>
<tr><td colspan="2"><input type="submit" value="Login"></td></tr>
</table>
</form>


<p>&nbsp;</p>
  </div>
	<div id="footer">
			Copyleft 
			<span style="transform:rotate(180deg);
					-webkit-transform:rotate(180deg);
					-moz-transform:rotate(180deg);
					-o-transform:rotate(180deg);
					filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2); 
					display: inline-block;">&copy;
			</span> 2012 Direktorat Sistem Perbendaharaan. All wrongs reserved.
	</div>
</div>
</body>
</html>
