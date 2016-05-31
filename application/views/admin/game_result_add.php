<?php echo form_open_multipart('admin/game/add_game_result/'. $id);?>
			<div id="content" class="container_16 clearfix">
			<div class="grid_16">
                <p>
					<label for="title">Rezultat <small>(Score)</small></label>
					<?php echo form_dropdown('score', $score , set_value('score')); ?>
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