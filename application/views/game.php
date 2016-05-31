<section id="content">
	<div class="row">
		<div class="wrapper">
				<div class="span6">
					<div class="hero-unit">
						<span>
							<?php foreach($game as $l) { ?>
							<h2 class="ident-bot-3"><?php echo $l->h_yu_name; ?></h2>
							<h4 class="ident-bot-3"><a href="#"><?php echo $l->h_name; ?> (<?php echo $l->h_short_name; ?>)</a></h4>
							<img src="/uploads/club/<?php echo $l->h_yu_name; ?>-128<?php echo $l->h_ext;?>" width="50" height="50"/>
							<h2 class="ident-bot-3"><?php echo $l->g_yu_name; ?></h2>
							<h4 class="ident-bot-3"><a href="#"><?php echo $l->g_name; ?> (<?php echo $l->g_short_name; ?>)</a></h4>
							<img src="/uploads/club/<?php echo $l->g_yu_name; ?>-128<?php echo $l->g_ext;?>" width="50" height="50"/>
							<?php } ?>
						</span>
                                                <?php foreach($game as $l) { ?>
                                                <p class="color-1 ident-bot-6" style="width: 450px;">Odigrava se u <?php echo date("d-m-Y H:i", strtotime( $l->time_of_game)); ?> utakmica izmedju domacina "<?php echo $l->h_yu_name; ?>" i gosta "<?php echo $l->g_yu_name; ?>"</p>
                                                <p class="color-1 ident-bot-6" style="width: 450px;"><?php echo $l->content; ?></p>

                                                <?php } ?>
    							<script type="text/javascript">
      								google.load("visualization", "1", {packages:["corechart"]});
      								google.setOnLoadCallback(drawChart);
      								function drawChart() {
        								var data = google.visualization.arrayToDataTable([
          									['Task', 'Statistika'],
          									['1',    <?php  echo $one[0]->score; ?>],
          									['X',    <?php echo $x[0]->score; ?>],
          									['2',    <?php echo $two[0]->score; ?>]
        								]);

        							var options = {
          								title: 'Statistika',
	  								backgroundColor : 'none',
	  								legend: {position: 'right', textStyle: {color: '#ffffff', fontSize: 13}},
	  								chartArea:{left:50,top:0,width:"450",height:"270"}
        								};

        								var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        								chart.draw(data, options);
      									}
    								</script>	
							<div id="chart_div" style="width: 450px; height: 230px;"></div>
					</div><!-- hero-unit -->
			</div><!-- span5 -->	
					<div class="span3">
						<div class="hero-unit">
						<h2 class="ident-bot-2">OPKLADE NA OVU UTAKMICU</h2>

							<?php if(!$game_bets){

								echo 'Niko nije odigrao na ova dva tima';

							}else{?>
							<?php foreach($game_bets as $update) { //print_r($game);?>
							<div class="ident-bot-6">

								<img class="img-ident-1  fl-l" width='27' height='27' src="http://graph.facebook.com/<?php echo $update->fb_id;?>/picture/small" alt="" />

								<p class="font-1 ws"><a href="/profile/<?php echo $update->u_id;?>"><?php echo $update->fname;?> <?php echo $update->lname;?></a></p>

								<p class="color-1 ident-bot-6">igra "<?php echo $update->score;?>" <?php echo $update->h_yu_name;?> : <?php echo $update->g_yu_name;?></p>
								<div class="clear"></div>

							</div>
							<?php } 
							}?>
						
						<a class="button" href="#">Pro&#269;itaj vi&#353;e</a>
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
					</div><!-- span3  -->
				</div>
		</div><!-- wrapper -->
	</div><!--row -->
</section> <!--content -->

