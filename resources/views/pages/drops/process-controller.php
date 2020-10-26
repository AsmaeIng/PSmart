<?php
    require_once '.App/Http/Controllers/DropController.php';


    if(isset($_POST['netId'])) {
        $netId              =           $_POST['netId'];

        $dController         =           new DataController();

        $offres          =           $dController->offreListing($netId);

        echo json_encode($offres);
    }

    elseif(isset($_POST['offId'])) {
        $offId              =           $_POST['offId'];

        $dController         =           new DataController();
        
        $version             =           $dController->versionListing($offId);

        echo json_encode($version);

    }
?>