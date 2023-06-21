<?php
include("authenticator.php");
echo "<script>alert('Congratulations, " . $_SESSION['SESS_NAME'] . "! Login Successfully :)')</script>";

$ses = $_SESSION['SESS_MEMBER_ID'];
if(isset($_SESSION['SESS_MEMBER_ID']) && isset($_SESSION['SESS_NAME'])){
}





 $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

        mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

        
        $query = mysqli_query($mysql,"SELECT id FROM users WHERE id = '$ses' ");
        $result = mysqli_fetch_assoc($query);
        foreach ($result as$result){
              $y = mysqli_query($mysql, "SELECT * FROM users WHERE id = '$result' ");
        }
?>

<!DOCTYPE html>

<html>

<body>

   echo '<script>if (window.opener){window.opener.location.href="PUT URL TO PAGE HERE"; window.close();}</script>';

</body>

<a href="logout.php">Logout Here</a>
</html>



