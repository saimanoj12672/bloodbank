<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="has-bg-img">
        <center>
            <form action="server.php" method="post">
                <h2>LOGIN</h2>
          -      <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <table>
                    <tr>
                        <td><label>UserName</label></td>
                        <td><input type="text" name="username" placeholder="User Name"></td>
                    </tr>
                    <tr>
                        <td><label>Password</label></td>
                        <td><input type="password" name="password_1" placeholder="Password"></td>
                    </tr>
                </table> 
                <button type="submit" name="login_user">Login</button>
            </form>
            <p>Not a Existing User? <a href="registration.php"><b>Register Here</b></a></p>
        </center>
    </div>
</body>
</html>