<?php

require("../functions.php");


if(isset($_POST["maker_id"]) && !empty($_POST["maker_id"])){

    $query = $mysqli->query("SELECT * FROM garagediary_addcar_models WHERE maker_id = ".$_POST['maker_id']." AND status = 1 ORDER BY model_name ASC");


    $rowCount = $query->num_rows;

    if($rowCount > 0){
        echo '<option value="">Select model...</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['model_id'].'">'.$row['model_name'].'</option>';
        }
    }else{
        echo '<option value="">Models not available!</option>';
    }

}

?>
