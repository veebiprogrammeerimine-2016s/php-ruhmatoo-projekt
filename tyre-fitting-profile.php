<?php
?>

<form>
    <div class="form-group">
        <label for="tyreFitterName">Nimetus</label>
        <input type="text" class="form-control" id="tyreFitterName" placeholder="Sisesta nimetus" required>
    </div>

    <div class="form-group">
        <label for="description">Kirjeldus</label>
        <textarea class="form-control" id="description" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label for="logo">Logo</label>
        <input type="file" class="form-control-file" id="logo" placeholder="Upload logo">
    </div>

    <div class="form-group">
        <label for="location">Google maps link</label>
        <input type="text" class="form-control" id="location" placeholder="Sisesta google maps link" required>
    </div>

    <div class="form-group">
        <label for="priceList">Price list</label>
        <input type="text" class="form-control" id="priceList" placeholder="Sisesta hinna link" required>
    </div>

    <input type="hidden" name="submit" />

</form>


<!--+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| name        | varchar(30)  | YES  |     | NULL    |                |
| logo        | varchar(254) | YES  |     | NULL    |                |
| description | text         | YES  |     | NULL    |                |
| location    | text         | YES  |     | NULL    |                |
| pricelist   | text         | NO   |     | NULL    |                |
| owner_id    | int(11)      | YES  | MUL | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+-->