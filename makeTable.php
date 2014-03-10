<?php
	$dexNum = $item[ "Name" ];
	$pName = $item[ "Attributes" ][ "N" ];
	echo( "<table width=\"1000\" border=\"3\" cellpadding=\"8\" class=\"" . $item[ "Attributes" ][ "Type1" ] . "\">\n" );
	echo( "<tr><td colspan=\"8\"><b><font size=\"+2\">#" . substr( $dexNum, 1 ) . "</font></b></td></tr>\n" );
	echo( "<tr>\n" );
	echo( "<td colspan=\"8\"><b><font size=\"+4\">" . $pName . "</font></b>&nbsp;&nbsp;&nbsp;" . $item[ "Attributes" ][ "JapName" ] . "&nbsp;&nbsp;(<i>". $item[ "Attributes" ][ "RomanjiName" ] . "</i>)</td></tr>\n" );

	echo( "<tr>\n" );
	echo( "<td colspan=\"4\">\n" );
	echo( "<audio src=\"http://s3.amazonaws.com/SDBP/Cries1/" . $dexNum . ".ogg\" controls>\n" );
	echo( "Your browser does not support the <code>audio</code> element.\n" );
	echo( "</audio>\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );

	echo( "<tr>\n" );
	echo( "<td colspan=\"2\" width=\"375\" height=\"400\" align=\"center\">\n" );
	echo( "<img src=\"http://s3.amazonaws.com/SDBP/Default1/" . $dexNum . ".png\" alt=\"" . $pName .  "\" />\n" );
	echo( "</td>\n" );

	echo( "<td valign=\"top\" align=\"center\">\n" );
	echo( "<table width=\"600\" border=\"0\" cellpadding=\"5\" align=\"center\" class=\"none\">\n" );
	echo( "<tr>\n" );
	echo( "<th colspan=\"2\">Type</th> <th>Species</th> <th>Height</th> <th>Weight</th> <th>Catch Rate</th> <th>Abilities</th>\n" );
	echo( "</tr>\n" );
	echo( "<tr align=\"center\">\n" );
			
	if ( $item[ "Attributes" ][ "Type2" ] == "" )
	{
		echo( "<td colspan=\"2\">\n" );
		echo( "<img src=\"/images/type/" . $item[ "Attributes" ][ "Type1" ] . ".gif\" alt=\"" . $item[ "Attributes" ][ "Type1" ] .  "\" />\n" );
		echo( "</td>\n" );
	}
	else
	{
		echo( "<td>\n" );
		echo( "<img src=\"/images/type/" . $item[ "Attributes" ][ "Type1" ] . ".gif\" alt=\"" . $item[ "Attributes" ][ "Type1" ] .  "\" />\n" );
		echo( "</td> <td>\n" );
		echo( "<img src=\"/images/type/" . $item[ "Attributes" ][ "Type2" ] . ".gif\" alt=\"" . $item[ "Attributes" ][ "Type2" ] .  "\" />\n" );
		echo( "</td>\n" );
	}
				
	echo( "<td>" . $item[ "Attributes" ][ "Species" ] . "</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "Height" ] . "</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "Weight" ] . "</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "CatchRate" ] . "</td>\n" );
			
	echo( "<td>\n" );
	if ( is_array( $item[ "Attributes" ][ "Abilities" ] ) )
		foreach ( $item[ "Attributes" ][ "Abilities" ] as $i )
			echo( $i . "<br>\n" );
	else
		echo( $item[ "Attributes" ][ "Abilities" ] );
	echo( "</td>\n" );
			
	echo( "</tr>\n" );

	echo( "<tr><td colspan=\"8\">&nbsp;</td></tr>\n" );
	echo( "<tr>\n" );
	echo( "<th colspan=\"8\" align=\"left\">PokeDéx Entry</th>\n" );
	echo( "</tr>\n" );

	echo( "<tr>\n" );
	echo( "<td colspan=\"8\">" . $item[ "Attributes" ][ "DexEntry" ] . "</td>\n" );
	echo( "</tr>\n" );
			
	echo( "<tr><td colspan=\"8\">&nbsp;</td></tr>\n" );
	
	echo( "<tr align=\"center\">\n" );
	
	
	// Pokemon does NOT evolve and does NOT have a prior evolution (single/standalone)
	if ( $item[ "Attributes" ][ "Evolves" ] == "false" && $item[ "Attributes" ][ "evoPrev" ] == "" )
	{
		echo( "<td colspan=\"3\" valign=\"top\"> <b>Evolution Chain</b> <br><br><br>\n" );
		echo( "$pName does not evolve.<br>\n" );
		echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />\n" );
	}
	// Pokemon does NOT evolve but DOES have a prior evolution (final form)
	else if ( $item[ "Attributes" ][ "Evolves" ] == "false" && $item[ "Attributes" ][ "evoPrev" ] != "" )
	{
		echo( "<td colspan=\"4\" valign=\"top\"> <b>Evolution Chain</b> <br>\n" );
		echo( "<table align=\"center\" class=\"evo\"><br />\n" );
		echo( "<tr align=\"center\">\n" );
		echo( "<td>&nbsp;</td>\n" );
		$evoPrev = $item[ "Attributes" ][ "evoPrev" ];
		$r = $sdb->select( $domain, "select * from $domain where itemName() = '$evoPrev'" );
		if ( $r )
		{
			// Pokemon's prior evolution does NOT have a prior evolution (final form ->> first/basic form)
			if ( $r[ 0 ][ "Attributes" ][ "evoPrev" ] == "" )
			{
				echo( "<td>" );
				if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
				{
					if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
					else
					{
						foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
							if ( substr( $j, 0, 4 ) == $dexNum )
								echo( substr( $j, 4 ) );
					}
				}
				else
				{
					if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
					else
					{
						foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
							if ( substr( $j, 0, 4 ) == $dexNum )
								echo( substr( $j, 4 ) );
					}
				}
				echo( "</td>\n" );
				echo( "<td>&nbsp;</td>\n" );
				echo( "</tr>\n" );
				
				echo( "<tr align=\"center\">\n" );
				echo( "<td>" );
				echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
				echo( "</a>" );
				echo( "</td>\n" );
				echo( "<td> → </td>\n" );
			}
			// Pokemon's prior evolution DOES have a prior evolution ie. Venusaur -> Ivysaur -> Bulbasaur
			else
			{
				$evoPrev2 = $r[ 0 ][ "Attributes" ][ "evoPrev" ];
				$r2 = $sdb->select( $domain, "select * from $domain where itemName() = '$evoPrev2'" );
				if ( $r2 )
				{
					echo( "<td>" );
					if ( is_numeric( $r2[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $r2[ 0 ][ "Attributes" ][ "evoMethod" ] );
					else
						echo( $r2[ 0 ][ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "<td>" );
					if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
					{
						if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
							echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
						else
						{
							foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
								if ( substr( $j, 0, 4 ) == $dexNum )
									echo( substr( $j, 4 ) );
						}
					}	
					else
					{
						if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
							echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
						else
						{
							foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
								if ( substr( $j, 0, 4 ) == $dexNum )
									echo( substr( $j, 4 ) );
						}
					}
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
					
					echo( "<tr align=\"center\">\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
				}
				// error handling sprite
				else
				{
					echo( "<td>" );
					if ( is_numeric( $r2[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $r2[ 0 ][ "Attributes" ][ "evoMethod" ] );
					else
						echo( $r2[ 0 ][ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "<td>" );
					if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
					else
						echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
					
					echo( "<tr align=\"center\">\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $evoPrev2 . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
				}
			}
		}
		// error handling sprite
		else
		{
			echo( "<td>&nbsp;</td>\n" );
			echo( "<td>&nbsp;</td>\n" );
			echo( "</tr>\n" );
				
			echo( "<tr align=\"center\">\n" );
			echo( "<td>" );
			echo( "<a href=\"search.php?num=" . $evoPrev . "\">\n" );
			echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />\n" );
			echo( "</a>\n" );
			echo( "</td>\n" );
			echo( "<td> → </td>\n" );
		}
		
		echo( "<td>" );
		echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />\n" );
		echo( "</td>\n" );
		echo( "</tr>\n" );
		echo( "</table>\n" );
		
	}
	// Pokemon DOES evolve but does NOT have a prior evolution (first/basic form)
	else if ( $item[ "Attributes" ][ "Evolves" ] == "true" && $item[ "Attributes" ][ "evoPrev" ] == "" )
	{
		echo( "<td colspan=\"4\" valign=\"top\"> <b>Evolution Chain</b> <br>\n" );
		echo( "<table align=\"center\" class=\"evo\"><br />\n" );
		echo( "<tr align=\"center\">\n" );
		echo( "<td>&nbsp;</td>\n" );
		
		$evoNext = $item[ "Attributes" ][ "evoNext" ];
		$r = $sdb->select( $domain, "select * from $domain where itemName() = '$evoNext'" );
		if ( $r )
		{
//EEVEE   echo( "YAY!" );
			// Pokemon's evolved form does NOT have an evolved form
			if ( $r[ 0 ][ "Attributes" ][ "evoNext" ] == "" )
			{
				echo( "<td>" );
				if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
				{
					if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
					else
					{
						foreach ( $item[ "Attributes" ][ "evoMethod" ] as $j )
							if ( substr( $j, 0, 4 ) == $dexNum )
								echo( substr( $j, 4 ) );
					}
				}
				else
				{
					if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
						echo( $item[ "Attributes" ][ "evoMethod" ] );
					else
					{
						foreach ( $item[ "Attributes" ][ "evoMethod" ] as $j )
							if ( substr( $j, 0, 4 ) == $dexNum )
								echo( substr( $j, 4 ) );
					}
				}
				echo( "</td>\n" );
				echo( "<td>&nbsp;</td>\n" );
				echo( "</tr>\n" );
		
				echo( "<tr align=\"center\">\n" );
				echo( "<td>" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
				echo( "</td>\n" );
				echo( "<td> → </td>\n" );
				echo( "<td>" );
				echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
				echo( "</a>" );
				echo( "</td>" );
				
			}
			// Pokemon's evolved form DOES have an evolved form ie. Charmander -> Charmeleon -> Charizard
			else
			{
				$evoNext2 = $r[ 0 ][ "Attributes" ][ "evoNext" ];
				$r2 = $sdb->select( $domain, "select * from $domain where itemName() = '$evoNext2'" );
				if ( $r2 )
				{
					echo( "<td>" );
					if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
						echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
					else
						echo( $item[ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "<td>" );
					if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
					{
						if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						{
							echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
							echo( "</td>\n" );
							echo( "<td>&nbsp;</td>\n" );
							echo( "</tr>\n" );
					
							echo( "<tr align=\"center\">\n" );
							echo( "<td>" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
							echo( "</td>\n" );
							echo( "<td> → </td>\n" );
							echo( "<td>" );
							echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
							echo( "</a>" );
							echo( "</td>\n" );
							echo( "<td> → </td>\n" );
							echo( "<td>" );
							echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
							echo( "</a>" );
							echo( "</td>\n" );
						}
						else
						{
							foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
							{
								if ( substr( $j, 0, 4 ) == $r2[ 0 ][ "Name" ] )
								{
									echo( substr( $j, 4 ) );
									echo( "</td>\n" );
					
									echo( "<td>&nbsp;</td>\n" );
									echo( "</tr>\n" );
					
									echo( "<tr align=\"center\">\n" );
									echo( "<td>" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
									echo( "</td>\n" );
									echo( "<td> → </td>\n" );
									echo( "<td>" );
									echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
									echo( "</a>" );
									echo( "</td>\n" );
									echo( "<td> → </td>\n" );
									echo( "<td>" );
									echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
									echo( "</a>" );
									echo( "</td>\n" );
									
									foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $k ) // for Gloom -> Vileplume/Bellosom evolutions
									{
										if ( substr( $k, 0, 4 ) != $r2[ 0 ][ "Name" ] )
										{
											echo( "</tr>\n" );
											
											echo( "<tr align=\"center\"\n" );
											echo( "<td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td>\n" );
											echo( "<td>" );
											echo( substr( $k, 4 ) );
											echo( "</td>\n" );
										}
									}
									
								}
							}
						}
					}	
					else
					{
						if ( !is_array( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
						{
							echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
							echo( "</td>\n" );
							echo( "<td>&nbsp;</td>\n" );
							echo( "</tr>\n" );
					
							echo( "<tr align=\"center\">\n" );
							echo( "<td>" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
							echo( "</td>\n" );
							echo( "<td> → </td>\n" );
							echo( "<td>" );
							echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
							echo( "</a>" );
							echo( "</td>\n" );
							echo( "<td> → </td>\n" );
							echo( "<td>" );
							echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
							echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
							echo( "</a>" );
							echo( "</td>\n" );
						}
						else
						{
							foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
							{
								if ( substr( $j, 0, 4 ) == $r2[ 0 ][ "Name" ] )
								{
									echo( substr( $j, 4 ) );
									echo( "</td>\n" );
					
									echo( "<td>&nbsp;</td>\n" );
									echo( "</tr>\n" );
					
									echo( "<tr align=\"center\">\n" );
									echo( "<td>" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
									echo( "</td>\n" );
									echo( "<td> → </td>\n" );
									echo( "<td>" );
									echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
									echo( "</a>" );
									echo( "</td>\n" );
									echo( "<td> → </td>\n" );
									echo( "<td>" );
									echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
									echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
									echo( "</a>" );
									echo( "</td>\n" );
									
									foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $k ) // for Gloom -> Vileplume/Bellosom evolutions
									{
										if ( substr( $k, 0, 4 ) != $r2[ 0 ][ "Name" ] )
										{
											echo( "</tr>\n" );
											
											echo( "<tr align=\"center\"\n" );
											echo( "<td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td>\n" );
											echo( "<td>" );
											echo( substr( $k, 4 ) );
											echo( "</td>\n" );
										}
									}
									
								}
							}
						}
					}
					
					
				}
				// error handling sprite
				else
				{
					echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
				
					echo( "<tr align=\"center\">\n" );
					echo( "<td>" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $evoNext2 . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
				}
			}
		}
		// error handling sprite
		else
		{
			echo( "<td>" );
			if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
			{
				if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
					echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
				else
				{
					foreach ( $item[ "Attributes" ][ "evoMethod" ] as $j )
						if ( substr( $j, 0, 4 ) == $dexNum )
							echo( substr( $j, 4 ) );
				}
			}
			else
			{
				if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
					echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
				else
				{
					foreach ( $item[ "Attributes" ][ "evoMethod" ] as $j )
						if ( substr( $j, 0, 4 ) == $dexNum )
							echo( substr( $j, 4 ) );
				}
			}
			echo( "</td>\n" );
			echo( "<td>&nbsp;</td>\n" );
			echo( "</tr>\n" );
		
			echo( "<tr>\n" );
			echo( "<td>" );
			echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
			echo( "</td>\n" );
				
			echo( "<td> → </td>\n" );
			echo( "<td>" );
			echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
			echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />\n" );
			echo( "</a>" );
			echo( "</td>" );
			
		}
		
		echo( "</tr>\n" );
		echo( "</table>\n" );
		
	}
	// Pokemon DOES evolve and DOES have a prior evolution (middle form)
	else if ( $item[ "Attributes" ][ "Evolves" ] == "true" && $item[ "Attributes" ][ "evoPrev" ] != "" )
	{
		echo( "<td colspan=\"4\" valign=\"top\"> <b>Evolution Chain</b> <br>\n" );
		echo( "<table align=\"center\" class=\"evo\"> <br>\n" );
		echo( "<tr align=\"center\">\n" );
		echo( "<td>&nbsp;</td>\n" );
		
		$evoPrev = $item[ "Attributes" ][ "evoPrev" ];
		$r = $sdb->select( $domain, "select * from $domain where itemName() = '$evoPrev'" );
		
		$evoNext = $item[ "Attributes" ][ "evoNext" ];
		$r2 = $sdb->select( $domain, "select * from $domain where itemName() = '$evoNext'" );
		
		if ( $r )
		{
			if ( $r2 )
			{
				echo( "<td>" );
				if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
					echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
				else
					echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
				echo( "</td>\n" );
				echo( "<td>&nbsp;</td>\n" );
				
				if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
				{
					echo( "<td>" );
					echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
					
					echo( "<tr align=\"center\">\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
				}
				else
				{
					if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
					{
						echo( "<td>" );
						echo( $item[ "Attributes" ][ "evoMethod" ] );
						echo( "</td>\n" );
						echo( "<td>&nbsp;</td>\n" );
						echo( "</tr>\n" );
				
						echo( "<tr align=\"center\">\n" );
						
						echo( "<td>" );
						echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
						echo( "</a>" );
						echo( "</td>\n" );
						echo( "<td> → </td>\n" );
						echo( "<td>" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
						echo( "</td>\n" );
						echo( "<td> → </td>\n" );
						echo( "<td>" );
						echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
						echo( "</a>" );
						echo( "</td>\n" );
					}
					else // needs testing with actual database entries
					{
						foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $j )
						{
							if ( substr( $j, 0, 4 ) == $r2[ 0 ][ "Name" ] )
							{
								echo( substr( $j, 4 ) );
								echo( "</td>\n" );
				
								echo( "<td>&nbsp;</td>\n" );
								echo( "</tr>\n" );
				
								echo( "<tr align=\"center\">\n" );
								
								echo( "<td>" );
								echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
								echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
								echo( "</a>" );
								echo( "</td>\n" );
								echo( "<td> → </td>\n" );
								echo( "<td>" );
								echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
								echo( "</td>\n" );
								echo( "<td> → </td>\n" );
								echo( "<td>" );
								echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
								echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
								echo( "</a>" );
								echo( "</td>\n" );
								
								foreach ( $r[ 0 ][ "Attributes" ][ "evoMethod" ] as $k ) // for Gloom -> Vileplume/Bellosom evolutions
								{
									if ( substr( $k, 0, 4 ) != $r2[ 0 ][ "Name" ] )
									{
										echo( "</tr>\n" );
										
										echo( "<tr align=\"center\"\n" );
										echo( "<td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td>\n" );
										echo( "<td>" );
										echo( substr( $k, 4 ) );
										echo( "</td>\n" );
										echo( "</tr>\n" );
										
										echo( "<tr align=\"center\"\n" );
										echo( "<td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td>\n" );
										echo( "<td> → </td>\n" );
										echo( "<td>" );
										echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
										echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r2[ 0 ][ "Name" ] . ".png\" alt=\"" . $r2[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
										echo( "</a>" );
										echo( "</td>\n" );
									}
								}
								
							}
						}
					}
				}
				
			}
			// error handling sprite
			else
			{
				echo( "<td>" );
				if ( is_numeric( $r[ 0 ][ "Attributes" ][ "evoMethod" ] ) )
					echo( "Level " . $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
				else
					echo( $r[ 0 ][ "Attributes" ][ "evoMethod" ] );
				echo( "</td>\n" );
				echo( "<td>&nbsp;</td>\n" );
				
				if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
				{
					echo( "<td>" );
					echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
					
					echo( "<tr align=\"center\">\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
					echo( "</a>\n" );
					echo( "</td>\n" );
				}
				else
				{
					if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
					{
						echo( "<td>" );
						echo( $item[ "Attributes" ][ "evoMethod" ] );
						echo( "</td>\n" );
						echo( "<td>&nbsp;</td>\n" );
						echo( "</tr>\n" );
				
						echo( "<tr align=\"center\">\n" );
						echo( "<td>" );
						echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $r[ 0 ][ "Name" ] . ".png\" alt=\"" . $r[ 0 ][ "Attributes" ][ "N" ] . "\" />" );
						echo( "</a>" );
						echo( "</td>\n" );
						echo( "<td> → </td>\n" );
						echo( "<td>" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
						echo( "</td>\n" );
						echo( "<td> → </td>\n" );
						echo( "<td>" );
						echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
						echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
						echo( "</a>" );
						echo( "</td>\n" );
					}
				}
			}
		}
		else
		{
			echo( "<td>" );
			echo( "ERROR" );
			echo( "</td>\n" );
			echo( "<td>&nbsp;</td>\n" );
				
			if ( is_numeric( $item[ "Attributes" ][ "evoMethod" ] ) )
			{
				echo( "<td>" );
				echo( "Level " . $item[ "Attributes" ][ "evoMethod" ] );
				echo( "</td>\n" );
				echo( "<td>&nbsp;</td>\n" );
				echo( "</tr>\n" );
				
				echo( "<tr align=\"center\">\n" );
				echo( "<td>" );
				echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
				echo( "</a>\n" );
				echo( "</td>\n" );
				echo( "<td> → </td>\n" );
				echo( "<td>" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
				echo( "</td>\n" );
				echo( "<td> → </td>\n" );
				echo( "<td>" );
				echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
				echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
				echo( "</a>\n" );
				echo( "</td>\n" );
			}
			else
			{
				if ( !is_array( $item[ "Attributes" ][ "evoMethod" ] ) )
				{
					echo( "<td>" );
					echo( $item[ "Attributes" ][ "evoMethod" ] );
					echo( "</td>\n" );
					echo( "<td>&nbsp;</td>\n" );
					echo( "</tr>\n" );
			
					echo( "<tr align=\"center\">\n" );
					
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
					echo( "</a>" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />" );
					echo( "</td>\n" );
					echo( "<td> → </td>\n" );
					echo( "<td>" );
					echo( "<a href=\"search.php?num=" . $r2[ 0 ][ "Name" ] . "\">" );
					echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/0000.png\" alt=\"ERROR\" />" );
					echo( "</a>" );
					echo( "</td>\n" );
				}
			}
		}
		
		echo( "</tr>\n" );
		echo( "</table>\n" );
			
			
			
			
		
	}
			
			
	echo( "</td>\n" );


	echo( "<td align=\"center\" colspan=\"4\"><b>Stats</b><br />\n" );
	
	echo( "<table align=\"center\" class=\"stats\"><br />\n" );

	echo( "<tr>\n" );
	echo( "<td>HP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "HP" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$HPcount = floor( intval( $item[ "Attributes" ][ "HP" ] ) / 10 );
	for ( $i = 0; $i < $HPcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>Attack:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "AT" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$ATcount = floor( intval( $item[ "Attributes" ][ "AT" ] ) / 10 );
	for ( $i = 0; $i < $ATcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>Defense:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "DE" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$DEcount = floor( intval( $item[ "Attributes" ][ "DE" ] ) / 10 );
	for ( $i = 0; $i < $DEcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>Sp.Atk:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "SA" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$SAcount = floor( intval( $item[ "Attributes" ][ "SA" ] ) / 10 );
	for ( $i = 0; $i < $SAcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>Sp.Def:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "SD" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$SDcount = floor( intval( $item[ "Attributes" ][ "SD" ] ) / 10 );
	for ( $i = 0; $i < $SDcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>Speed:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "SP" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$SPcount = floor( intval( $item[ "Attributes" ][ "SP" ] ) / 10 );
	for ( $i = 0; $i < $SPcount; $i++ )
		echo( "*" );
	echo( "<br />\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );
	
	echo( "<tr>\n" );
	echo( "<td>TOTAL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>\n" );
	echo( "<td>" . $item[ "Attributes" ][ "BaseStatTotal" ] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>" );
	echo( "<td align=\"left\">" );
	$BTcount = floor( intval( $item[ "Attributes" ][ "BaseStatTotal" ] ) / 100 );
	for ( $i = 0; $i < $BTcount; $i++ )
		echo( "☆" );
	echo( "</td>\n" );
	echo( "</tr>\n" );

	echo( "</table>\n" );
	echo( "</td>\n" );
	

	echo( "</tr>\n" );
	

	echo( "</table>\n" );
	echo( "</td>\n" );
	echo( "</tr>\n" );

	echo( "<tr>\n" );
	echo( "<td align=\"center\" width=\"200\" height=\"100\">\n" );
	echo( "<img src=\"http://s3.amazonaws.com/SDBP/Sprite1/" . $dexNum . ".gif\" alt=\"" . $pName . "\" />\n" );
	echo( "</td>\n" );
	echo( "<td align=\"center\" width=\"175\" height=\"100\">\n" );
	echo( "<img src=\"http://s3.amazonaws.com/SDBP/miniSprite1/" . $dexNum . ".png\" alt=\"" . $pName . "\" />\n" );
	echo( "</td>\n" );
			
	echo( "<td>\n" );
	echo( "<b>Moves</b><br />\n" );
			
	if ( is_array( $item[ "Attributes" ][ "Moves" ] ) )
	{
		$result = "";
		foreach ( $item[ "Attributes" ][ "Moves" ] as $i )
			$result .= "$i, ";
		echo rtrim( $result, ", \n" );
	}
	else
	echo( $item[ "Attributes" ][ "Moves" ] );

	echo( "</td>\n" );
	echo( "</tr>\n" );
	echo( "</table>\n" );
	echo( "<br><br><a href=\"#top\">^ Back to Top ^</a>\n" );
	echo( "<br><br><br><br><br><br><br><br><br>\n" );
?>