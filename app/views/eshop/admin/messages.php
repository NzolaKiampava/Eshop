<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive" style="padding: 10px;">
			<table class="table table-striped table-advance table-hover">
				
				<?php if($mode == "read"):?>
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Date Created</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody onclick="show_detail(event)">
						<?php if (isset($messages) && is_array($messages)): ?>
							<?php foreach ($messages as $message): ?>
								<tr>
									<td><?=$message->name?></td>
									<td><?=$message->email?></td>
									<td><?=$message->subject?></td>
									<td><?=$message->message?></td>
									<td><?=date("jS M Y H:i a", strtotime($message->date))?></td>
									<td><a href="<?=ROOT?>admin/messages?delete=<?=$message->id?>"><button class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						<tr><td colspan="8"><?php Page::show_links()?></td></tr>
					</tbody>
				<?php elseif($mode == "delete_confirmed"): ?>

					<div class="alert alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>The message was deleted successfully</strong></div>

					<td><a href="<?=ROOT?>admin/messages"><input type="button" class="btn btn-success pull-left" value="Back to message" /></i></a></td>

				<?php elseif($mode == "delete" && is_object($messages)): ?>
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Date Created</th>
							<th>Action</th>
						</tr>
					</thead>

					<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Are you sure you want to delete this message?</strong></div>
					
					<tbody>
						<tr>
							<td><?=$messages->name?></td>
							<td><?=$messages->email?></td>
							<td><?=$messages->subject?></td>
							<td><?=$messages->message?></td>
							<td><?=date("jS M Y H:i a", strtotime($messages->date))?></td>
							<td><a href="<?=ROOT?>admin/messages?delete_confirmed=<?=$messages->id?>"><button class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
						</tr>
					</tbody>
				<?php endif;?>
			</table>
		</div>
	</div>
</div>

<?php $this->view("admin/footer", $data); ?>