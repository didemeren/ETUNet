<?php include 'scripts.php';?>
	<form method="post" action="doLogin.php?reg=reg">
        <fieldset>
        <div id="errorMessage">
			<div class='place-for-alert'><p><center>Kayıt Formu</center></p></div>
		</div>	
		  <div class="clearfix">
            <label for="studentID">Öğrenci Numarası</label>
            <div class="input">
              <input class="xlarge disabled" id="studentIDInput" name="studentIDInput" size="10" type="text" disabled value="0<?php echo $userId?>"/>
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix">
            <label for="isim">İsim</label>
            <div class="input">
              <input class="xlarge" id="nameInput" name="nameInput" size="30" type="text" value="<?php echo $name?>" disabled/>
            </div>
          </div><!-- /clearfix -->
		  
		  <div class="clearfix">
            <label for="isim">Soyisim</label>
            <div class="input">
              <input class="xlarge" id="surnameInput" name="surnameInput" size="30" type="text" value="<?php echo $surname?>" disabled/>
            </div>
          </div><!-- /clearfix -->
		  
		  <div class="clearfix" id="passfix">
            <label for="errorInput">Şifre</label>
            <div class="input">
              <input class="xlarge error" id="passInput" name="passInput" size="30" type="password" onblur="checkPassword()"/>
              <span class="help-inline" id="pass-help"></span>
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix" id="pass-againfix">
            <label for="successInput">Şifre Tekrar</label>
            <div class="input">
              <input class="xlarge error" id="pass-againInput" name="pass-againInput" size="30" type="password" onblur="checkPassword2()"/>
              <span class="help-inline" id="pass-again-help"></span>
            </div>
          </div>
          
		  <div class="clearfix" id="mailfix">
            <label for="email">E-Posta</label>
            <div class="input">
              <div class="input-prepend">
                <span class="add-on">@</span>
                <input class="medium" id="mailInput" name="mailInput" size="30" type="text"  onblur="checkMail()"/>
                 <span class="help-inline" id="mail-help"></span>
              </div>
              <span class="help-block">Okul maili olmak zorunda değil</span>
            </div>
          </div><!-- /clearfix -->		  
		  
          <div class="clearfix">
            <label for="class">Sınıf</label>
            <div class="input">
              <select name="class" id="classInput">
                <?php 
                $st->prepare("select * from class order by class_value");
				$st->execute();
				$st->bind_result($value,$name);
				while($st->fetch()){
					echo ("<option value=$value>$name</option>");
				}
                ?>
              </select>
            </div>
          </div><!-- /clearfix -->
		  
		  <div class="clearfix">
            <label for="topic">Bölüm</label>
            <div class="input">
              <select name="topic" id="departmentInput">
                <?php 
                $st->prepare("select * from department order by dep_name");
				$st->execute();
				$st->bind_result($value,$name,$code);
				while($st->fetch()){
					if($code==substr($userId,1,2))
						echo ("<option value=$value selected>$name</option>");
					else
					echo ("<option value=$value >$name</option>");
				}
                ?>
              </select>
            </div>
          </div><!-- /clearfix -->
		  
		  
		  <div class="actions">
            <input type="submit" class="btn primary" value="Gönder">&nbsp;<button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
   </form>