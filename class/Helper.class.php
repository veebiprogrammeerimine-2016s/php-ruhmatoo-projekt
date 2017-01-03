<?php 
class Helper {

	function cleanInput($input){
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;	
	}


	function returnActivePage($currentpage){

	    $html = "";
	    if($currentpage == "data"){

            $html .= "<li class='active'><a href=\"data.php\">Kodu</a></li>";
            $html .= " <li><a href=\"timetable.php\">Tunniplaan</a></li>";
            $html .= "<li><a href=\"homework.php\">Kodutööd</a></li>";
            $html .= "<li><a href=\"compulsory_literature.php\">Kohustuslik kirjandus</a></li>";
            $html .= "<li><a href=\"teachers.php\">Õpetajad</a></li>";
            return $html;

	    }elseif($currentpage == "timetable"){

            $html .= "<li><a href=\"data.php\">Kodu</a></li>";
            $html .= "<li class='active'><a href=\"timetable.php\">Tunniplaan</a></li>";
            $html .= "<li><a href=\"homework.php\">Kodutööd</a></li>";
            $html .= "<li><a href=\"compulsory_literature.php\">Kohustuslik kirjandus</a></li>";
            $html .= "<li><a href=\"teachers.php\">Õpetajad</a></li>";

            return $html;

        }elseif($currentpage == "homework"){

	        $html .= "<li><a href=\"data.php\">Kodu</a></li>";
            $html .= "<li><a href=\"timetable.php\">Tunniplaan</a></li>";
            $html .= "<li class='active'><a href=\"homework.php\">Kodutööd</a></li>";
            $html .= "<li><a href=\"compulsory_literature.php\">Kohustuslik kirjandus</a></li>";
            $html .= "<li><a href=\"teachers.php\">Õpetajad</a></li>";

            return $html;

        }elseif($currentpage == "teachers"){

            $html .= "<li><a href=\"data.php\">Kodu</a></li>";
            $html .= "<li><a href=\"timetable.php\">Tunniplaan</a></li>";
            $html .= "<li><a href=\"homework.php\">Kodutööd</a></li>";
            $html .= "<li><a href=\"compulsory_literature.php\">Kohustuslik kirjandus</a></li>";
            $html .= "<li class='active'><a href=\"teachers.php\">Õpetajad</a></li>";

            return $html;

	    }else{

            $html .= "<li><a href=\"data.php\">Kodu</a></li>";
            $html .= "<li><a href=\"timetable.php\">Tunniplaan</a></li>";
            $html .= "<li><a href=\"homework.php\">Kodutööd</a></li>";
            $html .= "<li class='active'><a href=\"compulsory_literature.php\">Kohustuslik kirjandus</a></li>";
            $html .= "<li><a href=\"teachers.php\">Õpetajad</a></li>";

            return $html;
        }
    }
}
?>