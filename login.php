<?php
session_start();


//Koneksi db
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$nama_db = "login_quiz2";
$koneksi = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);
//init variabel
$eror = "";
$username = "";
$rememberme = "";

if(isset($_COOKIE['cookie_username'])) {
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql = "select * from login_quiz2 where username = '$cookie_username'";
    $query = mysqli_query($koneksi, $sql);
    $route = mysqli_fetch_array($query);
    if($route['password'] == $cookie_password) {
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

if(isset($_SESSION['session_username'])) {
    header("location:home.php");
    exit();
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberme = $_POST['rememberme'];

    if($username == '' or $password == '') {
        $eror = "<li>Silahkan Masukkan Username dan Password.</li>";
    } else {
        $sql = "select * from login_quiz2 where username = '$username'";
        $query = mysqli_query($koneksi,$sql);
        $route = mysqli_fetch_array($query);

        if($route['username'] == '') {
            $eror = "<li>username <b>$username</b> tidak tersedia.</li>";
        } elseif($route['password'] != md5($password)) {
            $eror = "<li>Password yang dimasukkan tidak sesuai</li>";
        }

        if(empty($eror)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = md5($password);

            if($rememberme == 1) {
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60*60*24*30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60*60*24*30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            }
            header("location:home.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href="login.css" rel="stylesheet">
        <style>
            Body {
                background: url(https://assets.hongkiat.com/uploads/minimalist-dekstop-wallpapers/4k/original/10.jpg);
                background-size: cover;
            }
        </style>
    </head>
        <?php if($eror) { ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $eror ?>
          </div>
        <?php } ?>
        <form class="form">
            <h1>Quiz 2</h1>
            <h3>Muhammad Afif Nurruddin | 192410102039</h3>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $username ?>">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
              </div> 
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="rememberme">
                <?php if($rememberme == '1') echo "checked" ?>
                <label class="form-check-label" for="flexCheckDefault">
                  Remember Me?
                </label>
              </div>
              <input type="Submit" class="btn btn-primary" name="login" value="Login"/>
        </form>
    </body>
</html>