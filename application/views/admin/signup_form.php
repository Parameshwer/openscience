<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<?php
$attributes = array('class' => 'form-signin');   
echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Create an account</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="First name"');
echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"');
echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');

echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password"');
echo form_password('password2', '', 'placeholder="Password confirm"');

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>
</div>
    