<?php

function getData($table)
{
    $sql = "SELECT COUNT(*) AS row_count FROM $table";
    $result = $conn->query($sql);

    return ($result);
}

?>