<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>discussion_page</title>
	<script type="text/javascript" src="jquery-2.1.4.js" ></script>
	<script>
		var add_disc = function(){
			// console.log($('.issue_id').text());
			$.ajax({
				url:'ajax_discuss.php',
				type:'GET',
				data:{
					new_disc: $('#newdisc').val(),
					issue_id: $('.issueid').text(),
				},
				dataType:'text',
				success: function(response){
					$('.new_discussions').html(response);
					$('.new_discussions').fadeIn();
				},
				error:function(xhr, ajaxOptions, thrownError){ 
                   	alert(xhr.status); 
                   	alert(thrownError); 
               	},
			});
		}
	</script>
</head>
<body>
	<div>
		<table style="border:3px solid; padding:5px"; rules="all" cellpadding="5">
			<tr>
				<?php
					$id=$_GET['input'];

					//connect to DB
					$servername="localhost";
					// $dbhost="192.168.0.108";
					$username="root";
					$password="secure1234";
					$dbname="forum";

					$link = new mysqli($servername,$username,$password,$dbname);
					if (!$link) {
						die("Connection failed: " . mysqli_connect_error());
					}

					mysqli_set_charset($link,"utf8");

					$sqli2 = "SELECT `issue_id`, `content` FROM `issue` WHERE `issue_id` = '$id' ";
					$result2 = mysqli_query($link, $sqli2) or die(mysqli_error($link));
					$row = mysqli_fetch_assoc($result2);

					echo "<th colspan='2' class='issueid' bgcolor='#FFDAB9'>".$row["issue_id"]."</th>";
					echo "<tr bgcolor='#FFEFD5'>";
						echo "<td colspan='2'>";
							echo $row["content"];
						echo "</td>";
					echo "</tr>";

					//select data
					$sqli = "SELECT `disc_id`, `disc_content`FROM `discussion` WHERE `issue_id` = '$id'";
					$result = mysqli_query($link, $sqli) or die(mysqli_error($link));

					// output data of each row
					echo "<tr bgcolor='#DCDCDC'>";
						echo "<th colspan='2'>";
							echo "留言";
						echo "</th>";
					echo "</tr>";
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)) {
							echo "<tr bgcolor='#F5F5F5'>";
								echo "<td>";
									echo $row['disc_id'];
								echo "</td>";
								echo "<td>";
									echo $row["disc_content"];
								echo "</td>";
							echo "</tr>";
						}
					} else{
						echo "<tr bgcolor='#F5F5F5'>
							<td colspan='2'>
								No discussions.
							</td>
						</tr>";
					}
				?>
				<tr class="new_discussions" bgcolor='#F5F5F5'></tr>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<form>
						<textarea id="newdisc" rows="4" cols="50" placeholder="輸入留言內容"></textarea>
						<div><input type="button" value="留言" onClick="add_disc()"></input><div>
					</form>
			</tr>
		</table>
		<p><a href="http://localhost/hw4/php/index.php?slo" >Logout</a></p>
	</div>
</body>
</html>