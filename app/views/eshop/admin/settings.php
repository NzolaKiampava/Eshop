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
								<td>
									<?php if($setting->type == "" || $setting->type == "text"):?>
									<input placeholder="<?=ucwords(str_replace("_", " ", $setting->setting))?>" class="form-control" type="text" name="<?=$setting->setting?>" value="<?=$setting->value?>" />
									<?php elseif($setting->type == "textarea"):?>
									<textarea placeholder="<?=ucwords(str_replace("_", " ", $setting->setting))?>" class="form-control"name="<?=$setting->setting?>"><?=$setting->value?></textarea>
									<?php endif;?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
					<input type="submit" value="Save Settings" class="btn btn-warning pull-right">
				</table>
				

				<?php elseif($type == "slider_images"): ?>
					<table class="table table-striped table-advance table-hover">	
						<?php if($action == "show"): ?>

							<h4><i class="fa fa-angle-right"></i> Slider Images <a href="<?=ROOT?>admin/settings/slider_images?action=add"><button type="button" class="btn btn-primary btn-ls pull-right"  data-toggle="modal" data-target="#addcategory"><i class="fa fa-plus"></i> Add New</button></a></h4>
						
							<hr>

						<thead>
							<tr>
								<th>Header 1 Text</th>
								<th>Header 2 Text</th>
								<th>Main Message</th>
								<th>Product Link</th>
								<th>Product Image</th>
								<!--<th>Disabled</th>-->
								<th>Action</th>
							</tr>
						</thead>
						<tbody onclick="show_detail(event)">
							<?php if (isset($rows) && is_array($rows)): ?>
								<?php foreach ($rows as $row): ?>
									<tr>
										<td><?=$row->header1_text?></td>
										<td><?=$row->header2_text?></td>
										<td><?=$row->text?></td>
										<td><?=$row->link?></td>
										<td><img src="<?=ROOT . $row->image?>" style="width: 90px;"></td>
										<!--<td><?=$row->disabled ? "YES" : "NO"?></td>-->
										<td>
											<a href="<?=ROOT?>admin/settings/slider_images?edit=<?=$row->id?>"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>

											<a href="<?=ROOT?>admin/settings/slider_images?delete=<?=$row->id?>"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>
										
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
						</tbody>
						

						<?php elseif($action == "add"): ?>
							<div style="padding: 20px">
								<h2>Add New Row</h2>
								<?php if(isset($errors)): ?>
									<div class="alert alert-danger alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									  <strong>Warning!</strong> <?=$errors?>.
									</div>
								<?php endif;?>
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
									<textarea name="text" id="text" class="form-control"><?=(isset($POST['text']) ? $POST['text'] : "")?></textarea>
								</div>
								<div class="form-group">
									<label for="link">Content Link </label>
									<input id="link" type="text" class="form-control" name="link" placeholder="Ex.: http://localhost/eshop/public/product_details/product_name" value="<?=(isset($POST['link']) ? $POST['link'] : "")?>"link>
								</div>
								<div class="form-group">
									<label for="image">Slider Image </label>
									<input id="image" type="file" class="form-control" name="image">

								</div>

								<input type="submit" value="add" class="btn btn-primary pull-right">
							</div>

						<?php elseif($action == "edit"): ?>
							<div style="padding: 20px">
								<h2>Edit Slider Image</h2>
								<?php if(isset($errors)): ?>
									
									<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong><?=$errors?></strong></div>
									
								<?php endif;?>
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
									<textarea name="text" id="text" class="form-control"><?=(isset($POST['text']) ? $POST['text'] : "")?></textarea>
								</div>
								<div class="form-group">
									<label for="image">Slider Image </label>
									<input id="image" type="file" class="form-control" name="image">
									<input type="hidden" name="id" value="<?=isset($POST['id']) ? $POST['id'] : ''?>">
								</div>
								<div class="form-group">
									<label for="link">Content Link </label>
									<input id="link" type="text" class="form-control" name="link" placeholder="http://localhost/eshop/public/product_details/example_name" value="<?=(isset($POST['link']) ? $POST['link'] : "")?>"link>
								</div>
									
									<hr>
									<img src="<?=ROOT.$POST['image']?>" width="150">

								<input type="submit" value="Save" class="btn btn-primary pull-right">
							</div>

						<?php elseif($action == "delete"): ?>
							<div style="padding: 20px">
								<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Are you sure you want to delete this slider image?</strong></div>
								<thead>
									<tr>
										<th>Header 1 Text</th>
										<th>Header 2 Text</th>
										<th>Main Message</th>
										<th>Product Link</th>
										<th>Product Image</th>
										<!--<th>Disabled</th>-->
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td><?=$slider->header1_text?></td>
										<td><?=$slider->header2_text?></td>
										<td><?=$slider->text?></td>
										<td><?=$slider->link?></td>
										<td><img src="<?=ROOT . $slider->image?>" style="width: 90px;"></td>
										<td><a href="<?=ROOT?>admin/settings/slider_images?delete_confirmed=<?=$slider->id?>"><button type="button" class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
									</tr>
								</tbody>
							</div>

						<?php elseif($action == "delete_confirmed"): ?>
							<div style="padding: 20px">
								<div class="alert alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>The message was deleted successfully</strong></div>

								<td><a href="<?=ROOT?>admin/settings/slider_images"><input type="button" class="btn btn-success pull-left" value="Back to message" /></i></a></td>
							</div>
						<?php endif; ?>

					</table>
					
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>

<?php $this->view("admin/footer", $data); ?>
