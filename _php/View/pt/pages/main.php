		<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Login</legend>
							<label for="email"><p>Email: </p></label>
							<input type="text" name="email" id="email" required="required"/><br />
							
							<label for="passwd"><p>Senha: </p></label>
							<input type="password" name="passwd" id="passwd" required="required"/><br />
							
							<input type="submit" name="login" value="Login" />
							<a href="" >Esqueci minha senha</a>
							<br /><br />
							<div style="color: red;"><?php echo (isset($_SESSION["erros"]))?$_SESSION["erros"]:""; ?></div>
						</fieldset>
					</form>
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Novo usuário</legend>
							
							<label for="language"><p>Linguagem: </p></label>
							<input type="radio" name="language" value="pt-BR" checked="" onclick="window.location.assign('index.php?lang=pt-BR');" />Português<br />
							<input type="radio" name="language" value="en-US" onclick="window.location.assign('index.php?lang=en-US');" />English<br /><br />
							
							<label for="nome"><p>Nome: </p></label>
							<input type="text" name="nome" id="nome" required="required"/><br />
							
							<label for="sobrenome"><p>Sobrenome: </p></label>
							<input type="text" name="sobrenome" id="sobrenome" required="required"/><br />
							
							<label for="data-nasc"><p>Data de Nascimento: </p></label>
							<input type="date" name="data-nasc" id="data-nasc" placeholder='31/12/<?php echo date("Y")?>' required="required"/><br />
							
							<input type="submit" name="cadastro" value="Fazer Cadastro" />
						</fieldset>
					</form>
					<div style="clear: both;"></div>
				</article>
				
		</section>