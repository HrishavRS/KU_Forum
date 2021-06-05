<?php
include 'connect.php';
include 'header.php';

echo '<h3>SIGN UP</h3>';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo '<form method="post" action="">
		Username: <input type="text" name="user_name">
		Password: <input type="password" name="user_pass">
		Password Again: <input type="password" name="user_pass_check">
		E-mail: <input method="email" name="user_email">
		<input type="submit" value="Submit Now">
	</form>';
}
else
{
	$errors = array();
	if(isset($_POST['user_name']))
	{
		if(!ctype_alnum($_POST['username']))
		{
				$errors[]='The username can only contain letters and digits.';
		}
		if(!strlen($_POST['username'])>30)
		{
			$errors[]='The username cannot be longer than 30 chracters';
		}
	}
	else
	{
		$errors[]='The username field must not be empty.';
	}

	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] !=$_POST['user_pass_check'])
		{
			$errors[]='The two passwords did not match.';
		}
	}
	else
	{
		$errors[]='The password field cannot be empty.';
	}

	if(!empty($errors))
	{
		echo 'Some fields are empty';
		echo '<ul>';
		foreach($errors as $key =>$value)
		{
			echo '<li>' .$value.'</li>';
		}
		echo '</ui>';
	}
	else
	{
		$sql="INSERT INTO 
				users(user_name,user_pass,user_email,user_date,user_level)
				VALUES('".mysql_real_escape_string($_POST['user_name'])."',
						'".shal($_POST['user_pass'])."',
						'".mysql_real_escape_string($_POST['user_email'])."',
						NOW(),
						0)";
		$result=mysql_query($sql);
		if(!result)
		{
			echo'Something has gone wrong';
		}
		else
		{
			echo'Successfully registered in the database.Visit <a href="signin.php">Sign In</a>.';
		}

	}
}
include'footer.php';
?>