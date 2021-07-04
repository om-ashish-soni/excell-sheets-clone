<?php

if(isset($_POST['gotovirtualfile']) && !empty($_POST['gotovirtualfile'])){
  $virtual_name=$_POST['gotovirtualfile'];
  $_SESSION['virtual_name']=$_POST['gotovirtualfile'];
  
}
else if(isset($_POST['save']) && !empty($_POST['save'])){
  if(isset($_POST['filename']) && !empty($_POST['filename'])){
    $filename=$_POST['filename'];
    $virtual_name=$filename;
    $_SESSION['virtual_name']=$filename;
    // include('set_virtual_name.php');
    $username=$_SESSION['username'];
    $current_sheet_now=$_SESSION['current_sheet'];
    $link=mysqli_connect("localhost","root","",$username);
    $sql="UPDATE table_list SET virtual_name='$filename' WHERE actual_name='$current_sheet_now'";
    if($link->query($sql)){
        // echo "<script>alert('updated virtual_name from $current_sheet_now to $filename');</script>";
        $_SESSION['virtual_name']=$filename;
    }
    else{
        echo "<script>alert('sorry cant update virtual_name');</script>";

    }
  }
}
else if(isset($_POST['new']) && !empty($_POST['new'])){
  $virtual_name="untitled";

}
else if(isset($_SESSION['virtual_name']) && !empty($_SESSION['virtual_name'])) $virtual_name=$_SESSION['virtual_name'];
else {
  $virtual_name=$_SESSION['current_sheet'];
  // $virtual_name="untitled";

}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- <button class="btn btn-success" onclick="save()">save</button> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
      <button class="btn btn-danger" onclick="new_form()">new</button>

      </li>
      <li class="nav-item">
      <button class="btn btn-success" onclick="save_form()">save</button>
      </li>
      <li class="nav-item">
      <button class="btn btn-primary" id="virtual_name" disabled>
      <?php
        echo $virtual_name;
      ?></button>
      </li>
      <li class="nav-item">
      <!-- <button class="btn btn-warning" onclick="save_form()">my files</button> -->
      <button class="btn btn-warning" onclick="dropdown()">
        my files
      </button>
      <br>
      <div class="dropdown" id="dropdown" style="display:none">
      <?php
        $username=$_SESSION['username'];
        $list=array("");
        $actual_list=array("");
        $list_len=0;
        $link=mysqli_connect("localhost","root","",$username);
        $sql="SELECT * FROM table_list";
        if($result=$link->query($sql)){
          while($row=$result->fetch_assoc()){
            array_push($list,$row['virtual_name']);
            array_push($actual_list,$row['actual_name']);

            $list_len++;
          }
        }
        for($i=1;$i<=$list_len;$i++){
      ?>
      <form action="sheet.php" method="POST">
        <input type="hidden" name="gotofile" value="<?php echo htmlspecialchars($actual_list[$i]);?>">
        <input type="hidden" name="gotovirtualfile" value="<?php echo htmlspecialchars($list[$i]);?>">
        <input type="hidden" name="openf" value="yes">

        <button class="btn btn-outline-danger" type="submit">
        <?php 
          echo $list[$i];
        ?>
        </button>
        
      </form>
      <?php
        }
      ?>
      </div>
      </li>
      <li class="nav-item">
      <button class="btn btn-primary"  disabled>
      <?php
        echo $username;
      ?></button>
      </li>
    </ul>
  </div>
</nav>