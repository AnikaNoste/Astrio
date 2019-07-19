<?php
function searchCategory($categories, $id){
	for($i=0; $i<count($categories); $i++){
		if($id == $categories[$i]["id"]){
			return $categories[$i]["title"];
		} elseif($categories[$i]["children"]){
			return searchCategory($categories[$i]["children"],$id);
		}
	}
}











