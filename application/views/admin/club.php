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
						<label><a href="/admin/club/add">Add Club</a></label>
					</p>
				</div>
				<div class="grid_16">
					<table>
						<thead>
							<tr>
								<th>Club</th>
								<th>Thumb</th>
								
								<th colspan="2" width="10%">Actions</th>
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
							<?php if($clubs == FALSE) { ?>
							<tr>
                                                                <td colspan="3">No results</td>
                                                        </tr>
							<?php } else {
							foreach($clubs as $club) { ?>
                                                        <tr>
                                                                <td><?php echo $club->name; ?></td>                     
								<td><img height="25" width="25"  src="/uploads/club/<?php echo $club->yu_name . '-48' . $club->ext; ?>" /></td>
                                                                <td><a href="/admin/club/edit/<?php echo $club->id; ?>" class="edit">Edit neradi</a></td>                                                                <td><a href="/admin/club/delete/<?php echo $club->id; ?>" class="delete">Delete</a></td>
                                                        </tr>
                                                        <?php } 
							} ?>							
						</tbody>
					</table>
				</div>
			</div>
