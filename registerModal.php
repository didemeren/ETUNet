<div id="registerModal" class="modal hide fade">
  <div class="modal-header">
	<a class="close" data-dismiss="modal">×</a>
	<h3>Kayıt Ol</h3>
  </div>
  <div class="modal-body">			
	<div id="errorMessage">
	<div class='place-for-alert'><p> Kayıt işlemine başlamak için öğrenci numaranızı başında st olmadan giriniz</p></div>
	</div>		
		<input class="span3" type="text" placeholder="Öğrenci Numarası" id="studentID">
		<button class="btn" onClick="registerStudent()">Devam Et</button>  
  </div>
  <div class="modal-footer">
	<a data-dismiss="modal"  href="#" class="btn">Kapat</a>
  </div>
</div>
