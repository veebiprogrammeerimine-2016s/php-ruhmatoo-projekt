<?php

class Helper
{
    function cleanInput($input)
    {
        $input = trim($input);
        $input = stripcslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }
}