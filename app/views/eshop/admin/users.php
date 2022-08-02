<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive">
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr>
						<th>user id</th>
						<th>Name</th>
						<th>Email</th>
						<th>Date Created</th>
						<th>Ordes count</th>
					</tr>
				</thead>
				<tbody onclick="show_detail(event)">
				<?php if (is_array($users)): ?>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?=$user->id?></td>
							<td><a href="<?=ROOT?>profile/<?=$user->url_address?>"><?=$user->name?></a></td>
							<td><?=$user->email?></td>
							<td><?=date("jS M Y H:i a", strtotime($user->date))?></td>
							<td><?=$user->orders_count?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $this->view("admin/footer", $data); ?>