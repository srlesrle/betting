						<?php $champion = $this->session->userdata('champion');  if($champion['champion'] != 0){?>
							<h4>&#352;ampion feb 2013</h4>
							<p>
								<?php foreach($this->session->userdata('champion') as $rank) {?>
									<?php echo '<img width="50" height="50" class="" src="http://graph.facebook.com/'.$rank[0]->fb_id.'/picture/small" alt="'. $rank[0]->fname .' '. $rank[0]->lname.'">'; ?>
								<a style="font-size:10px;" href="/profile/<?php echo $rank[0]->u_id;?>">
                                                                                <?php echo $rank[0]->fname .' '. $rank[0]->lname; ?>
                                                                </a>
								<img src="/img/medal.png" alt="Sampion" title="Sampion"/>
								<?php } ?>
							</p>
						<?php } ?>
						<table class="table">
                                                        <thead>
                                                                <tr>
                                                                        <th>Poz.</th>
                                                                        <th width="95">Ime</th>
                                                                        <th>Bod.</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if(!$this->session->userdata('ranking')){
                                                                echo '<tr>';
                                                                echo '<td>Nema odigranih za mjesec '. date("M,Y")  .' utakmica</td>';
                                                                echo '</tr>';
                                                        }else{?>
                                                        <?php
							$rank_count = 0;
							foreach($this->session->userdata('ranking') as $rank) { // print_r($game);?>
                                                        <tr>
								<td class="td_center">
									<?php echo ($rank_count ++ == 0 ? '<img width="30" height="30" class="" src="http://graph.facebook.com/'.$rank->fb_id.'/picture/small" alt="">' : $rank_count); ?>
                                                                </td>
                                                                <td style="line-height:100%;" class="td_center">
                                                                        <span class="font-1 index_table_font">
										<a style="font-size:10px;" href="/profile/<?php echo $rank->u_id;?>">
                                                                                <?php echo $rank->fname .' '. $rank->lname; ?>
                                                                        	</a></span>
                                                               </td>
                                                                <td class="td_center">
									<?php echo $rank->score;?>
                                                                </td>
                                                        </tr>
                                                        <?php }
                                                        }?>
                                                        </tbody>
                                                </table>
