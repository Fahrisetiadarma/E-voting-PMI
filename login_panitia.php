<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<div class="jumbotron" style="background-color: white; color: #D50032; border: 2px solid #D50032; padding: 20px;">
    <center>
    <form action="aksi_panitia.php" method="POST">
        <table class="table">
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="panitia_npm" required="required" class="form-control" style="background-color: #f8d7da; border: 1px solid #D50032;" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="panitia_password" required="required" class="form-control" style="background-color: #f8d7da; border: 1px solid #D50032;" /></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" name="login_panitia" class="btn btn-primary" value="Login Admin" style="background-color: #D50032; color: white; border: none;" /></td>
            </tr>
        </table>
    </form>
    </center>
</div>
