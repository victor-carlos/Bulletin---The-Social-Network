		<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Personal Data</legend>
							<label><p>Name: </p></label>
							<input type="text" name="nome" value="<?php echo (isset($_SESSION['nome']))?$_SESSION['nome']:''; ?>" required="required" /><br />
							
							<label><p>Surname: </p></label>
							<input type="text" name="sobrenome" value="<?php echo (isset($_SESSION['sobrenome']))?$_SESSION['sobrenome']:''; ?>" required="required" /><br />
							
							<label><p>Nickname: </p></label>
							<input type="text" name="nickname" value="<?php echo (isset($_SESSION['nickname']))?$_SESSION['nickname']:''; ?>" /><br />
							
							<label><p>Country: </p></label>
							<input type="text" name="pais" value="<?php echo (isset($_SESSION['pais']))?$_SESSION['pais']:''; ?>" required="required" /><br />
							
							<label><p>State or Province: </p></label>
							<input type="text" name="estado" value="<?php echo (isset($_SESSION['estado']))?$_SESSION['estado']:''; ?>" required="required" /><br />
							
							<label><p>Date of Birth: </p></label>
							<input type="date" name="data-nasc" value="<?php echo (isset($_SESSION['data_nasc']))?$_SESSION['data_nasc']:''; ?>" /><br />
							
							<label><p>Gender: </p></label>
							<input type="radio" name="sexo" value="Male" checked="" /><label>Male</label><br />
							<input type="radio" name="sexo" value="Female" /><label>Female</label>
							<br /><br />
							
							<label><p>Interesses: </p></label>
							<input type="checkbox" name="network" <?php echo ($ctrlUsuario->getInteresses('Network'))?'checked=""':''; ?> ><label>Network</label><br />
							<input type="checkbox" name="amizade" <?php echo ($ctrlUsuario->getInteresses('Amizade'))?'checked=""':''; ?> ><label>Friendship</label><br />
							<input type="checkbox" name="relacionamento" <?php echo ($ctrlUsuario->getInteresses('Um relacionamento'))?'checked=""':''; ?> ><label>A relationship</label><br />
							<input type="checkbox" name="namoro" <?php echo ($ctrlUsuario->getInteresses('Namoro'))?'checked=""':''; ?> ><label>Dating</label><br />
							<br /><br />
							
							<label for="linguagem"><p>Language: </p></label>
							<input type="radio" name="linguagem" value="pt-BR" <?php echo ($ctrlUsuario->getLinguagem() == "pt-BR")?'checked=""':''; ?> />Português<br />
							<input type="radio" name="linguagem" value="en-US" <?php echo ($ctrlUsuario->getLinguagem() == "en-US")?'checked=""':''; ?> />English<br /><br />
							
							<input type="submit" class="float-right" name="atualiza-dados-pessoais" value="Update Personal Data" /> 
						</fieldset>
					</form>
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Talk about you</legend>
							<textarea name="sobre" placeholder="This will be your presentation." required="required"><?php echo $ctrlUsuario->apresentacao($_SESSION['endereco'])?></textarea>
							<br /> 
							<input type="submit" class="float-right" name="atualizar-sobre" value="Update About" /> 
						</fieldset>
					</form>
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Authentication</legend>
							
							<label><p>Old Password: </p></label>
							<input type="password" name="old-password" required="required" /><br />
							
							<label><p>New Password: </p></label>
							<input type="password" name="password1" required="required" /><br />
							
							<label><p>Repeat Password: </p></label>
							<input type="password" name="password2" required="required" /><br />
							
							<input type="submit" class="float-right" name="atualizar-auth" value="Atualizar Autenticação" />
						</fieldset>
					</form>
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Profile Picture</legend>
							<input type="file" name="foto_perfil" /><br />
							
							<input type="submit" class="float-right" name="atualizar-foto-perfil" value="Update Profile Picture" />
						</fieldset>
					</form>
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Profile Background</legend>
							<input type="file" name="foto_capa" /><br />
							
							<input type="submit" class="float-right" name="atualizar-foto-capa" value="Update Profile Background" />
						</fieldset>
						
						<br /><br />
						<div style="color: red;"><?php echo (isset($_SESSION["erros"]))?$_SESSION["erros"]:""; $_SESSION["erros"] = "";?></div>
					</form>
					<div style="clear: both;"></div>
				</article>
				
			</div>
		</section>