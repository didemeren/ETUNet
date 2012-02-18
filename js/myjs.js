
function registerAdmin(){
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var xmlhttp;
	if (username=="" || password=="") { 
		document.getElementById("errorMessage").innerHTML="<div class='alert-message error'><p>Lütfen geçerli bir kullanıcı adı ve şifre giriniz</p></div>";
		return;
	}else{
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				var response=xmlhttp.responseText;
				if(response=="ok") {
					window.location="index.php"; 
				}else {
					document.getElementById("errorMessage").innerHTML=xmlhttp.responseText;	
				}
			}
			
		}
		xmlhttp.open("GET","doLogin.php?username="+username+"&password="+password,true);
		xmlhttp.send();
	}			  
}

function registerStudent(){
	var studentID = document.getElementById("studentID").value;
	//alert(studentID);
	var xmlhttp;
	if (studentID=="")
	  {
	  document.getElementById("errorMessage").innerHTML="<div class='alert-message error'><p>Lütfen geçerli bir öğrenci numarası giriniz</p></div>";
	  return;
	  }else{
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("errorMessage").innerHTML=xmlhttp.responseText;
			}
		  }
		xmlhttp.open("GET","addConfirm.php?id="+studentID,true);
		xmlhttp.send();
	  }	  
}

function checkPassword(){
	var password=document.getElementById("passInput").value;
	var help=document.getElementById("pass-help");
	var fix=document.getElementById("passfix");
	if(password.length<8) {
		fix.className='clearfix error';
		help.innerHTML="Şifre en az 8 karakterden oluşmalıdır"
	}else {
		fix.className='clearfix success';
		help.innerHTML="&laquo;"
	}
}

function checkPassword2(){
	var password=document.getElementById("passInput").value;
	var password2=document.getElementById("pass-againInput").value;
	var help=document.getElementById("pass-again-help");
	var fix=document.getElementById("pass-againfix");
	if(password.length<8 || password!=password2) {
		fix.className='clearfix error';
		help.innerHTML="Şifreler uyumsuz"
	}else {
		fix.className='clearfix success';
		help.innerHTML="&laquo;"
	}
}

function checkMail(){
	var mail=document.getElementById("mail").value;
	var help=document.getElementById("mail-help");
	var fix=document.getElementById("mailfix");
	patt=/^(\w|\x2E){6,30}@\w+\x2E\w+$/
	if(patt.test(mail)) {
		fix.className='clearfix success';
		help.innerHTML="&laquo;"
	}else {
		fix.className='clearfix error';
		help.innerHTML="E-posta geçerli değil"
	}
}