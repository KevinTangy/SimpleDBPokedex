<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles.css" />
<title>SimpleDB Pokédex</title>
</head>

<body>
<br>
<center>
<a href="index.php">
<img src="images/SDBP.png" alt="SimpleDB Pokédex"/>
</a>
<br>
<?php
	echo( "<table align=\"center\" height=\"120\" cellspacing=\"12\">\n" );
	echo( "<tr>\n" );
	$random = range( 1, 649 );
	shuffle( $random );
	for ( $i = 0; $i < 7; $i++ )
	{	
		echo( "<td width=\"14.285714285714285714285714285714%\" align=\"center\">\n" );
		if ( $i != 3 )
		{
			$r = str_pad( $random[ $i ], 4, "0", STR_PAD_LEFT );
			echo( "<a href=\"search.php?num=" . $r . "\">" );
			echo( "<img src=\"http://s3.amazonaws.com/SDBP/Sprite1/" . $r . ".gif\" alt=\"" . $r . "\"/>" );
			echo( "</a>\n" );
		}
		else
		{
			echo( "<a href=\"index.php\">\n" );
			echo( "<img src=\"/images/pokedex.png\" alt=\"Pokédex\"/>\n" );
			echo( "</a>\n" );
		}
		echo( "</td>\n" );
	}
	echo( "</tr>\n" );
	echo( "</table>\n" );
?>

<br>

<table align="center" cellpadding="5" cellspacing="15">
<tr align="center">
<td>
Search for Pokémon by Name:<br>
<form method="POST" action="search.php">
<input type="text" name="name" />
<br><input type="submit" value="Submit" />
</form>
</td>

<td>
Search for Pokémon by National Pokédex number:<br>
<form method="POST" action="search.php">
<input type="text" name="num" />
<br><input type="submit" value="Submit" />
</form>
</td>

<td>
Search for Pokémon by Type:<br>
<form method="POST" action="search.php">
<select name="type">
<option value="" selected="selected" disabled="disabled">Choose a type</option>
<option value="Grass">Grass</option>
<option value="Fire">Fire</option>
<option value="Water">Water</option>
<option value="Flying">Flying</option>
<option value="Poison">Poison</option>
<option value="Bug">Bug</option>
<option value="Electric">Electric</option>
<option value="Ground">Ground</option>
<option value="Normal">Normal</option>
<option value="Fighting">Fighting</option>
<option value="Psychic">Psychic</option>
<option value="Rock">Rock</option>
<option value="Steel">Steel</option>
<option value="Ice">Ice</option>
<option value="Ghost">Ghost</option>
<option value="Dragon">Dragon</option>
<option value="Dark">Dark</option>
</select>
<br><input type="submit" value="Submit">
</form>
</td>

<td>
Search for Pokémon by Species:<br>
<form method="POST" action="search.php">
<input type="text" name="species" />
<br><input type="submit" value="Submit" />
</form>
</td>
</tr>

<tr align="center">
<td>
Search for Pokémon by Moves:<br>
<form method="POST" action="search.php">
<input type="text" name="move" />
<br><input type="submit" value="Submit" />
</form>
</td>

<td>
Search for Pokémon by Abilities:<br>
<form method="POST" action="search.php">
<input type="text" name="abilities" />
<br><input type="submit" value="Submit" />
</form>
</td>

<td>
Search for Pokémon by Catch Rate:<br>
<form method="POST" action="search.php">
<input type="text" name="cr" />
<br><input type="submit" value="Submit" />
</form>
</td>

<td>
Search for Pokémon by Base Stat Total:<br>
<form method="POST" action="search.php">
<input type="text" name="bst" />
<br><input type="submit" value="Submit" />
</form>
</td>
</tr>

<tr><td colspan=\"8\">&nbsp;</td></tr>

<tr align="center">
<td colspan="8">
<form method="POST" action="search.php">
<input type="submit" name="evo" value="Search for Pokémon that don't evolve (in their final form)" />
</form>
</td>
</tr>

<tr align="center">
<td colspan="8">
<form method="POST" action="search.php">
<input name="ALL" type="submit" value="List ALL Pokémon by National Pokédex Number" />
</form>
</td>
</tr>

</table>


<br /><br /><br /><br /><br /><br /><br /><br />

<font size="-1">This site does not work well in IE.  Tested with the latest versions of Mozilla Firefox and WebKit based browsers.
<br>If you're using Chrome, please download and install this <a href="https://chrome.google.com/webstore/detail/ehkepjiconegkhpodgoaeamnpckdbblp">extension</a> for animated PNG support.</font>
<br />
<font size="-3">I do not own Pokémon.  Please do not sue me.</font>
<br /><br />

</center>
</body>
</html>