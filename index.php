<?php
require_once 'db.conf.php';
require_once 'searchCategory.php';
require_once 'correct.php';
require_once 'cookie.php';
$db_host = $db_config_mysql['host'];
$db_name = $db_config_mysql['db'];
$db_username = $db_config_mysql['user'];
$db_password = $db_config_mysql['password'];

// ЗАДАНИЕ 5

$cookie = Cookie::getInstance();
$cookie->setCookie('name', 'value', 100);

$cookie2 = Cookie::getInstance();
//$cookie2->updateCookie('name', 'value2', 100);
//$cookie->deleteCookie('name');

echo "<center><br> ЗАДАНИЕ 5 <br></center>". $cookie->getCookie('name')."<br>";
echo $cookie2->getCookie('name')."<br>";

if ($cookie === $cookie2) {
    echo "Синглтон работает, обе переменные содержат один и тот же экземпляр <br><br>";
} else {
	echo "Синглтон работает, переменные содержат разные экземпляры <br><br>";
}


// ЗАДАНИЕ 1
echo "<center><br> ЗАДАНИЕ 1 <br></center>";

$categories = array(
	array(
		"id" => 1,
		"title" => "Обувь",
		'children' => array(
			array(
			'id' => 2,
			'title' => 'Ботинки',
			'children' => array(
				array(
					'id' => 3, 
					'title' => 'Кожа'
					),
				array(
					'id' => 4, 
					'title' => 'Текстиль'
					),
				),
			),
			array(
			'id' => 5, 
			'title' => 'Кроссовки',),
		)
	),
	array(
		"id" => 6,
		"title" => "Спорт",
		'children' => array(
			array(
			'id' => 7,
			'title' => 'Мячи'
			)
		)
	),
);
/* echo "<pre>";
 print_r ($categories);
echo "</pre>"; */

$id = 1;
$category = searchCategory($categories,$id);
echo "ID: ".$id."<br>";
echo "Категория: ".$category."<br>"."<br>";

$id = 2;
$category = searchCategory($categories,$id);
echo "ID: ".$id."<br>";
echo "Категория: ".$category."<br>"."<br>";

$id = 3;
$category = searchCategory($categories,$id);
echo "ID: ".$id."<br>";
echo "Категория: ".$category."<br>"."<br>";

$id = 4;
$category = searchCategory($categories,$id);
echo "ID: ".$id."<br>";
echo "Категория: ".$category."<br>"."<br>";


// ЗАДАНИЕ 2
echo "<center><br> ЗАДАНИЕ 2 <br></center>";

$link = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if ($sqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $sqli->connect_error);
    exit();
}

$sql = "SELECT department.name as name FROM department 
	INNER JOIN (SELECT count(*) as count, department_id  FROM worker group by department_id)t2 
	ON (t2.count>=5 AND t2.department_id = department.id)";

$result = mysqli_query($link, $sql);
while ($r = mysqli_fetch_array($result)) {
        echo $r['name']  . "<br>";
}

echo "<br>";

$sql = "SELECT department.name as name, GROUP_CONCAT(worker.id ORDER BY worker.id SEPARATOR ',') AS id FROM department 
	INNER JOIN worker 
	ON (worker.department_id = department.id)
	GROUP BY department.name";

$result = mysqli_query($link, $sql);
while ($r = mysqli_fetch_array($result)) {
        echo $r['name'] . ": ";
		echo $r['id'] . "<br>";
}


// ЗАДАНИЕ 4
echo "<center><br> ЗАДАНИЕ 4 <br></center>";

$tags1 = ["<a>", "<div>", "</div>",  "<div>", "</div>", "</a>", "<span>", "</span>"];
$tags2 = ["<a>", "<div>", "</a>"];
 
echo correctnessСheck1($tags1)."<br>";
echo correctnessСheck1($tags2)."<br>";
echo correctnessСheck2($tags1)."<br>";

