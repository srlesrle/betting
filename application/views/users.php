		<!-- content -->
		<section id="content">	
			<div class="row">
				<div class="wrapper">
					<div class="span12">
						<ul>
							<?php foreach($users as $user){?>
							<li style="float:left; width:50; height:50; padding: 5px;">
								<div class="extra-wrap block-1">
									<a href="/profile/<?php echo $user->u_id;?>"><img width="50" height="50" src="http://graph.facebook.com/<?php echo $user->fb_id;?>/picture/large" title="<?php echo $user->fname;?> <?php echo $user->lname;?>" alt="<?php echo $user->fname;?> <?php echo $user->lname;?>"/></a>
								<!--	<p><a href="/profile/<?php echo $user->u_id;?>"><?php echo $user->fname;?> <?php echo $user->lname;?></a></p> -->
								</div>
							</li>
							
							<?php } ?>
						</ul>
					</div>
				</div>

			</div>
		</section><!-- end content -->
