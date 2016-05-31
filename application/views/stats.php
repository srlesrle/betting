<!-- content -->
                <section id="content">
                        <div class="row">
                                <div class="wrapper">
					<div class="span8">
                                        <div class="hero-unit">
                                                <h2 class="ident-bot-2">UTAKMICE</h2>
                                                <h4 class="ident-bot-3"><a href="/stats">Statistika odigranig sportskih utakmica</a></h4>
                                                <table class="index_table">
                                                        <thead>
                                                                <tr>
                                                                        <th>Utakmice</th>                                                                        <th width="65">Vrijeme</th>
                                                                        <th>statistika</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
						<?php foreach($games as $game) { // print_r($game);?>
                                                        <tr>
                                                                <td style="line-height:100%;" class="td_center">
                                                                        <img src="/uploads/club/<?php echo $game->h_yu_name; ?>-24<?php echo $game->h_ext;?>" width="24" height="24"/>

                                                                        <span class="font-1 index_table_font"><a style="font-size:14px;" href="/game/<?php echo $game->title;?>">
                                                                                <?php echo $game->h_yu_name; ?>
                                                                                        : 
                                                                                <?php echo $game->g_yu_name; ?>
                                                                        </a></span>
                                                                        <img src="/uploads/club/<?php echo $game->g_yu_name; ?>-24<?php echo $game->g_ext;?>" width="24" height="24"/>
                                                                </td>
                                                                <td width="65" style="font-size:10px;line-height:100%; text-align:center;">
                                                                <?php echo date("d-m-Y H:i", strtotime($game->time_of_game)); ?>
                                                                </td>
                                                                <td class="td_center">
								<?php 
								$this->load->model('admin_game');
								$one = $this->admin_game->get_1($game->id);
								$x = $this->admin_game->get_x($game->id);
								$two = $this->admin_game->get_2($game->id);
								?>
									<script type="text/javascript">
      										google.load("visualization", "1", {packages:["corechart"]});
      										google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Statistika'],
          ['1',    <?php echo $one[0]->score;?>],
          ['X',    <?php echo $x[0]->score;?>],
          ['2',    <?php echo $two[0]->score;?>]
        ]);

        var options = {
          title: 'Statistika',
	  backgroundColor : 'none',
	  legend: {position: 'right', textStyle: {color: '#ffffff', fontSize: 13}},
	  chartArea:{left:50,top:0,width:"250",height:"120"}
        };

        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $game->id;?>'));
        chart.draw(data, options);
      }
    </script>	
<div id="<?php echo $game->id;?>" style="width: 250px; height: 120px;">
								</td>
                                                        </tr>
                                                        <?php 
                                                        }?>
                                                        </tbody>
                                                </table>
</div>
</div>

                                        <div class="span3">
					<div class="hero-unit">
                                                        <h3 class="ident-bot-2">Tabela</h3>
                                                        <div class="ident-bot-6">
                                                                <?php $this->load->view('ranking.php'); ?>
                                                                <div class="clear"></div>
                                                        </div>
                                                        <!--<a class="button" href="#">Pro&#269;itaj vi&#353;e</a>-->

					</div>
                                        </div>

                                </div>

                        </div>
			

                </section><!-- end content -->
