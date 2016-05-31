			<?php echo form_open_multipart('admin/mergeusers/add');?>
			<div id="content" class="container_16 clearfix">
				<div class="grid_16">
					<h2>Spoji ucesnike, vrsi se tako sto ce novi biti unisten a stari ce biti nastavljen</h2>
					<?php echo validation_errors('<p class="error">', '</p>'); ?>
				</div>

				<div class="grid_8">
					<p>
						<label for="title">Stari ucesnik<small>(Stari facebook ucesnik)</small></label>
						<select name="old_id">
                                                <?php foreach($users as $u){
                                                        echo '<option value="'. $u->u_id  .'">'. $u->fname .' '. $u->lname .'</option>';
                                                }
                                                ?>
                                                </select>
					</p>
				</div>
				<div class="grid_8">
					<p>
						<label for="title">Novi ucesnik <small>(novo prijavljeni)</small></label>
						<select name="new_id">
						<?php foreach($users as $u){
							echo '<option value="'. $u->u_id  .'">'. $u->fname .' '. $u->lname .'</option>';
						}
						?>
						</select>
					</p>
				</div>
				<div class="grid_16">
					<p class="submit">
						<input type="reset" value="Reset" />
						<input type="submit" value="Post" />
					</p>
				</div>

			</div>
			</form>
