<?php
// session_start();
$username=$_SESSION['username'];
if(isset($_POST['gotofile']) && !empty($_POST['gotofile'])){
    $_SESSION['current_sheet']=$_POST['gotofile'];
}
if(isset($_POST['filename']) && !empty($_POST['filename'])){
    $current_sheet=$_SESSION['current_sheet'];
}
$savef=NULL;
$newf=NULL;
$list=array("");
$id=1;
$current_sheet=$_SESSION['current_sheet'];

$link=mysqli_connect("localhost","root","",$username);
for($i=1;$i<=16;$i++){
    $temp_list=array("");
    for($j=1;$j<=16;$j++){
        $index=NULL;
        if(isset($_POST[$id]) && !empty($_POST[$id])){
            $index=$_POST[$id];
            // echo "<script>alert('congrats $id');</script>";
        }
        array_push($temp_list,$index);
        $id++;
    }
    array_push($list,$temp_list);
}
if(isset($_POST['save']) && !empty($_POST['save'])){
    $savef=$_POST['save'];


    if($savef=="yes"){
        // echo "<script>alert('save=$savef');</script>";
        $filename=$current_sheet;
        if(isset($_POST['filename']) && !empty($_POST['filename'])){
        // if(TRUE){
            $filename=$_POST['filename'];
            $link=mysqli_connect("localhost","root","",$username);
            $sql="UPDATE table_list SET virtual_name='$filename' WHERE actual_name='$current_sheet'";
            if($link->query($sql)){
                // echo "<script>alert('updated virtual_name from $current_sheet to $filename');</script>";
                $_SESSION['virtual_name']=$filename;
            }
            else{
                echo "<script>alert('sorry cant update virtual_name');</script>";

            }
        }
        for($i=1;$i<=16;$i++){
            for($j=1;$j<=16;$j++){
                // if(isset($list[$i][$j]) && !empty($list[$i][$j])){
                if(TRUE){
                $cell_val=$list[$i][$j];
                $col_index="r$j";
                $sql="UPDATE $current_sheet SET $col_index='$cell_val' WHERE id='$i'";
                if($link->query($sql)){
                    // echo "$cell_val is updated.";
                }
                else{
                    echo "not updated $cell_val";
                    echo "<br>";
                }
                }
                
            }
            
        }
    }
    else{
        echo "<script>alert('save, not working so sorry');</script>";
    }
}
else if(isset($_POST['new']) && !empty($_POST['new'])){
    $newf=$_POST['new'];
    if($newf=="yes"){
    $username=$_SESSION['username'];
    // echo "<script>alert('$username');</script>";
    $link=mysqli_connect("localhost","root","",$username);
    // $count=$_SESSION['count'];

    $count=$_COOKIE[$username];

    $count++;
    setcookie( $username, $count, time() + (86400 * 30 * 12),'/');

    if(isset($_COOKIE[$username])){
        // echo "<script>alert('cookie set for you named $username with value $count');</script>";
        
    }
    else{
        echo "<script>alert('sorry cookie is not created for you');</script>";
    }
    // echo "<script>alert('$count');</script>";
    // echo $_COOKIE[$username];
    $_SESSION['count']=$count;
    $current_sheet="t".$count;
    // echo $current_sheet;
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
            // echo "<script>alert('table created successfully');</script>";
            $link=mysqli_connect("localhost","root","",$username);
            $sql="INSERT INTO table_list (actual_name, virtual_name)
            VALUES ('$current_sheet','$current_sheet')";
            if($link->query($sql)){
                // echo "<script>alert('inserted $current_sheet into list of tables successfully');</script>";

            }
            else{
                echo "<script>alert('error cant insert $current_sheet into list of tables');</script>";
                
            }
            $_SESSION['current_sheet']=$current_sheet;
            for($i=1;$i<=16;$i++){
                $link=$link_to_create_table;
                $to_be_inserted="r$i";
                $sql="INSERT INTO $current_sheet ($to_be_inserted)
                VALUES (NULL)";
                if($link->query($sql)){
                    // echo "added column $i"."<br>";
                }
                else{
                    echo "error $i"."<br>";
                }
            }
        }
        else{
            echo "<script>alert('sorry table cant be created for you');</script> ";

        }
    
    for($i=1;$i<=16;$i++){
        $temp_list=array("");
        for($j=1;$j<=16;$j++){
            array_push($temp_list,NULL);
        }
        array_push($list,$temp_list);
    }
    
    
        // echo "<script>alert('new=$newf');</script>";
    }
    else{
        echo "<script>alert('new, not working so sorry');</script>";
    }
}
else if(isset($_POST['openf']) && !empty($_POST['openf'])){
    $openf=$_POST['openf'];
    if($openf=="yes"){
        if(isset($_POST['gotofile']) && !empty($_POST['gotofile'])){
        $actual_file=$_POST['gotofile'];
        $username=$_SESSION['username'];
        $link=mysqli_connect("localhost","root","",$username);
        $sql="SELECT * FROM $actual_file";
            if($result=$link->query($sql)){
                for($i=1;$row=$result->fetch_assoc();$i++){
                    for($j=1;$j<=16;$j++){
                        $temp_index="r".$j;
                        $list[$i][$j]=$row[$temp_index];
                        // $to_be_printed=$list[$i][$j];
                        // echo "recovered $to_be_printed"."<br>";
                    }
                }
                    
            }
        }
    }
}

?>