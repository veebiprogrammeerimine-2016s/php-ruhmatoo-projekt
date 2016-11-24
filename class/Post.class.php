<?php
class Post {
	
	
	function getLatestPosts($srch,$filter) {

		$allowedFilter = ["asc", "desc"];
		
		
		if(!in_array($filter, $allowedFilter)) {
			$filter = "asc";
		}

		if ($srch != "") {
			echo "otsin: ".$srch;
			
			$stmt = $mysqli->prepare("
			SELECT id, caption, imgurl
			FROM submissions
			where deleted is null
			AND caption like ?
			order by date $filter
			
		");
		
		$searchWord = "%".$srch."%";
		
		$stmt->bind_param("s", $searchWord);

		} else {
			$stmt = $mysqli->prepare("
			SELECT id, caption, imgurl
			FROM submissions
			where deleted is null
			order by date $filter
			
		");
		}
		
		$stmt->bind_result($id, $caption, $imgurl);
		
		if ($srch == "") { 
			
			$stmt = $mysqli->prepare("
				SELECT id,caption,imgurl
				FROM submissions WHERE deleted is NULL
				order by date $filter
			
			");
			
		}
		$stmt->bind_result($id,$caption,$imgurl);
		$stmt->execute();
		
		
		
		
		$results = array();
		
		//tsükeldab nii mitu korda kui mitu rida SQL lausega tuleb
		while ($stmt->fetch()) {
			
			$human = new StdClass();
			$human->id = $id;
			$human->caption = $caption;
			$human->imgurl = $imgurl;
			
			array_push($results, $human);
			
		}
		
		return $results;
		
	}
	
	
	
	
	
	
	
	
}
?>