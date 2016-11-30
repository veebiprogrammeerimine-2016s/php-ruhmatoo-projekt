<?php
?>

<?php require ("header.php");?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="Logo.png" alt="Firma logo" style="...">
        </div>
        <div class="col-md-3">
            <h1>Lisa oma sõiduk</h1>
            <form method="POST">
                <div class="form-group">
                    <input class="form-control" name="licencePlate" placeholder="Registreerimismärk" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" name="vehicleName" placeholder="Sõiduki nimi" type="text">
                </div>
                <div class="form-group">
                    <input class="form-control" name="model" placeholder="Sõiduki mudel" type="text">
                </div>
                <input class="btn btn-success btn-sm" type="submit" value="Sisesta">
        </div>
    </div>
</div>
<?php require ("footer.php");?>
