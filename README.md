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

## Summary
    **WORK IN PROGRES**

## Setup       
### --Scraper
    In scraper folder, run "php composer.phar require google/apiclient:^2.0 " in command line
    In scraper.php:
        CLIENT_ID = Izipaevik Client ID from Google API Manager
        REDIRECT_URI = ####.com/scraper/scraper.php
        DEVELOPER_KEY = API Key from Google API Manager
        CLIENT_SECRET = Secret key from Google API Manager

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
    * Should not be uploaded to Github
    <?php
    
        $serverHost = "your host name";
        $serverUsername = "sql username";
        $serverPassword = "sql password";
    
    ?>