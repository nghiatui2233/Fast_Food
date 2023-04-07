<?php 
    
    session_destroy();
    $delete_sql = "DELETE FROM cart";
    mysqli_query($Connect, $delete_sql);
    echo '<meta http-equiv="refresh" content="0; URL=/Fast-Food/index.php"/>'
?>