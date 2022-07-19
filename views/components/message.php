
<?php
if(isset($_SESSION["msg"])) {
    $message = $_SESSION["msg"];
    session_unset();
} else {
    $message = "";
}

echo '<p style="color:red; font-weight: bold;">'.$message.'</p>';

?>