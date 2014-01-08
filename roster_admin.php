<?php 

	$pnum = strip_tags($_POST['suvbc_number']);
	$pname = strip_tags($_POST['suvbc_name']);
	$ppos = strip_tags($_POST['suvbc_pos']);
	$pyear = strip_tags($_POST['suvbc_year']);
	$pht = strip_tags($_POST['suvbc_ht']);
	$pimg = strip_tags($_POST['suvbc_img']);
	$pbio = strip_tags($_POST['suvbc_bio']);

	$connect = mysqli_connect( "128.230.171.245", "msbrandt", "msbrandt2071", 'msbrandt');

	if( mysqli_connect_errno()){
		echo "unable to connect to MYSQL" . mysqli_connect_error();
	}

	$thisSQL = "INSERT INTO wp_suvbc_Roster (player_number, player_name, player_position, player_year, player_hometown, player_img, player_bio) 
							VALUES ( '$pnum', '$pname', '$ppos', '$pyear', '$pht', '$pimg', '$pbio' )";

	if (!mysqli_query($connect,$thisSQL)){

		die('Error: ' . mysqli_error($connect));
	}
	print 'player added!';
	mysqli_close($connect);
	// try echoing $_post to table 

?>
