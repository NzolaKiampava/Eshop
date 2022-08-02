<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive">
			<form method="post" enctype="multipart/form-data">
				
				<?php if($type == "socials"): ?>

				<table class="table table-striped table-advance table-hover">	
					<thead>
						<tr>
							<th>Setting</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody onclick="show_detail(event)">
					<?php if (isset($settings) && is_array($settings)): ?>
						<?php foreach ($settings as $setting): ?>
							<tr>
								<td><?=ucwords(str_replace("_", " ", $setting->setting))?></td>
								<td><input placeholder="<?=ucwords(str_replace("_", " ", $setting->setting))?>" class="form-control" type="text" name="<?=$setting->setting?>" value="<?=$setting->value?>" /></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>

				</table>
				<input type="submit" value="Save Settings" class="btn btn-warning pull-right">

				<?php elseif($type == "slider_images"): ?>
					<table class="table table-striped table-advance table-hover">	
						<?php if($action == "show"): ?>

						<thead>
							<tr>
								<th>Header 1 Text</th>
								<th>Header 2 Text</th>
								<th>Main Message</th>
								<th>Product Link</th>
								<th>Product Image</th>
								<th>Disabled</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody onclick="show_detail(event)">
						
						</tbody>
						<a href="<?=ROOT?>admin/settings/slider_images?action=add">
							<input type="button" value="Add row" class="btn btn-warning pull-right">
						</a>

						<?php elseif($action == "add"): ?>
							<div style="padding: 20px">
								<h2>Add New Row</h2>
								<div class="form-group">
									<label for="header1_text">Header 1 Text </label>
									<input autofocus id="header1_text" type="text" class="form-control" name="header1_text" placeholder="" value="<?=(isset($POST['header1_text']) ? $POST['header1_text'] : "")?>">
								</div>
								<div class="form-group">
									<label for="header2_text">Header 2 Text </label>
									<input id="header2_text" type="text" class="form-control" name="header2_text" placeholder="" value="<?=(isset($POST['header2_text']) ? $POST['header2_text'] : "")?>">
								</div>
								<div class="form-group">
									<label for="text">Main message </label><br>
									<textarea name="message" id="text" class="form-control"><?=(isset($POST['message']) ? $POST['message'] : "")?></textarea>
								</div>
								<div class="form-group">
									<label for="link">Content Link </label>
									<input id="link" type="text" class="form-control" name="link" placeholder="" value="<?=(isset($POST['link']) ? $POST['link'] : "")?>"link>
								</div>
								<div class="form-group">
									<label for="image">Slider Image </label>
									<input id="image" type="file" class="form-control" name="image">
								</div>

								<input type="submit" value="Add" class="btn btn-primary pull-right">
							</div>
						<?php endif; ?>

					</table>
					
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>

<?php $this->view("admin/footer", $data); ?>