<html>
<head>
<link rel="stylesheet" href="style.css" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="script.js"></script>
<body>

<?php
ob_start();
session_start();

include('navbar.php');
include('form.php');
include('validate.php');
?>


<form action="sheet.php" method="POST" id="save_form">
<div class="container" style="display:none;" id="save_as">
<div class="input-group" >
<input name="save" value="yes" type="hidden">
<input type="text" name="filename" style="width:52%;" class="form-control" value="<?php echo htmlspecialchars($virtual_name)?>">
<button class="btn btn-success" type="submit">save</button>
</div>
</div>
<div class="input-group">
<?php
for($i=0;$i<=16;$i++){
    ?>
    <input class="form-control" value="<?php echo htmlspecialchars($i); ?>" disabled>
    <?php
}
?>
</div>
<?php
$id=1;
for($i=1;$i<=16;$i++){

?>
<div class="input-group">
<input class="form-control" value="<?php echo htmlspecialchars($i); ?>" disabled>
<?php
for($j=1;$j<=16;$j++){
    ?>
    <input type="text" class="form-control" name="<?php echo htmlspecialchars($id)?>" value="<?php echo htmlspecialchars($list[$i][$j])?>">
    <?php
    $id++;
}
?>
</div>
<?php
}
ob_end_flush();
?>
</body>
</html>