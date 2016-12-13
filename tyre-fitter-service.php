<?php
?>

<form>
    <div class="form-group">
        <label for="serviceName">Nimetus</label>
        <input type="text" class="form-control" id="serviceName" placeholder="Sisestage nimetus">
    </div>

    <div class="form-group">
        <label for="description">Kirjeldus</label>
        <textarea class="form-control" id="description" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="category">Teenuse kategooria</label>
        <input type="text" class="form-control" id="category" placeholder="Sisestage kategooria nimetus">
    </div>

    <div class="form-group">
        <label for="category">Suurus</label>
        <select class="form-control" name="category" id="category">
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="custom">Eri suurus</option>
        </select>
    </div>

    <div class="form-group">
        <label for="price">Teenuse hind</label>
        <input type="number" class="form-control" id="price" placeholder="Sisestage hind">
    </div>


    <input type="hidden" name="submit" />

</form>



<!--+-----------------+---------------+------+-----+---------+----------------+
| Field           | Type          | Null | Key | Default | Extra          |
+-----------------+---------------+------+-----+---------+----------------+
| id              | int(11)       | NO   | PRI | NULL    | auto_increment |
| name            | varchar(30)   | YES  |     | NULL    |                |
| description     | text          | YES  |     | NULL    |                |
| category        | varchar(30)   | YES  |     | NULL    |                |
| size            | float         | YES  |     | NULL    |                |
| price           | decimal(10,0) | YES  |     | NULL    |                |
| tyre_fitting_id | int(11)       | YES  | MUL | NULL    |                |
+-----------------+---------------+------+-----+---------+----------------+-->