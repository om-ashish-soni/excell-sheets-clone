<?php
session_start();
if(isset($_POST['username']) && !empty($_POST['username'])){
    $username=$_POST['username'];
    echo "<script>alert('logged in $username')</script>";
    $_SESSION['username']=$username;
    $link=mysqli_connect("localhost","root","",$username);
    if($link->connect_error){
        echo "error for loggin in ";
    }
    else{
        echo "logged in $username";
        header('Location:sheet.php');
        $current_sheet=NULL;
        $link=mysqli_connect("localhost","root","",$username);
        $sql="SELECT * FROM table_list";
        if($result=$link->query($sql)){
            while($row=$result->fetch_assoc()){
                $current_sheet=$row['actual_name'];
            }
        }
        if(isset($current_sheet) && !empty($current_sheet)){
            $_SESSION['current_sheet']=$current_sheet;
        }
        else{
            $i=1;
            $current_sheet="t$i";
            $link_to_create_table=mysqli_connect("localhost","root","",$username);
        $sql_to_create_table="CREATE TABLE $current_sheet(
            id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            r1 VARCHAR(255),
            r2 VARCHAR(255),
            r3 VARCHAR(255),
            r4 VARCHAR(255),
            r5 VARCHAR(255),
            r6 VARCHAR(255),
            r7 VARCHAR(255),
            r8 VARCHAR(255),
            r9 VARCHAR(255),
            r10 VARCHAR(255),
            r11 VARCHAR(255),
            r12 VARCHAR(255),
            r13 VARCHAR(255),
            r14 VARCHAR(255),
            r15 VARCHAR(255),
            r16 VARCHAR(255)

        )";
        if($link_to_create_table->query($sql_to_create_table)){
            echo "<script>alert('table created successfully');</script>";
            for($i=1;$i<=16;$i++){
                $link=$link_to_create_table;
                $to_be_inserted="r$i";
                $sql="INSERT INTO $current_sheet ($to_be_inserted)
                VALUES (NULL)";
                if($link->query($sql)){
                    echo "added column $i"."<br>";
                }
                else{
                    echo "error $i"."<br>";
                }
            }
        }
        else{
            echo "<script>alert('sorry, cant create table');</script>";
            
        }
        }
       
    }
}
?>