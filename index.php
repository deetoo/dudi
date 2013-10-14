<html>
<?
if ( $_POST['action'] == "add") {
$UserDel = $_POST['useracct'];

$fp = fopen('/tmp/user.dat', 'w');
fwrite($fp, $UserDel);
fclose($fp);

print "Account queued to be disabled.";
}
	else
	{
	$script = getenv("SCRIPT_NAME");
	?>
	
	<form action="<? echo "$script"; ?>" method="POST">
	<input type="hidden" name="action" value="add">
	Enter account to disable:<br>
	<input type="text" name="useracct" size="15">
	<input type="submit" value="submit">
	<?
	}
?>

<body>
</html>
