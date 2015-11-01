<!Doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>forum</title>
		<script type="text/javascript" src="jquery-2.1.4.js" ></script>
		<script>
			var add_forum = function(){
				console.log($('#topic').val());
				$.ajax({
				url:'ajax_forum.php',
				type:'GET',
				data:{
					new_topic: $('#topic').val(),
					new_content: $('#content').val(),
				},
				dataType:'text',
				success: function(response){
					$('.new_forum').html(response);
					$('.new_forum').fadeIn();
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
		<?php 
			// header("Content-Type:text/html; charset=utf-8");
			// $query = $_GET['search_Input'];

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

			// select data
			$sql = "SELECT `topic`, `issue_id` FROM `issue` ";
			$result = mysqli_query($link, $sql) or die(mysqli_error($link));

			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				echo "<div class='resultForm'>";
					echo "<table style='border:3px solid; padding:5px'; rules='all' cellpadding='5'>";
					echo "<tr align='center'>
						<td colspan='2' bgcolor='#FFDAB9'>討論區</td>
					</tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr bgcolor='#FFEFD5'>";
							echo "<td>";
								echo $row["issue_id"];
							echo "</td>";
							echo "<th>";
								echo "<a href='http://localhost/hw4/php/discussion_page?input=".$row['issue_id']."' >". $row["topic"];
							echo "</th>";
						echo "</tr>";
				}
			} else {
				echo "<tr>
						<td colspan='2'>
							No issues
						</td>
					</tr>";
			}
			echo "<tr class='new_forum' bgcolor='#FFEFD5'></tr>";
				echo "<tr align='center'>
						<td colspan='2' bgcolor='#DDDDDD'>
							新增討論主題
						</td>
					</tr>";
				echo "<tr align='center'>
						<td colspan='2'>
							<form>
								<input type='text' placeholder='標題' id='topic'></input><br/>
								<textarea rows='4' cols='50' placeholder='內文' id='content'></textarea><br/>
								<input type='button' value='送出' onClick='add_forum()'></input>
							</form>
						</td>
					</tr>";
				echo "</table>";
				echo "<p><a href='http://localhost/hw4/php/index.php?slo' >Logout</a></p>";
				echo "</div>";
		?>
	</body>
</html>