<?php
	$newtopic = $_GET['new_topic'];
	$newcontent = $_GET['new_content'];

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
	$sql_add = "INSERT INTO `issue` (`topic`, `content`) VALUES ('$newtopic', '$newcontent')";
	if ($link->query($sql_add) === TRUE) {
		//select data
		$sql_select = "SELECT `content`, `topic`, `issue_id` FROM `issue` WHERE `topic` = '$newtopic'";
		$result = mysqli_query($link, $sql_select) or die(mysqli_error($link));

		$row = mysqli_fetch_assoc($result);
		echo "<td>";
			echo $row['issue_id'];
		echo "</td>";
		echo "<td>";
			echo "<a href='http://localhost/hw4/php/discussion_page?input=".$row['issue_id']."' >".$row['topic'];
		echo "</td>";
	} else {
		echo "Error: " . $sql_add . "<br>" . $link->error;
	}

?>