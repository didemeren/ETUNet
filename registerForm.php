<?php include 'scripts.php';?>
	<form>
        <fieldset>
          <legend><?php echo $sitename; ?> Kayıt Formu</legend>
		  <div class="clearfix">
            <label for="studentID">Öğrenci Numarası</label>
            <div class="input">
              <input class="xlarge disabled" id="studentID" name="studentID" size="10" type="text" disabled />
            </div>
          </div><!-- /clearfix -->
          <div class="clearfix">
            <label for="isim">İsim</label>
            <div class="input">
              <input class="xlarge" id="xlInput" name="isim" size="30" type="text" />
            </div>
          </div><!-- /clearfix -->
		  
		  <div class="clearfix">
            <label for="isim">Soyisim</label>
            <div class="input">
              <input class="xlarge" id="xlInput" name="soyisim" size="30" type="text" />
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
                <input class="medium" id="mail" name="email" size="30" type="text"  onblur="checkMail()"/>
                 <span class="help-inline" id="mail-help"></span>
              </div>
              <span class="help-block">Okul maili olmak zorunda değil</span>
            </div>
          </div><!-- /clearfix -->		  
		  
          <div class="clearfix">
            <label for="class">Sınıf</label>
            <div class="input">
              <select name="class" id="class">
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
              <select name="topic" id="normalSelect">
                <?php 
                $st->prepare("select * from department order by dep_name");
				$st->execute();
				$st->bind_result($value,$name);
				while($st->fetch()){
					echo ("<option value=$value>$name</option>");
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