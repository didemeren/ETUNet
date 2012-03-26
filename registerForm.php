<?php include 'scripts.php';?>
	<form id="registerForm" name="registerForm" method="post" action="doLogin.php?reg=reg">
        <fieldset>
        <div id="errorMessage">
			<div class='place-for-alert'><p><center>Kayıt Formu</center></p></div>
		</div>	
		  <div class="clearfix">
            <label for="studentID">Öğrenci Numarası</label>
            <div class="input">
              <input readonly="true" class="xlarge disabled" id="studentIDInput" name="studentIDInput" size="10" type="text" value="0<?php echo $userId?>"/>
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix">
            <label for="isim">İsim</label>
            <div class="input">
              <input readonly="true" class="xlarge" id="nameInput" name="nameInput" size="30" type="text" value="<?php echo $name?>" />
            </div>
          </div><!-- /clearfix -->
		  
		  <div class="clearfix">
            <label for="isim">Soyisim</label>
            <div class="input">
              <input readonly="true" class="xlarge" id="surnameInput" name="surnameInput" size="30" type="text" value="<?php echo $surname?>" />
            </div>
          </div><!-- /clearfix -->
          
          <div class="clearfix">
            <label id="optionsRadio">Kullanıcı Adı</label>
            <div class="input">
              <ul class="inputs-list">
                <li>
                  <label>
                    <input type="radio" checked name="optionsUName" value="<?php echo $name." ".$surname?>" selected/>
                    <span><?php echo $name." ".$surname?></span>
                  </label>
                </li>
                <?php 
                $index=strpos($name,' ');
                if($index>0) {
                	$name1=trim(substr($name,0,$index));
					$name2=trim(substr($name,$index));
                ?>
                <li>
                  <label>
                    <input type="radio" name="optionsUName" value="<?php echo $name1." ".$surname?>" />
                    <span><?php echo $name1." ".$surname?></span>
                  </label>
                </li>
                <li>
                  <label>
                    <input type="radio" name="optionsUName" value="<?php echo $name2." ".$surname?>" />
                    <span><?php echo $name2." ".$surname?></span>
                  </label>
                </li>
                <?php }?>
              </ul>
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
              <select id="classInput" name="classInput">
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
              <select id="departmentInput" name="departmentInput">
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