<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="templates/loginstyle.css">
    <script type="text/javascript" src="jquery.tools.min.js"></script>

    <script type="text/javascript"> 
      $(document).ready(function(){
      	// expose form ketika form di klik atau kursor mouse berada di salah satu komponen form
	      $("form.expose").bind("click keydown", function() {
        	  $(this).expose({

			     // setting mask/penutup untuk background dengan CSS
			     maskId: 'mask',

			     // ketika form ter-expose, ganti warna background form
			     onLoad: function() {
				      this.getExposed().css({backgroundColor: '#c7f800'});
			     },

			     // ketika form tidak ter-expose, kembalikan warna background ke warna semula
			     onClose: function() {
				      this.getExposed().css({backgroundColor: null});
			     },
			     api: true

		      }).load();
	      });
	    });
	  </script>	
  </head>
    <body OnLoad="document.login.username.focus();">
     <div id="wrapper">
      <div id="header">
      
       <form class="expose" method="post" action="cek_login.php">
	     <label for="username">Username</label>
	     <input id="username" name="username" autofocus="autofocus" /><br />

	     <label for="password">Password</label>
	     <input id="password" type="password" name="password" /><br />
	     <input type="submit" value="LOGIN" /><br />
      </form>
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
