<?php
include('../config/config.php');

if (!empty($_POST['cityid'])) {
    $cityid = $_POST['cityid'];
    $query = mysqli_query($bd, "SELECT id, areaName, pincode FROM area WHERE city_id IN (SELECT id FROM city WHERE cityName = '$cityid')");

    echo '<option value="">-- Select Area --</option>';

    while ($row = mysqli_fetch_array($query)) {
        echo '<option value="' . htmlentities($row['areaName']) . '">' . htmlentities($row['areaName']) . ' (' . htmlentities($row['pincode']) . ')</option>';
    }
}
?>