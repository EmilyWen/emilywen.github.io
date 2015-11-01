<?php
	$newdisc = $_GET['new_disc'];
	$issueid = $_GET['issue_id'];

	$servername="localhost";
	$username="root";
	$password="secure1234";
	$dbname="forum";

	$link = new mysqli($severname,$username,$password,$dbname);
	if (!$link) {
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($link,"utf8");

	// insert data
	$sql_add = "INSERT INTO `discussion` (`issue_id`, `disc_content`) VALUES ('$issueid', '$newdisc')";
	if ($link->query($sql_add) === TRUE) {
		//select data
		$sql_select = "SELECT `disc_content`, `disc_id` FROM `discussion` WHERE `disc_content` = '$newdisc'";
		$result = mysqli_query($link, $sql_select) or die(mysqli_error($link));

		$row = mysqli_fetch_assoc($result);
		echo "<td>";
			echo $row['disc_id'];
		echo "</td>";
		echo "<td>";
			echo $row['disc_content'];
		echo "</td>";
	} else {
		echo "Error: " . $sql_add . "<br>" . $link->error;
	}

?>