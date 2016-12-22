# IziPäevik - http://kool.iziveeb.ee
## Description
    Simple site for school homework & curicculum

## Developers
	Hinrek Saar - developer, hinrek@gmail.com
	Alar Aasa - developer, alar@alaraasa.ee

## Functionality

##To-do:
    * Add events to calendar from form (Google API) 
    * Add curriculum data drom scraper directly to Google calendar (Google API) 

## Technologies used
    * Google API
	* Bootstrap

##  Summary
    **WORK IN PROGRES**

## -Setup
    * Things needed to get the site up and running:

### --MySQL
    1. Create database:
    CREATE DATABASE izipaevik;
    2. Create table:
    CREATE TABLE `izipaevik`.`admins` (
            `id` INT NOT NULL AUTO_INCREMENT ,  
            `email` VARCHAR(255) NOT NULL ,  
            `password` VARCHAR(255) NULL DEFAULT NULL ,  
            `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,  
            PRIMARY KEY (`id`), 
            UNIQUE (`email`) 
    );

### --Config.php
    * Should be located one level up from your site. See functions.php require("../config.php");
    <?php
    
        $serverHost = "your host name";
        $serverUsername = "sql username";
        $serverPassword = "sql password";
    
    ?>