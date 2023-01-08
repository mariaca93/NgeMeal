<?php

$data = array();
if(isset($_GET["query"]))
{
    $connect = new PDO("mysql:host=localhost: dbname=ngemeal", "root", "");
    $query = "SELECT ingredient_name FROM ingredient WHERE ingredient_name LIKE '%".$_GET["query"]."%' ORDER BY ingredient_name ASC LIMIT 15";

    $statement = $connect->prepare($query);
    $statement->execute();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $data[] = $row["ingredient_name"];
    }
}

echo json_encode($data);
?>