		<!-- content -->
		<section id="content">		
			<div class="row">
				<div class="wrapper">
					<div class="span4">
					<div class="hero-unit">
						<?php foreach($users as $user){?>
						<h2 class="ident-bot-2"><?php echo $user->fname;?> <?php echo $user->lname;?></h2>
						<img src="http://graph.facebook.com/<?php echo $user->fb_id;?>/picture?type=large" alt="<?php echo $user->fname;?> <?php echo $user->lname;?>"/>
						<?php } ?>
					</div>
					</div>

						

					<div class="span5">
					<div class="hero-unit">
						<h2 class="ident-bot-2">OPKLADE</h2>
						<?php //print_r($user_games);?>
						<?php if(!$user_games) { ?>
						<div class="ident-bot-6">
                                                                <p class="font-1 ws">Nema odigrnih utakmica</p>
                                                                <div class="clear"></div>
                                                </div>
						<?php } else { ?>
						<?php foreach($user_games as $user_game) { ?>
						<div class="ident-bot-6">
								<p class="font-1 ws"><?php echo $user_game->fname;?> <?php echo $user_game->lname;?></p>
								<p class="font-1 ws"><a href="/game/<?php echo $user_game->title;?>"><?php echo $user_game->h_yu_name;?> : <?php echo $user_game->g_yu_name;?> igra "<?php echo $user_game->score;?>"</a></p>
								<div class="clear"></div>
						</div>
						<?php } 
						} ?>
					</div>
					</div>
						

					<div class="span3">
					<div class="hero-unit">
						<div class="block-3 ident-top-2">
							<h3 class="ident-bot-2">Rang lista</h3>
							<div class="ident-bot-6">
								<?php $this->load->view('ranking.php'); ?>
								<div class="clear"></div>
							</div>
							<a class="button" href="#">Pro&#269;itaj vi&#353;e</a>

						</div>
					</div>
					</div>

				</div>

			</div>

		</section><!-- end content -->
