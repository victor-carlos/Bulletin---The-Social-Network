		<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Dados Pessoais</legend>
							<label for="nome"><p>Nome: </p></label>
							<input type="text" name="nome" value="<?php echo (isset($_SESSION['nome']))?$_SESSION['nome']:''; ?>" required="required" /><br />
							
							<label for="sobrenome"><p>Sobrenome: </p></label>
							<input type="text" name="sobrenome" value="<?php echo (isset($_SESSION['sobrenome']))?$_SESSION['sobrenome']:''; ?>" required="required" /><br />
							
							<label for="nickname"><p>Apelido: </p></label>
							<input type="text" name="nickname" value="<?php echo (isset($_SESSION['nickname']))?$_SESSION['nickname']:''; ?>" /><br />
							
							<label for="pais"><p>País: </p></label>
							<input type="text" name="pais" value="<?php echo (isset($_SESSION['pais']))?$_SESSION['pais']:''; ?>" required="required" /><br />
							
							<label for="estado"><p>Estado ou Província: </p></label>
							<input type="text" name="estado" required="required" /><br />
							
							<label for="data-nasc"><p>Data de Nascimento: </p></label>
							<input type="date" name="data-nasc" value="<?php echo (isset($_SESSION['data_nasc']))?$_SESSION['data_nasc']:''; ?>" /><br />
							
							<label><p>Sexo: </p></label>
							<input type="radio" name="sexo" value="Masculino" checked="" /><label>Masculino</label><br />
							<input type="radio" name="sexo" value="Feminino" /><label>Feminino</label>
							<br /><br />
							
							<label><p>Interesses: </p></label>
							<input type="checkbox" name="network" ><label>Network</label><br />
							<input type="checkbox" name="amizade" ><label>Amizade</label><br />
							<input type="checkbox" name="relacionamento" ><label>Um relacionamento</label><br />
							<input type="checkbox" name="namoro" ><label>Namoro</label><br />
							<br /><br />
							
							<label><p>Linguagem: </p></label>
							<select name="linguagem">
								<option value="pt-br" selected="selected">Português</option>
								<option value="en-us">English</option>
							</select><br />
						</fieldset>
						<fieldset>
							<legend>Fale sobre você</legend>
							<textarea name="sobre" placeholder="Esta será a sua apresentação." required="required"></textarea>
						</fieldset>
						<fieldset>
							<legend>Autenticação</legend>
							
							<label for="email"><p>Email: </p></label>
							<input type="email" name="email" value="<?php echo (isset($_SESSION['email']))?$_SESSION['email']:''; ?>" required="required" /><br />
							
							<label for="password1"><p>Senha: </p></label>
							<input type="password" name="password1" value="<?php echo (isset($_SESSION['password']))?$_SESSION['password']:''; ?>" required="required" /><br />
							
							<label for="password2"><p>Repetir senha: </p></label>
							<input type="password" name="password2" value="<?php echo (isset($_SESSION['password']))?$_SESSION['password']:''; ?>" required="required" /><br />
							
						</fieldset>
						<fieldset>
							<legend>Fotos</legend>
							
							<label for="foto_perfil"><p>Foto do perfil:</p></label>
							<input type="file" name="foto_perfil" required="required" /><br />
							
							<label for="foto_capa"><p>Capa do perfil:</p></label>
							<input type="file" name="foto_capa" required="required" /><br />
							
						</fieldset>
						<fieldset>
							<legend>Não sou um Robô</legend>
							
							<img src="_img/captcha.php?l=150&a=40&tf=20&ql=5" /><br />
							<input type="text" name="captcha" required="required" />
							
						</fieldset>
						
						<input type="submit" name="criar_perfil" value="Criar Perfil" />
						<br /><br />
						<div style="color: red;"><?php echo (isset($_SESSION["erros"]))?$_SESSION["erros"]:""; ?></div>
					</form>
					<div style="clear: both;"></div>
				</article>
				
			</div>
		</section>