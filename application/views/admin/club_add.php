			<?php echo form_open_multipart('admin/club/add');?>
			<div id="content" class="container_16 clearfix">
				<div class="grid_16">
					<h2>Add Club</h2>
					<?php echo validation_errors('<p class="error">', '</p>'); ?>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Club <small>Must contain alpha-numeric characters.</small></label>
						<input type="text" name="name" size="20" value="<?php echo set_value('name'); ?>"/>
					</p>
				</div>
				<div class="grid_5">
                                        <p>
                                                <label for="short_name">Short name <small>Brasil is BRA.</small></label>
                                                <input type="text" name="short_name" size="20" value="<?php echo set_value('short_name'); ?>"/>
                                        </p>
                                </div>
				<div class="grid_6">
                                        <p>
                                                <label for="yu_name">YU name <small>Brasil je na nasem Brazil.</small></label>
                                                <input type="text" name="yu_name" size="20" value="<?php echo set_value('yu_name'); ?>"/>
                                        </p>
                                </div>
				<div class="grid_16">
					<p>
						<label for="title">Upload image <small>Only jpeg, jpg, png, gif.</small></label>
						<input type="file" name="image" size="20" />
					</p>
						
				
					<p class="submit">
						<input type="reset" value="Reset" />
						<input type="submit" value="Post" />
					</p>
				</div>
			</div>
			</form>
