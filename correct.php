<?php
//проверка корректности вручную (рабочий вариант)
function correctnessСheck1($tags){
	$result = "корректная структура";
	$useTags = [];
	for($i=0; $i<count($tags); $i++){
		$tags[$i] = htmlspecialchars($tags[$i]);
		$useTags[$i] = str_replace('/', '', $tags[$i]);
	}
	
	$useTags = array_unique($useTags); //находим все уникальные тэги массива
	$useTags = array_values($useTags); //сбрасываем ключи массива
	
	$countValues = array_count_values($tags); //находим количество вхождний каждого тэга
	
	//подсчет открывающихся и закрывающихся тэгов
	for($i=0; $i<count($useTags); $i++){
		$slash = addSlash($useTags[$i]);
		if($countValues[$useTags[$i]] != $countValues[$slash]){
			$result = "некорректная структура";
		}
	}
	
	//анализ корректного положения тэгов
	$r=true;
	for($i=0; $i<count($tags); $i++){
		if($r==true){
			$slash = addSlash($tags[$i]);
			$k=0;
			for($j=$i+1; $j<count($tags); $j++){ //поиск места положения закрывающегося тэга
				if($r==true){
					if($tags[$j]==$tags[$i]){ 
						$k=1; //счетчик количества одинаковых тэгов подряд
					}
					if($tags[$j]==$slash){ //нахождение закрывающегося тэга
						$num = $j - $i - 1; //количество тэгов между ними
						if($k == 1){
							$k = 0;
						} elseif (($num % 2) == 0){ //проверка четности количества
							$r=false; 
						} else {
							$result = "некорректная структура";
						}
					}	
				}				
			}
		}
	}
	return $result;
}

function addSlash($useTags) { //подфункция добавления слеша
		$a1 = substr(htmlspecialchars_decode($useTags),0,1);
		$a2 = substr(htmlspecialchars_decode($useTags),1);
		return htmlspecialchars($a1).'/'.htmlspecialchars($a2);
    }

//проверка корректности с помощью класса DOMDocument (нерабочий вариант)
function correctnessСheck2($tags) {
	$tags = htmlspecialchars(implode("", $tags)); 
	$html_1 = htmlspecialchars('<!DOCTYPE HTML><html><head><title></title></head><body>');
	$html_2 = htmlspecialchars("</body></html>");
	$html = $html_1.$tags.$html_2;
	
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	/* if ($dom->validate()) {
		 return "корректная структура\n";
	} 
	return "некорректная структура\n"; */  
}












