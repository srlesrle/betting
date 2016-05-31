<div id="content" class="container_16 clearfix">
				<div class="grid_14">
					<p>
						<label>Klub<small>po imenu kluba pretraga</small></label>
						<input type="text" />
					</p>
				</div>
				<div class="grid_2">
					<p>
						<label>&nbsp;</label>
						<input type="submit" value="Search" />
					</p>
				</div>
				<div class="grid_16">
					<p>
						<label><a href="/admin/game/add">Ubaci utakmicu</a></label>
					</p>
				</div>
				<div class="grid_16">
					<table>
						<thead>
							<tr>
								<th>Utakmica</th>
								<th>Rezultat</th>
								<th>Vrijeme utakmice</th>
								
								<th colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="5" class="pagination">
									<span class="active curved">1</span><a href="#" class="curved">2</a><a href="#" class="curved">3</a><a href="#" class="curved">4</a> ... <a href="#" class="curved">10 million</a>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php if($games == FALSE) { ?>
							<tr>
    	                        <td colspan="3">No results</td>
                            </tr>
							<?php } else {
							foreach($games as $game) { ?>
							<tr>
                                <td><?php echo $game->h_yu_name .' : '. $game->g_yu_name; ?></td>
                                <td><?php echo $game->score;?></td>                            
                                <td><?php echo $game->time_of_game;?></td>
								<td><?php 
									if($game->score == ''){ ?>
								<a href="/admin/game/add_game_result/<?php echo $game->id; ?>" class="edit">Ubaci rezultat</a>
								<?php } ?>
								</td>
                                                                <td><a href="/admin/game/edit/<?php echo $game->id; ?>" class="edit">Izmjeni</a></td>                                                                
								<td><a href="/admin/game/delete/<?php echo $game->id; ?>" class="delete error">Izbrisi</a></td>
                                                        </tr>
                                                        <?php } 
							} ?>							
						</tbody>
					</table>
				</div>
			</div>
