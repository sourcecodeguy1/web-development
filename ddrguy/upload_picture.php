    <?php require("./top.php");?>
        <div id="full">
        <?php
        if($username){
        require("connect.php");
        $query = mysqli_query($con, "SELECT * FROM users WHERE id='".$userid."'");
        $numrows = mysqli_num_rows($query);
        if($numrows == 1){
        $row = mysqli_fetch_assoc($query);
        $databaseID = $row['id'];
        $databaseUsername = $row['username'];
		
        mysqli_query($con, "UPDATE users SET first_login='0' WHERE id='".$databaseID."'");
            
        $form = "<center><div id='ack' style='color: red'></div></center>
                <form id='frmuploadpic' action='process_picture' method='post' enctype='multipart/form-data'>
                
                 <center><table>
                 <tr>
                    <td>Upload a picture, <b>$databaseUsername</b></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td><input id='avatar' type='file' name='avatar' /></td>
                    <td></td>
                 </tr>
                    <td><input id='btnsubmit' type='submit' name='btnsubmit' /></td>
                    <td></td>
                 </tr>
                 <tr>
                    <td></td>
                    <td><a href='$site/profile?id=$databaseID'>Maybe later...</a></td>
                 </tr>
                 </table></center>
                </form>";
                
                echo $form;
        }
        else
            echo "No user found!!!";
        }
        else
            echo "You must be logged in.";
        ?>
        </div>
    <?php require("./bottom.php");?>
