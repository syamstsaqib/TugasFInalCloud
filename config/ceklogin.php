    <?php
    session_start();
    include "koneksi.php";
    include "function_antiinjection.php";
    $username = antiinjeksi($_POST['user']);
    $password = antiinjeksi($_POST['pass']);
    $cekuser = mysqli_query($con, "SELECT * FROM tbuser WHERE username='$username' AND password='$password'");
    $jmluser = mysqli_num_rows($cekuser);
    $data = mysqli_fetch_array($cekuser);
    if ($jmluser > 0) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        echo "1";
    } else {
        echo "0";
    }
    ?>