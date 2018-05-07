<!DOCTYPE html>
<html>
<head>
</head>
<body>


<?php 
	// echo form_open_multipart('AccountSetup/upload_image'); 
	// echo form_upload(['name' => 'userfile', 'value' => 'Save']); 
	// echo form_error('userfile', '<div class = "text-danger">', '</div>'); 
	// echo form_submit(['name' => 'submit', 'value' => 'Upload Images']); 
		// echo anchor("AccountSetup/upload_image", 'View Images'); 
	// echo form_close(); 
?>

	<div>
		<form action="<?= base_url('UserStatus/upload'); ?>" method="POST" enctype="multipart/form-data">
			<input type="file" accept="image/*" name="uploadedFile" /> <br>
			<input type="submit" value="UPLOAD" name="submit" />
		</form>
	</div>

</body>
</html>
