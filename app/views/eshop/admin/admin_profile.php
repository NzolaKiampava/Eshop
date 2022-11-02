<?php $this->view("admin/header", $data); ?>
<?php $this->view("admin/sidebar", $data); ?>

   <style>

        .dragging{

            border: dashed 2px #448aff;
        }


   </style>

   	<?php
	   $image = ROOT . 'uploads/default-user.jpg';
	   if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
	   {
	        $image = $user_data->image;
	   }
   ?>

<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel table-responsive"  style="padding: 10px;">	
			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8">
					<form action="" method="POST" enctype="multipart/form-data">
						<table id="myform" class="table table-bordered table-hover">
							<?php if(isset($errors) && $errors != ""): ?>
								<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong><?=$errors?></strong></div>
							<?php endif;?>
							<tr align="center">
								<td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
							</tr>
							<tr>

                                <td>
                                
                                
                                <center><img ondragover="handle_drap_and_drop(event)" ondrop="handle_drap_and_drop(event)" ondragleave="handle_drap_and_drop(event)" src="<?=ROOT.$image?>" style="width:200px; height:200px; margin:10px;"></center></td>

                                <td>
                                	
                                    <center><label for="change_image_input" id="change_image_button" style="background-color:#9b9a80; color:white; width:300px; margin-top: 25%; padding:1em; border-radius;5px; cursor: pointer; text-align:center">Trocar Imagem</label><br>
                                    
                                    <span style="font-size:11px; margin-left:9px;">Ou arraste e solte uma imagem para Trocar</span></center>

                                    <input class="form-control" type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display:none">
                                </td>
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

	function _(element){

       return document.getElementById(element);
   }



    function upload_profile_image(files){ //files is an array
        var change_image_button = _("change_image_button");
        change_image_button.disabled = false;
        change_image_button.innerHTML = "Actualizando Imagem...";

        var myform = new FormData();  //declarating a new FormData object

        var xml = new XMLHttpRequest();
        xml.onload = function(){

            if (xml.readyState == 4 || xml.status == 200) {

                alert(xml.responseText);
                //get_data({}, "user_info"); //refreshing the user_info
                window.location = "<?=ROOT?>admin/admin_profile";
                change_image_button.disabled = false;
                change_image_button.innerHTML = "Trocar Imagem";
   
            }
        }

        myform.append("files", files[0]); //appending files which files[0]
        myform.append("data_type", "change_profile_image"); //appending data_type which is Change im....

        xml.open("POST", "<?=ROOT?>ajax_upload_profile_pic", true);
        xml.send(myform);

    }

    function handle_drap_and_drop(e){  //dragging, drop and leave image

        if(e.type == "dragover"){

            e.preventDefault();  //prevenir o comportamento padrao de sustituir a imagem na pagina
            e.target.className = "dragging";

        }

        else if(e.type == "dragleave"){

            e.target.className = "";

        }

        else if(e.type == "drop"){

            e.preventDefault();  //prevenir o comportamento padrao de sustituir a imagem na pagina
            e.target.className = "";
            //console.log(e.dataTransfer.files);
            upload_profile_image(e.dataTransfer.files); //calling the function to upload the image

        }
    }

</script>
