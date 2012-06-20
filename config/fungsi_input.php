<!--<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title></title>
  <meta name="GENERATOR" content="Quanta Plus" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
-->

  		/***********************************************
		* Disable "Enter" key in Form script- By Nurul Fadilah(nurul@volmedia.com)
		* This notice must stay intact for use
		* Visit http://www.dynamicdrive.com/ for full source code
		***********************************************/
		//function Enter
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

//function move to another field in form after maxlength is filled
		function moveOnMax(field,nextFieldID){
			if(field.value.length >= field.maxLength){
				document.getElementById(nextFieldID).focus();
			}
		}

<!--
</head>
<body>


</body>
</html>
-->