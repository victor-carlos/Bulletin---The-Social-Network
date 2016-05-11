		<section class="wrap">
			<div class="container about">
				<?php
					if(isset($_GET['bulletin'])){
						echo $ctrlPublicacao->listPost(htmlentities($_GET['bulletin']));
					}else{
						echo $ctrlPublicacao->listPostsAnUser(htmlentities($_GET['addr']));
					}
				?>
			</div>
		</section>