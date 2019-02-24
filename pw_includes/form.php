<?php

// Include key (not part of public repository)
include('sendgridkey.php');

$sent = false;
$formErrors = false;
$spamError = false;
$serverError = false;

if($input->post->submit) {
	
	// Check for spam ()
	if (!empty($input->post->email_2)) {
		$spamError = true;
	}
	
	// Check for field errors
	foreach ($formConfig as $key => $field) {

		// Find and validate email
		if ($field->form_type == 'email') {
			$emailkey = $key;
			if(!filter_var($input->post->$key, FILTER_VALIDATE_EMAIL)) {
				$formConfig[$key]->form_error = true;
				$formErrors = true;
			}
		}

		// Check for blank required fields
		if ($field->form_req) {
			if ($input->post->$key == '') {
				$formConfig[$key]->form_error = true;
				$formErrors = true;
			}
		}
	}
	
	// If no errors...
	if (!$formErrors AND !$spamError) {

		// Add fields to message
		foreach ($formConfig as $key => $field) {
			if ($field->form_type == 'text') 
				$msg .= $field->title . ": " . $sanitizer->text($input->post->$key) . "<br />";
			if ($field->form_type == 'email')
				$msg .= $field->title . ": " . $sanitizer->email($input->post->$key) . "<br />";
			if ($field->form_type == 'textarea') 
				$msg .= $field->title . ": " . $sanitizer->textarea($input->post->$key) . "<br />";
		}

		// Add reply message
		$msg .= "<br />Replies to this email will be sent to the email address provided by the sender: "
			. $sanitizer->email($input->post->$emailkey);
		
		// Setup Request
		$url = 'https://api.sendgrid.com/api/mail.send.json';
		$data = array(
		    'api_user' => 'minicreative',
		    'to' => $settings->contact->email,
		    'toname' => $settings->site_title,
		    'subject' => $settings->site_title.' website contact',
		    'html' => $msg,
		    'from' => 'hello@minicreative.net',
		    'fromname' => 'MiniCreative',
		    'replyto' => $sanitizer->email($input->post->$emailkey),
		);
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded",
		        'header'  => "Authorization: Bearer {$sendgridkey}",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);

		// Make request
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		// Handle success or failure
		if ($result === FALSE) $serverError = true;
		else $sent = true;
	}
}

?>

<div class="pw-form">

<?php 
	// Print form-message when relevant
	if ($formErrors)
		echo "<div class='form-message error'>There were errors with your submission. Please review the form.</div>";
	if ($spamError)
		echo "<div class='form-message'>This message was detected as spam. Please email us if this was a mistake.</div>";
	if ($serverErorr)
		echo "<div class='form-message error'>We're sorry, we couldn't send your message. Please email us instead.</div>";
	if ($sent)
		echo "<div class='form-message'><b>Thank you!</b> Your form was successfully submitted.</div>";
?>

	<form action="./" method="post">

		<?php // The following field is a hidden honeypot for spam detection purposes ?>
		<input name="email_2" class="honey" type="email" autocomplete="off" />

		<div class="columns stacked">

			<?php foreach ($formConfig as $key => $field) {
			
				echo "<div class=\"column {$field->form_size}\">";
				echo "<label for=\"{$key}\">{$field->title}</label>";
		
				if ($field->form_type == 'text' or $field->form_type == 'email') {
					echo "<input type=\"input\" name='{$key}'";
					if ($formErrors) echo " value=\"{$sanitizer->text($input->post->$key)}\"";
					echo " />";
				}
					
				if ($field->form_type == 'textarea') {
					echo "<textarea name=\"{$key}\">";
					if ($formErrors) echo $sanitizer->textarea($input->post->$key);
					echo "</textarea>";
				}
		
				if ($field->form_error) {
					if ($field->form_type == 'email') echo "<span class='form-error'>You entered an invalid email address. </span>";
					else echo "<span class='form-error'>This field cannot be left blank. </span>";
				}
				
				if ($field->desc !== '') echo "<span>{$field->desc}</span>";

				echo "</div>";

			} ?>

			<div class="column full">
				<input type="submit" name="submit" value="Submit" class="submit" />
			</div>

		</div><!-- columns -->
	</form>
</div><!-- pw-form -->