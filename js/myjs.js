
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