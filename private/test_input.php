<?php
function test_input($data) {
    global $db;
    $data = mysqli_real_escape_string($db,$data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>