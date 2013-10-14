<html>
<?

$DelFile = "/tmp/user.dat";


if ( $_POST['action'] == "add") {
$UserDel = $_POST['useracct'];

$fp = fopen( $DelFile , 'w' );
fwrite($fp, $UserDel);
fclose($fp);
// set  perms so script owner can delete after exec.
chmod( $DelFile, 0777 );

print "<center>Account queued to be disabled.</center>";
}
	else
	{
	$script = getenv("SCRIPT_NAME");
	?>
	
	<form action="<? echo "$script"; ?>" method="POST">
	<input type="hidden" name="action" value="add">
	<center>Enter account to disable:<br>
	<input type="text" name="useracct" size="15">
	<input type="submit" value="submit">
	</center>
	<?
	}
?>

<body>
</html>
