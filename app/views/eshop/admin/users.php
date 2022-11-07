<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive" style="padding: 10px;">
		
		<span style="cursor: pointer;"  data-toggle="modal" data-target="#myModal" style="color: white;"><button type="button" class="btn btn-primary btn-ls pull-left"><i class="fa fa-plus"></i> Add new User</button></span>

		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr>
					<th>user ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Date Created</th>
					<th>Ordes count</th>
				</tr>
			</thead>
			<tbody onclick="show_detail(event)">
			<?php if (is_array($users)): ?>
				<?php foreach ($users as $user):?>
					<tr>
						<td><?=$user->id?></td>
					
						<td><a href="<?=ROOT?>profile/<?=$user->url_address?>"><img class="img-circle" src="<?= ($user->image != "") ? ROOT.$user->image : ROOT.'uploads/user.png'?>" width="35px" height="35px" align=""> <?=$user->name?></a></td>
						<td><?=$user->email?></td>
						<td><?=date("jS M Y H:i a", strtotime($user->date))?></td>
						<td><?=$user->orders_count?></td>
						<td><a href="<?=ROOT?>admin/users/<?=$type?>?delete=<?=$user->id?>"><button class="btn btn-danger" title="delete"><i class="fa fa-trash-o"></button></i></a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
		
		<!-- Modal -->
		
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Add new User</h4>
                      </div>
                      <div class="modal-body">
                      	<form method="post">
                      	  <p>Enter with Username.</p>
                          <input type="text" name="name" placeholder="Username" autocomplete="off" class="form-control placeholder-no-fix">
                          <p>Enter with email</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                          <p>Select a rank </p>
                          <select name="rank" class="form-control placeholder-no-fix" autocomplete="off">
                        	<option value="admin">Administrador</option>
                        	<option value="customer" selected>Cliente</option>
                      	  </select>

	                      </div>
	                      <div class="modal-footer">
	                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
	                          <button class="btn btn-theme" type="submit">Save</button>
	                      </div>
                  		</form>
                  </div>
              </div>
          </div>
      	
        <!-- modal -->

		</div>
	</div>
</div>

<?php $this->view("admin/footer", $data); ?>
