<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive"  style="padding: 10px;">	
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8">
					<form action="" method="post" enctype="multipart/form-data">
						<table class="table table-bordered table-hover">
							<?php if(isset($errors) && $errors != ""): ?>
								<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong><?=$errors?></strong></div>
							<?php endif;?>
							<tr align="center">
								<td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
							</tr>
							<tr>
								<td style="font-weight: bold;">Change Your Username</td>
								<td>
									<input class="form-control" type="text" name="name" required value="<?="$user_data->name"?>">
								</td>
							</tr>
							
							<tr>
								<td style="font-weight: bold;">Email</td>
								<td>
									<input class="form-control" type="email" name="email" required value="<?="$user_data->email"?>">
								</td>
							</tr>

							<tr>
								<td style="font-weight: bold;">Rank</td>
								<td>
									<select class="form-control" name="rank" required>
										<option value='<?="$user_data->rank"?>' selected><?="$user_data->rank"?></option>
										<option value="admin">Admin</option>
										<option value="customer">Customer</option>
									</select>
								</td>
							</tr>

							<tr>
								<td style="font-weight: bold;">Change Password</td>
								<td>
									<input class="form-control" placeholder="Type your current password" type="password" name="current_password" id="mypass" required value="<?=isset($POST['current_password']) ? $POST['current_password'] : '' ?>">
									<br>
									<input class="form-control" placeholder="Type new Password" type="password" name="new_password" id="mypass" required value="<?=isset($POST['new_password']) ? $POST['new_password'] : ''?>">
									<input type="checkbox" onclick="show_password()"><strong>Show Password</strong>
								</td>
							</tr>
							
							<tr align="center">
								<td colspan="6">
									<input type="submit" class="btn btn-info" style="width:250px;" value="Update">
								</td>
							</tr>
						</table>
					</form>
			</div>
				<div class="col-sm-2">
				</div>
		</div>
	</div>
</div>
<?php $this->view("admin/footer", $data); ?>

<script type="text/javascript">
	function show_password(){
		mypass = document.getElementById('mypass');
		if (mypass.type == "text") 
			mypass.type = "password";
		else
			mypass.type = "text";
		
	}
</script>