<?php
    $pdo = new PDO("mysql:host=localhost;dbname=global;charset=UTF8", "leskovec", "neto0849");

    $stmt = $pdo->query("SELECT * FROM books");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row_count = 0;
    $seach_au = 0;
    $seach_na = 0;
    $seach_is =0;
    function isIsbn(){
        if(!empty($_GET['isbn'])){
            return true;
        }
    }
    function isAutor(){
        if (!empty($_GET['author'])){
            return true;
        }
    }

    function isName(){
        if (!empty($_GET['name'])){
            return true;
        }
    }
    foreach ($stmt as $row){
        $name[] = $row['name'];
        $author[] = $row['author'];
        $year[]= $row['year'];
        $isbn[]=$row['isbn'];
        $row_count++;
    }

  foreach ($author as $value) {
        if (isAutor()) {
            $seach = mb_strstr($value, $_GET['author']);

            if ($seach) {
                $id[] = $seach_au;
            }
            $seach_au++;
        }
    }

foreach ($name as $value) {
    if (isName()) {
        $seach = mb_strstr($value, $_GET['name']);

        if ($seach) {
            $id[] = $seach_na;
        }
        $seach_na++;
    }
}
foreach ($isbn as $value) {
    if (isIsbn()) {
        $seach = mb_strstr($value, $_GET['isbn']);

        if ($seach) {
            $id[] = $seach_is;
        }
        $seach_is++;
    }
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Библиотека успешного человека</h1>

<form method="GET">
    <input type="text" name="author" placeholder="Автор книги" value="" />
    <input type="text" name="name" placeholder="Название книги" value="" />
    <input type="text" name="isbn" placeholder="ISBN" value="" />
    <input type="submit" value="Поиск" />
</form>
<br/>

<table border="1px">
    <tbody>
    <tr>
        <th>Название</th>
        <th>Автор</th>
        <th>Год выпуска</th>
        <th>ISNB</th>
    </tr>
    <?php
    if(!empty($id)){
        array_unique($id);
        foreach ($id as $i){?>
            <tr>
                <th>
                    <?php
                    echo $name[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $author[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $year[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $isbn[$i];
                    ?>
                </th>
            </tr>
        <?php
        }
    }else{
        for ($i=0;$i<$row_count;$i++){
         ?>
            <tr>
                <th>
                    <?php
                    echo $name[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $author[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $year[$i];
                    ?>
                </th>
                <th>
                    <?php
                    echo $isbn[$i];
                    ?>
                </th>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

</body>
</html>
