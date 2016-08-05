<section class="wrap">
			<div class="container about">
				
				<article class="content blue">
					<h1>Mensagens</h1>
					<span class="btn1" onclick="abrirAba(0);"></span>
					<div class="hide">
					
					<?php 
						$conversas = $ctrlConversa->listarConversas();
						for($i = 0; $i < count($conversas); $i++) {
							if($conversas[$i][2] != $_SESSION['endereco'] && !$conversas[$i][4]) {
								echo '<a href="index.php?ref=Conversa&addr='.$conversas[$i][2].'"><div class="album-photo">
									<figure>
										<img src="'.$ctrlUsuario->fotoPerfil($conversas[$i][2]).'" alt="">
										<figcaption>
											'.$ctrlUsuario->nomeSobrenomeNickname($conversas[$i][2]).' '.(($conversas[$i][4])?'':(($lang == "pt-BR")?"<br /><br />(Novas Mensagens)":"(New Messages)")).'
										</figcaption>
									</figure>
								</div></a>';
							}
						}
					?>
					</div>
					<div style="clear: both;"></div>
				</article>
			</div>
		</section>