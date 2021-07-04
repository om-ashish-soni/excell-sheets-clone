<?php
    session_start();
    $username=NULL;
    
    if(isset($_POST['username']) && !empty($_POST['username'])){
        $username=$_POST['username'];
        $_SESSION['username']=$username;
        // $time_now=$_SERVER['REQUEST_TIME'];
        // echo "<script>alert('$username in first if of new user validate');</script>";
        setcookie( $username, 1, time() + (86400 * 30 * 12),'/');
        $_COOKIE[$username] = 1;
        $count=$_COOKIE[$username];
        $current_sheet="t".$count;
        $_SESSION['current_sheet']=$current_sheet;

        if(isset($_COOKIE[$username])){
            echo "<script>alert('cookie set for you named $username with value ');</script>";
            
        }
        else{
            echo "<script>alert('sorry cookie is not created for you');</script>";
        }

    }
    
    $link=mysqli_connect("localhost","root","");
    $sql="CREATE DATABASE $username";
    if($link->query($sql)){
        echo "<script>alert('db $username created successfully');</script>";
        
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
            $link=mysqli_connect("localhost","root","",$username);
            $sql="CREATE TABLE table_list(
                id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                actual_name VARCHAR(255),
                virtual_name VARCHAR(255)
            )";
            if($link->query($sql)){
               echo "<script>alert('list of tables created successfully');</script>";
                $sql="INSERT INTO table_list (actual_name, virtual_name)
                VALUES ('$current_sheet','$current_sheet')";
                if($link->query($sql)){
                   echo "<script>alert('inserted $current_sheet into list of tables successfully');</script>";

                }
                else{
                    echo "<script>alert('error cant insert $current_sheet into list of tables');</script>";
                    
                }
            }
            else{
               echo "<script>alert('sorry , cant create list of tables');</script>";

            }
            
            // $_COOKIE[$cookie_name]
            // && !empty($_COOKIE[$username])
            
        }
        else{
            echo "<script>alert('sorry table cant be created for you');</script> ";

        }
        $count=0;
        for($i=1;$i<=16;$i++){
            $link=$link_to_create_table;
            $to_be_inserted="r$i";
            $sql="INSERT INTO $current_sheet ($to_be_inserted)
            VALUES (NULL)";
            if($link->query($sql)){
                echo "added column $i"."<br>";
                $count++;
            }
            else{
                echo "error $i"."<br>";
            }
        }
        if($count>=16){
            $_SESSION['virtual_name']="t1";
            header('Location:sheet.php');
        }
    }
    else{
        echo "<script>alert('sorry cant create database');</script>";
    }
?>