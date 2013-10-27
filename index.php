<html>
<title>DUDI - Distributed Useraccount Disabler</title>
<body bgcolor="ffffff" text="#00000" link="#ff0000" vlink="#ff0000">
<?

error_reporting(E_ALL);


$DelFile = "/home/www-data/user.dat";


if (file_exists($DelFile)) {
    echo "<center><img src=\"dudi.png\" border=\"0\"><br>There is an account already in the queue to be disabled.<br>Please try again in five minutes.</center></html>";
exit;
} 

if ( $_POST['action'] == "add") {
$UserDel = $_POST['useracct'];

$fp = fopen( $DelFile , 'w' );
fwrite($fp, $UserDel);
fclose($fp);
// set  perms so script owner can delete after exec.
chmod( $DelFile, 0777 );

print "<center><img src=\"dudi.png\" border=\"0\"><br><br><b>Account queued to be disabled.<br>Click <a href=index.php>HERE to return.</a><br /></center>";
}
	else
	{
	$script = getenv("SCRIPT_NAME");
	?>
	<center>
	<table>
		<tr>
			<td rowspan="2"><img src="dudi.png" border="0"></td>
			<td valign="bottom">	
			<form action="<? echo "$script"; ?>" method="POST">
			<input type="hidden" name="action" value="add">
			Enter account to disable:
			</td>
		</tr>
		<tr>
			<td valign="top">
			<input type="text" name="useracct" size="15">
			<input type="submit" value="submit">
			</td>
		</tr>
		<tr>
			<td colspan="2">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				Last account disabled
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
	<?
			$LastAccts = file('/home/www-data/log');
			print_r($LastAccts[0]);
	?>
			</td>
		</tr>
	</table>
	</center>
	<?
	}
?>

<body>
</html>
