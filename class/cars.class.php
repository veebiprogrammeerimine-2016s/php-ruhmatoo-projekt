<?php
class Cars
{
    private $connection;

    function __construct($mysqli)
    {
        $this->connection = $mysqli;
    }

    function getAllUserCars($email)
    {

        $stmt = $this->connection->prepare("SELECT garagediary_addcar_makers.maker_name, garagediary_addcar_models.model_name, garagediary_usercars.carYear,
	garagediary_usercars.carVin, garagediary_usercars.carDisplacement, garagediary_usercars.carFuel,
	garagediary_usercars.carGearbox, garagediary_usercars.carDrivetrain, garagediary_usercars.carDescr
	FROM garagediary_usercars, garagediary_addcar_makers, garagediary_addcar_models WHERE carOwner=?
	AND garagediary_usercars.carMaker=garagediary_addcar_makers.maker_id
	AND garagediary_usercars.carModel=garagediary_addcar_models.model_id;");

        $stmt->bind_param("s", $email);
        $stmt->bind_result($maker, $model, $year, $vin, $displacement, $fuel, $gearbox, $drivetrain, $descr);

        $stmt->execute();

        $result = array();

        while ($stmt->fetch()) {
            $car = new StdClass();
            $car->carMaker = $maker;
            $car->carModel = $model;
            $car->carYear = $year;
            $car->carVin = $vin;
            $car->carDisplacement = $displacement;
            $car->carFuel = $fuel;
            $car->carGearbox = $gearbox;
            $car->carDrivetrain = $drivetrain;
            $car->carDescr = $descr;

            array_push($result, $car);
        }

        $stmt->close();

        return $result;
    }

    function addNewUserCar($email, $maker, $model, $year, $vin, $displacement, $fuel, $gearbox, $drivetrain, $descr){

      $stmt = $this->connection->prepare("INSERT INTO garagediary_usercars (carOwner, carMaker, carModel, carYear, carVin, carDisplacement, carFuel, carGearbox, carDrivetrain, carDescr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
      $stmt->bind_param("ssssssssss", $email, $maker, $model, $year, $vin, $displacement, $fuel, $gearbox, $drivetrain, $descr);
      $stmt->execute();

      $stmt->close();

    }

    function delUserCar($vin, $email){

        $stmt = $this->connection->prepare("DELETE FROM garagediary_usercars WHERE carVin=? AND carOwner=?");
        $stmt->bind_param("ss", $vin, $email);
        $stmt->execute();
        $stmt->close();
    }
}
