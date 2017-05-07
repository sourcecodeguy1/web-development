<?php
$title = "DDR Guy - Search Friends";
?>
<?php require("./top.php"); ?>

<?php
	$categories = "<option value='0'>Lastname</option>
		       <option value='1'>username</option>";
	
	$form = "<form action='$site/search_friends' method='post'>
			 <table>
			 <tr>
					<td>Search Friends By:</td>
					<td><select name='search_select'>
						<option>Select</option>
						$categories
					</select></td>
					<td><input type='text' name='search_box' style='' /></td>
					<td><input type='submit' name='searchbtn' value='Search' class='button' /></td>
			 </tr>
			 </table>
			</form>";
			
			if($_POST['searchbtn']){
				$search_select = $_POST['search_select'];
				$search_box = $_POST['search_box'];
			  if ($search_box){
				if (strstr($categories, "$search_select")){
					if($search_select == 0){
						if($search_box){
						//Connect to the database.
						require("connect.php");
						$query = mysqli_query($con,"SELECT * FROM users WHERE lastname='".$search_box."'");
						$numrows = mysqli_num_rows($query);
						if($numrows == 1){
						$row = mysqli_fetch_assoc($query);
						$dbid = $row['id'];
						$dbusername = $row['username'];
						$result = "<a href='$site/profile?id=$dbid' style='font-size: 22px;'>$dbusername</a>";
						$result2 = "<hr />";
						$div = "<center><div style='font-size: 22px;'><b>Your Result</b></div></center>";
						}
						else
							$result = "<b>$search_box</b> was not found!";
							}
							else
								echo "Please enter a lastname.";
					}
					elseif($search_select == 1){
						//Connect to the database.
						require("connect.php");
						$query1 = mysqli_query($con,"SELECT * FROM users WHERE username='".$search_box."'");
						$numrows1 = mysqli_num_rows($query1);
						if($numrows1 == 1){
						$row1 = mysqli_fetch_assoc($query1);
						$dbid1 = $row1['id'];
						$dbusername1 = $row1['username'];
						$result = "<a href='$site/profile?id=$dbid1' style='font-size: 22px;'>$dbusername1</a>";
						$result2 = "<hr />";
						$div = "<center><div style='font-size: 22px;'><b>Your Result</b></div></center>";
						//http://sangabrielvalley.backpage.com/FemaleEscorts/very-tight-bubble-butt-redhead-tiny-waist-highly-reviewed/77684537
						}
						else
							$result = "<b>$search_box</b> was not found!";
                            mysqli_close($con);
					}
				}
				else
					echo "Please select an option.";
			}
			else
				echo "<div style='color: red;'>You did not enter a name or email to search.</div>";
			}
			
			echo $form;
			echo $result2;
			echo $div;
			echo $result;
?>
<div class='clear'>
	
	<?php require("bottom.php");?>
	</div>