		<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Personal data</legend>
							<label for="nome"><p>Name: </p></label>
							<input type="text" name="nome" value="<?php echo (isset($_SESSION['nome']))?$_SESSION['nome']:''; ?>" required="required" /><br />
							
							<label for="sobrenome"><p>Surname: </p></label>
							<input type="text" name="sobrenome" value="<?php echo (isset($_SESSION['sobrenome']))?$_SESSION['sobrenome']:''; ?>" required="required" /><br />
							
							<label for="nickname"><p>Nickname: </p></label>
							<input type="text" name="nickname" value="<?php echo (isset($_SESSION['nickname']))?$_SESSION['nickname']:''; ?>" /><br />
							
							<label for="pais"><p>Country: </p></label>
							<input type="text" name="pais" value="<?php echo (isset($_SESSION['pais']))?$_SESSION['pais']:''; ?>" required="required" /><br />
							
							<label for="estado"><p>State or Province: </p></label>
							<input type="text" name="estado" required="required" /><br />
							
							<label for="data-nasc"><p>Date of Birth: </p></label>
							<input type="date" name="data-nasc" value="<?php echo (isset($_SESSION['data_nasc']))?$_SESSION['data_nasc']:''; ?>" /><br />
							
							<label><p>Gender: </p></label>
							<input type="radio" name="sexo" value="Male" checked="" /><label>Male</label><br />
							<input type="radio" name="sexo" value="Female" /><label>Female</label>
							<br /><br />
							
							<label><p>Interests: </p></label>
							<input type="checkbox" name="network" ><label>Network</label><br />
							<input type="checkbox" name="amizade" ><label>Friendship</label><br />
							<input type="checkbox" name="relacionamento" ><label>A relationship</label><br />
							<input type="checkbox" name="namoro" ><label>Dating</label><br />
							<br /><br />
							
							<label><p>Language: </p></label>
							<select name="linguagem">
								<option value="pt-br">Português</option>
								<option value="en-us" selected="selected">English</option>
							</select><br />
						</fieldset>
						<fieldset>
							<legend>Talk about you</legend>
							<textarea name="sobre" placeholder="This will be your presentation." required="required"></textarea>
						</fieldset>
						<fieldset>
							<legend>Authentication</legend>
							
							<label for="email"><p>Email: </p></label>
							<input type="email" name="email" value="<?php echo (isset($_SESSION['email']))?$_SESSION['email']:''; ?>" required="required" /><br />
							
							<label for="password1"><p>Password: </p></label>
							<input type="password" name="password1" value="<?php echo (isset($_SESSION['password']))?$_SESSION['password']:''; ?>" required="required" /><br />
							
							<label for="password2"><p>Repeat Password: </p></label>
							<input type="password" name="password2" value="<?php echo (isset($_SESSION['password']))?$_SESSION['password']:''; ?>" required="required" /><br />
							
						</fieldset>
						<fieldset>
							<legend>Photos</legend>
							
							<label for="foto_perfil"><p>Profile Picture:</p></label>
							<input type="file" name="foto_perfil" required="required" /><br />
							
							<label for="foto_capa"><p>Profile Background:</p></label>
							<input type="file" name="foto_capa" required="required" /><br />
							
						</fieldset>
						<fieldset>
							<legend>I'm not a robot</legend>
							
							<img src="_img/captcha.php?l=150&a=40&tf=20&ql=5" /><br />
							<input type="text" name="captcha" required="required" />
							
						</fieldset>
						
						<input type="submit" name="create_profile" value="Create Profile" />
						<br /><br />
						<div style="color: red;"><?php echo (isset($_SESSION["erros"]))?$_SESSION["erros"]:""; ?></div>
					</form>
					<div style="clear: both;"></div>
				</article>
				
			</div>
		</section>