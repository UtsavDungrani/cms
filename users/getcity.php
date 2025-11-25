<?php
include('../config/config.php');

if (!empty($_POST['stateid'])) {
    $stateid = intval($_POST['stateid']);
    $query = mysqli_query($bd, "SELECT id, cityName FROM city WHERE state_id = '$stateid'");

    echo '<option value="">-- Select City --</option>';

    while ($row = mysqli_fetch_array($query)) {
        echo '<option value="' . htmlentities($row['cityName']) . '">' . htmlentities($row['cityName']) . '</option>';
    }
}
?>