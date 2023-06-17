<?php
// session_start();
include('../db-connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
include './inc/header.php';
?>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php
            include './inc/navbar.php';

            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            if (!file_exists($page . ".php") && !is_dir($page)) {
                include '404.html';
            } else {
                if (is_dir($page))
                    include $page . './home.php';
                else
                    include $page . '.php';
            }
            ?>
        </div>
    </div>
</body>

</html>