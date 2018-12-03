<?php

$sent = false;
$formErrors = false;
$emailTo = 'toams7@gmail.com';

if($input->post->submit) {
	
	foreach ($form as $key => $field) {
		//Find and validate email
		if ($field->form_type == 'email') {
			if(!filter_var($input->post->$key, FILTER_VALIDATE_EMAIL)) {
				$emailkey = $key;
				$form[$key]->form_error = true;
				$formErrors = true;
			}
		}
		//Check for blanks (except in textarea)
		if ($field->form_type !== 'textarea' and $field->form_req) {
			if ($input->post->$key == '') {
				$form[$key]->form_error = true;
				$formErrors = true;
			}
		}
	}
	
	//Add fields to msg
	foreach ($form as $key => $field) {
		if ($field->form_type == 'text' or $field->form_type == 'email') 
			$msg .= $field->title . ": " . $sanitizer->text($input->post->$key) . "\n";
		if ($field->form_type == 'textarea') 
			$msg .= $field->title . ": " . $sanitizer->textarea($input->post->$key) . "\n";
	}
	
	//If no errors, email form
	if (!$formErrors) {
		mail($emailTo, "New message from website" , $msg, "From: {$input->post->$emailkey}");
    	$sent = true;
	}
} 

?>

<div class="form">
	<?php 
	if ($formErrors) echo "<div class='sent error'>There were errors with your submission. Please review the form.</div>";
	if ($sent) echo "<div class='sent'><b>Thank you!</b><br />Your form was successfully submitted.</div>";
	?>
	<form action="./" method="post">
		<?php
		foreach ($form as $key => $field) {
		  
			echo "<div class=\"{$field->form_size}\">";
			echo "<label for=\"{$key}\">{$field->title}</label>";
	
			if ($field->form_type == 'text' or $field->form_type == 'email') {
				echo "<input type=\"input\" name='{$key}'";
				if ($formErrors) echo " value=\"{$sanitizer->text($input->post->$key)}\"";
				echo " />";
			}
				
			if ($field->form_type == 'textarea') {
				echo "<textarea name=\"comments\">";
				if ($formErrors) echo $sanitizer->textarea($input->post->$key);
				echo "</textarea>";
			}
	
			if ($field->form_error) {
				if ($field->form_type == 'email') echo "<span class='error'>You entered an invalid email address. </span>";
				else echo "<span class='error'>This field cannot be left blank. </span>";
			}
			
			if ($field->desc !== '') echo "<span>{$field->desc}</span>";
			echo "</div>";
		} ?>
	<div class="clear"></div>
	<input type="submit" name="submit" value="Submit" class="submit" />
	</form>
</div>