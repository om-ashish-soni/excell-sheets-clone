<html>
<head>
<link rel="stylesheet" href="style.css" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="script.js"></script>
</head>
<body>
<div class="container" id="login">
<form action="existing_user_validate.php" method="POST" >
<div class="container" >
    <input type="text" name="username" class="form-control" placeholder="username">
    <input type="password" class="form-control" placeholder="password">
    <button type="submit" class="btn btn-outline-success">submit</button>
</div>
</form>
<button onclick="signin()" class="btn btn-outline-primary">New User</button>
</div>

<div class="container" id="signin" style="display:none">
<form action="new_user_validate.php" method="POST"  >
<div class="container" >
    <input type="text" name="username" class="form-control" placeholder="username">
    <input type="password" class="form-control" placeholder="password">
    <button type="submit" class="btn btn-outline-success">submit</button>

</div>
</form>
<button onclick="login()" class="btn btn-outline-primary">Already have account ?</button>
</div>
</body>
</html>