
<html>
<head>
<title><?php echo "Send me your Info";?></title>
</head>
<body>
<form action="http://localhost/phptest1.php" method="get">

<p>Name:
<input type="text" name="name" size="30" value="" />
</p>

<p>Address:
<input type="text" name="address" size="30" value="" />
</p>

<p>City:
<input type="text" name="city" size="25" value="" />
</p>

<p>State:
<input type="text" name="state" size="25" value="" />
</p>

<p>Guess a number from 1 to 10:
<input type="text" name="number" size="25" value="" />
</p>

<p>Cats, Dogs, or Fish?:
<input type="text" name="pet" size="25" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</body>
</html>