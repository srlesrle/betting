			<?php  echo form_open('admin/game/editgo');?>
                        <div id="content" class="container_16 clearfix">
			<?php foreach($game as $g) { ?>
				<input type="hidden" name="id" value="<?php echo $g->id; ?>" />
                                <div class="grid_16">
                                        <h2>Ubaci utakmicu</h2>
                                        <?php echo validation_errors('<p class="error">', '</p>'); ?>
                                </div>

                                <div class="grid_8">
                                        <p>
                                                <label for="title">Domaci <small>(Home)</small></label>
                                                <?php echo form_dropdown('h_id', $clubs , (set_value('h_id') == '' ? $g->h_id : set_value('h_id'))); ?>
                                        </p>
                                </div>
                                <div class="grid_8">
                                        <p>
                                                <label for="title">Gosti <small>(Guest)</small></label>
                                                <?php echo form_dropdown('g_id', $clubs , (set_value('g_id') == '' ? $g->g_id : set_values('g_id'))); ?>
                                        </p>
                                </div>
                               <?php $day_data = date("d", strtotime($g->time_of_game)); ?> 
				<div class="grid_3">
                                        <p>
                                                <label for="title">Dan <small></small></label>
                                                <?php echo form_dropdown('day', $day , (set_value('day') == '' ? $day_data : set_value('day'))); ?>
                                        </p>
                                </div>
				<?php $day_data = date("m", strtotime($g->time_of_game)); ?>
                                <div class="grid_3">
                                        <p>
                                                <label for="title">Mjesec <small></small></label>
                                                <?php echo form_dropdown('month', $month , (set_value('month') == '' ? $day_data : set_values('month'))); ?>
                                        </p>
                                </div>
				<?php $day_data = date("Y", strtotime($g->time_of_game)); ?>
                                <div class="grid_4">
                                        <p>
                                                <label for="title">Godina <small></small></label>
                                                <?php echo form_dropdown('year', $year , (set_value('year') == '' ? $day_data : set_values('year'))); ?>
                                        </p>
                                </div>
				<?php $day_data = date("H", strtotime($g->time_of_game)); ?>
                                <div class="grid_3">
                                        <p>
                                                <label for="title">Sati <small></small></label>
                                                <?php echo form_dropdown('hours', $hours , (set_value('hours') == '' ? $day_data : set_value('hours'))); ?>
                                        </p>
                                </div>
				<?php $day_data = date("i", strtotime($g->time_of_game)); ?>
                                <div class="grid_3">
                                        <p>
                                                <label for="title">Minuta <small></small></label>
                                                <?php echo form_dropdown('minutes', $minutes , (set_value('minutes') == '' ? $day_data : set_value('minutes'))); ?>
                                        </p>
                                </div>
				
                                <div class="grid_4">
                                        <p>
                                                <label>Kvota za 1<small>primjer 1.22 koristi tacku</small></label>
                                                <input type="text" name="one" value="<?php echo (set_value('one') == '' ? $g->one : set_value('one')); ?>" />
                                        </p>
                                </div>
                                <div class="grid_4">
                                        <p>
                                                <label>Kvota za x<small>primjer 1.22 koristi tacku</small></label>
                                                <input type="text" name="x" value="<?php echo (set_value('x') == '' ? $g->x : set_value('x')); ?>" />
                                        </p>
                                </div>
                                <div class="grid_4">
                                        <p>
                                                <label>Kvota za 2<small>primjer 1.22 koristi tacku</small></label>
                                                <input type="text" name="two" value="<?php echo (set_value('two') == '' ? $g->two : set_value('two')); ?>" />
                                        </p>
                                </div>
                                <div class="grid_16">
                                        <p>
                                                <label>Kratki opis <small>kratki opis</small></label>
                                                <textarea name="content" class="big"><?php echo (set_value('content') == '' ? $g->content : set_value('content')); ?></textarea>
                                        </p>
                                        <p class="submit">
                                                <input type="reset" value="Reset" />
                                                <input type="submit" value="Post" />
                                        </p>
                                </div>
			<?php } ?>
                        </div>
                        </form>

