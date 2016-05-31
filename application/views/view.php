			<div class="row">
				<div class="span4">
					<div class="hero-unit">
							<?php if(!$games){
                                                                echo '';
                                                                echo '<p>Odigrali sve utakmice</p>';
                                                                echo ' <script type="text/javascript"><!--
                                                google_ad_client = "ca-pub-3798621824543701";
                                                /* fenomenalno 300x250 */
                                                google_ad_slot = "2516456299";
                                                google_ad_width = 300;
                                                google_ad_height = 250;
                                                //-->
                                        </script>
                                        <script type="text/javascript"
                                                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                                        </script>';
                                                        }else{?>
                                                        <?php foreach($games as $game) { // print_r($game);?>
<!--<span class="font-1 index_table_font"><a style="font-size:14px;" href="/game/<?php echo $game->title;?>">
                                                                                <?php echo $game->h_yu_name; ?>
                                                                                        : 
                                                                                <?php echo $game->g_yu_name; ?>
                                                                        </a></span>-->
						<div class="row">
							<div class="span4">
								<table width="90%" align="center">
                                                                                        <thead>
												<tr>
													<th width="90" style="text-align:center;"><?php echo $game->h_yu_name;?></th>
													<th width=""><?php echo date("d-m-Y", strtotime($game->time_of_game));?></th>
													<th width="90" style="text-align:center;"><?php echo $game->g_yu_name;?></th>
												</tr>
                                                                                                <tr>
                                                                                                        <th width="30" style="text-align:center;"><img src="/uploads/club/<?php echo $game->h_yu_name; ?>-48<?php echo $game->h_ext;?>" width="40" height="30"/></th>
                                                                                                        <th width="50" style="text-align:center;"><?php echo ($game->score == '' ? date("H:i", strtotime($game->time_of_game)) : $game->score); ?></th>
                                                                                                        <th width="30" style="text-align:center;"><img src="/uploads/club/<?php echo $game->g_yu_name; ?>-48<?php echo $game->g_ext;?>" width="40" height="30"/></th>
                                                                                                </tr>
                                                                                        </thead>

								
										<tbody>
											<tr>
								<td style="text-align:center;">
									<?php if($this->session->userdata('u_id') != ""){ ?>
									<?php echo form_open('bet/add/');?>
									<input type="hidden" value="<?php echo $game->id; ?>" name="game" />
									<input type="hidden" value="1" name="score" />
									<button class="btn btn-info" type="submit">1(<?php echo $game->one;?>)</button>
									</form>
									<?php } else {?>
										<a href="<?=base_url()?>signup" class="btn btn-info">
											1(<?php echo $game->one;?>)
										</a>
									<?php } ?>
								</td>
								<td style="text-align:center;" width="65">
									<?php if($this->session->userdata('u_id') != ""){ ?>
                                                                        <?php echo form_open('bet/add/');?> 
                                                                        <input type="hidden" value="<?php echo $game->id; ?>" name="game" />
									<input type="hidden" value="x" name="score" />
                                                                        <button class="btn btn-inverse" type="submit">x(<?php echo $game->x;?>)</button>
                                                                        </form>
                                                                        <?php } else {?>
                                                                                <a href="<?=base_url()?>signup" class="btn btn-inverse">
                                                                                        x(<?php echo $game->x;?>)
                                                                                </a>
                                                                        <?php } ?>
								
								</td>
								<td style="text-align:center;">
									<?php if($this->session->userdata('u_id') != ""){ ?>
                                                                        <?php echo form_open('bet/add/');?> 
                                                                        <input type="hidden" value="<?php echo $game->id; ?>" name="game" />
									<input type="hidden" value="2" name="score" />
                                                                        <button class="btn btn-warning" type="submit">2(<?php echo $game->two;?>)</button>
                                                                        </form>
                                                                        <?php } else {?>
                                                                                <a href="<?=base_url()?>signup" class="btn btn-warning">
                                                                                        2(<?php echo $game->two;?>)
                                                                                </a>
                                                                        <?php } ?>
								</td>
							</tr>
								</tbody>
							</table>
							</div>
							</div>
							<hr />
							<?php } 
							}?>
								
							
						</div>
					</div>	
					<div class="span5">
						<div class="hero-unit">
						<?php $count = '1';?>
						<?php foreach($updates as $update) { ?>
						<div class="row">
							<div class="span5">
								<div class="row">
									<div class="span0">
										<p style="text-align:center;">
										<img  width='50' height='50' class=""  src="http://graph.facebook.com/<?php echo $update->fb_id;?>/picture/small" alt="" />
										</p>
										<p style="text-align:center;"><a href="" class="btn btn-info">Prati</a></p>
									</div>
									<div class="span4">
										<h6>
											<a href="/profile/<?php echo $update->u_id;?>"><?php echo $update->fname;?> <?php echo $update->lname;?></a>
											<a class="pull-right"  href="/game/<?php echo $update->title;?>">                                                                                <?php echo $update->h_yu_name; ?>
                                                                                        : 
                                                                                <?php echo $update->g_yu_name; ?>
										<?php echo date("d-m-Y", strtotime($update->time_of_game));?>
                                                                        .</a>
										</h6>
										<table width="100%" align="center">
											<thead>
												<tr>
													<th width="100"><?php echo $update->h_yu_name;?></th>
													<th width="30"><img src="/uploads/club/<?php echo $update->h_yu_name; ?>-24<?php echo $update->h_ext;?>" width="30" height="35"/></th>
													<th width="50"><?php echo ($update->game_score == '' ? date("H:i", strtotime($update->time_of_game)) : $update->game_score); ?></th>
													<th width="30"><img src="/uploads/club/<?php echo $update->g_yu_name; ?>-24<?php echo $update->g_ext;?>" width="30" height="35"/></th>
													<th width="100"><?php echo $update->g_yu_name;?></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td></td>
													<td width="60" style="text-align:center;">
														<span class="btn-small btn-info">
                                                                                        				<?php echo ($update->score == "1" ? '<i class="icon-ok icon-white"></i>' : '');?>
                                                                                        				1
                                                                                				</span>
													</td>
													<td width="60" style="text-align:center;" >
														<span class="btn-small btn-inverse">
                                                                                        				<?php echo ($update->score == "x" ? '<i class="icon-ok icon-white"></i>' : '');?>
                                                                                        				X
                                                                                				</span>
													</td>
													<td width="60" style="text-align:center;">
														<span class="btn-small btn-warning">
                                                                                        				<?php echo ($update->score == "2" ? '<i class="icon-ok icon-white"></i>' : '');?>
                                                                                        				2
                                                                                				</span>
													</td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<br />
										
									</div>
									<div style="clear:both;" class="row"></div>
									<div class="row">	
										<?php $query   = 'SELECT * FROM comments 
                                                                                                  LEFT JOIN users ON users.u_id = comments.user_id
                                                                                                  WHERE comments.bet_id = ? ORDER BY comments.time_added ASC';
                                                                                      $result = $this->db->query($query, $update->bet_id);
                                                                                      if($result->num_rows() > 0){
                                                                                      	foreach($result->result() as $c){
											 
											 echo '<div class="span1">';
											 echo ' <p style="text-align:right;">
                                                                                			<a href="/profile/'. $c->u_id  .'" alt="'. $c->fname .' '. $c->lname .'" title="'. $c->fname .' '. $c->lname .'">	
													<img  width="30" height="30" class=""  src="http://graph.facebook.com/'.$c->fb_id.'/picture/small" alt="" />
													</a>
                                                                                		</p>';
											 echo '</div>';
											 echo '<div class="span4">';
                                                                                      	 echo '<div class="alert alert-'.($c->right_wrong == "w" ? 'error' : 'success').'" '. ($c->right_wrong == "w" ? ' style="text-align:right;"' : 'style="text-align:left;"') . '>'.
												
												$c->comment
											.'<br><i style="font-size:9px;">'. $c->time_added  .'</i></div>';
                                                                                         echo '</div>';
											 
                                                                                        }
                                                                                      }
                                                                                 ?>
										<?php if($this->session->userdata('u_id') != ""){ ?>
                                                                                <div class="span1"> 
											<p style="text-align:right;">
												<img  width="30" height="30" class=""  src="http://graph.facebook.com/<?php echo $this->session->userdata('fb_id');?>/picture/small" alt="" />
											</p>
										</div>
                                                                                <div class="span4" style="text-align:center;">
                                                                                                <form method="POST" action="/comment/add" >
                                                                                                                <textarea style="width:280px;" rows="1" name="comment" placeholder="Za&#353;to, komentari&#353;i"></textarea>
                                                                                                                <br>
                                                                                                                <button type="submit" name="right" class="btn btn-success" value="1">Upravu je</button>
                                                                                                        &nbsp;&nbsp;        <input type="hidden" name="bet_id" value="<?php echo $update->bet_id?>">
                                                                                                                <button type="submit" name="wrong" class="btn btn-danger" value="1">Nervira me</button>

                                                                                                </form>
                                                                                </div>
										<?php } ?>
                                                                        </div>
									<?php if($count=='1'){
										$count ++;
									?>
									<div class="row">
										<div class="span1">&nbsp;</div>
										<div class="span4">
										<script type="text/javascript"><!--
google_ad_client = "ca-pub-3798621824543701";
/* text fenomenalno small 234x60 */
google_ad_slot = "9415660690";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
										</div>
									</div>	
									<?php } ?>
								</div>
							</div>
						</div>
						<hr />
						<?php } ?>
						</div>
					</div>
					<div class="span3">
						<div class="hero-unit">
							<?php $this->load->view('ranking.php'); ?>
						</div>

					</div>
				</div>
