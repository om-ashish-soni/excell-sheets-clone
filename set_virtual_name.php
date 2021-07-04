$link=mysqli_connect("localhost","root","",$username);
            $sql="UPDATE table_list SET virtual_name='$filename' WHERE actual_name='$current_sheet'";
            if($link->query($sql)){
                echo "<script>alert('updated virtual_name from $current_sheet to $filename');</script>";
                $_SESSION['virtual_name']=$filename;
            }
            else{
                echo "<script>alert('sorry cant update virtual_name');</script>";

            }