<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles.css" />
<title>SimpleDB Pokédex :: Search Results</title>
</head>

<body id="top">
<br>
<center>
<a href="index.php">
<img src="images/SDBP.png" alt="SimpleDB Pokédex"/>
</a>
<br />

<?php
	if ( !class_exists( 'SimpleDB' ) )
		require_once( 'sdb.php' );
		
	$sdb = new SimpleDB( "AKIAIXPBZQZY5T2Z4NWQ", "Dq+CaWL50CxL+ccBnV8C/zo4C0G2clk/2rYp/4xL" );
	$domain = "Dex";
	$limit = 20;
	if ( $_POST[ "name" ] != null )
	{
		$name = $_POST[ "name" ];
		$name = ucfirst( $name );	// capitalize first letter
		echo( "<h2>List Pokémon by name beginning with \"$name\".</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where N LIKE '$name%' or RomanjiName LIKE '$name%' or JapName LIKE '$name%' INTERSECTION itemName() IS NOT NULL ORDER BY itemName()" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "num" ] != null )
	{
		$num = $_POST[ "num" ];
		$num = str_pad( $num, 4, "0", STR_PAD_LEFT );
		echo( "<h2>List Pokémon by National Pokédex #$num.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where itemName() = '$num'" );
		echo( count( $rest ) . " result shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "type" ] != null )
	{
		$type = $_POST[ "type" ];
		echo( "<h2>List by $type type Pokémon.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where Type1 = '$type' or Type2 = '$type' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "species" ] != null )
	{
		$sp = $_POST[ "species" ];
		$sp = ucfirst( $sp );	// capitalize first letter
		echo( "<h2>List by \"$sp\" species Pokémon.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where Species LIKE '$sp%' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "evo" ] != null )
	{
		echo( "<h2>List by Pokémon that don't evolve (in their final form).</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where Evolves = 'false' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "move" ] != null )
	{
		$move = $_POST[ "move" ];
		$move = ucfirst( $move );	// capitalize first letter
		echo( "<h2>List by Pokémon that have a Move beginning with \"$move\".</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where Moves LIKE '$move%' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "abilities" ] != null )
	{
		$ab = $_POST[ "abilities" ];
		$ab = ucfirst( $ab );	// capitalize first letter
		echo( "<h2>List by Pokémon that have an Ability beginning with \"$ab\".</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where Abilities LIKE '$ab%' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "cr" ] != null )
	{
		$cr = $_POST[ "cr" ];
		echo( "<h2>List by Pokémon that have a Catch Rate of $cr.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where CatchRate = '$cr' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "bst" ] != null )
	{
		$bst = $_POST[ "bst" ];
		echo( "<h2>List by Pokémon that have a Base Stat Total of $bst.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where BaseStatTotal = '$bst' INTERSECTION itemName() IS NOT NULL ORDER BY itemName() limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "ALL" ] != null )
	{
		echo( "<h2>List by ALL Pokémon by National Pokédex number.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain limit $limit" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_GET[ "num" ] != null )
	{
		$num = $_GET[ "num" ];
		$num = str_pad( $num, 4, "0", STR_PAD_LEFT );
		echo( "<h2>List Pokémon by National Pokédex #$num.</h2>\n" );
		$rest = $sdb->select( $domain, "select * from $domain where itemName() = '$num'" );
		echo( count( $rest ) . " result shown.<br><br><br><br><br><br><br>\n" );
	}
	else if ( $_POST[ "next" ] != null )
	{
		$rest = $_POST[ "next" ];
		echo( "<h2>List by ALL Pokémon by National Pokédex number (CONTINUED).</h2>\n" );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
		
		
		/*$next = $_POST[ "next" ];
		$l = $limit + $next;
		$r = $sdb->select( $domain, "select * from $domain limit $l" );
		$rest = $sdb->select( $domain, "select * from $domain limit $limit", $sdb->NextToken );
		echo( count( $rest ) . " result(s) shown.<br><br><br><br><br><br><br>\n" );
		$next += $limit;*/
	}
	else
	{
		echo( "ERROR, no search parameter specified!<br><br>\n" );
		echo( "<img src=\"images/OakWantsToFight.png\" alt=\"Professor Oak wants to fight!\"/><br><br><br>\n" );
		die( "Please try again~!<br><br>\n" );
	}
	
	
	if ( $rest )
	{
		foreach ( $rest as $item )
			include 'makeTable.php';
			
		
		/*$select_expression = "select * from $domain limit $limit";
		$next_token = null;
		do
		{
    		if ( $next_token )
    		{
        		$response = $sdb->select( $domain, $select_expression, array( 'NextToken' => $next_token, ) );
    		}
   			else
    		{
        		$response = $sdb->select( $domain, $select_expression );
    		}
 
 
    		// ...Store data!
			foreach ( $response as $item )
				include 'makeTable.php';
			
 
		    $next_token = isset( $response->body->SelectResult->NextToken )
        	? (string) $response->body->SelectResult->NextToken
	        : null;
		}
		while ( $next_token );*/
			
		
		/*if ( $_POST[ "next" ] != null )
		{
			echo( "<br><br><form method=\"POST\" action=\"search.php\">\n" );
			echo( "<input type=\"hidden\" name=\"next\" value=\"" . $next . "\" />\n" );
			echo( "<input type=\"submit\" value=\"-> More Results\" />\n" );
			echo( "</form><br><br><br><br>\n" );
		}*/
		
		/*if ( $sdb->NextToken )
		{
			$nt = $sdb->select( $domain, "select * from $domain limit $limit", $sdb->NextToken );
			
			foreach ( $nt as $i )
				include 'makeTable.php';
				
			// create for next results and submit "next" POST variable
			echo( "<form method=\"POST\" action=\"search.php\">" );
			echo( "<input type=\"hidden\" name=\"next\" value=\"{$nt}\" />" );
			echo( "<br><input type=\"submit\" value=\"-> More Results... ->\" />" );
			echo( "</form>" );
		}*/
		
		echo( "<pre>\n" );
		echo( "RequestId: " . $sdb->RequestId . "<br>" );
		echo( "BoxUsage: " . $sdb->BoxUsage . "<br>" );
		echo( "NextToken: " . $sdb->NextToken . "<br>" );
		echo( "</pre>\n" );
	}
	else
	{
		echo( "Listing FAILED!<br><br>\n");
		echo( "<img src=\"images/MISSINGNO.png\" alt=\"Wild MISSINGNO. appeared!\"/><br><br><br>\n" );
		echo( "Please try again with a different search parameter!<br><br>\n" );
	}
?>


</center>
</body>
</html>
