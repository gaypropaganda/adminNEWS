<?php

//Функция для дебага
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

//Функция, которая загружает все данные в массив fields из файла data.php
function load($data)
{
    foreach ($_POST as $k => $v) {
        if (array_key_exists($k, $data)) {
            $data[$k]['value'] = $v;
        }
    }
    return $data;
}

//Проверка на заполнение полей на странице "Добавить"
function validate($data)
{
    $errors = '';
    foreach ($data as $k => $v) {
        if ($data[$k]['required'] && empty($data[$k]['value'])) {
            $errors .= "<li>Вы не заполнили поле {$data[$k]['field_name']}</li>";
        }
    }
    return $errors;
}


//Функция получения рубрик из БД для страницы "Добавить новость"
function getRubric()
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM rubric";
    $res = mysqli_query($conn, $sql);
    $rubricArr = [];
    while ($result = mysqli_fetch_assoc($res)) {
        $db_id = $result['ID'];
        $db_rubric = $result['rubric'];
        $rubricArr[] = [$db_id, $db_rubric];
    }
    mysqli_close($conn);
    return $rubricArr;
}

//Функция для добавления новости в базу данных
function addDB($data)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO news VALUES (NULL,'" . $data['data']['value'] . "','" . $data['title']['value'] . "','" . $data['text']['value'] . "','" . $data['img_name']['value'] . "',1)";
    if (mysqli_query($conn, $sql))
        echo "<script>alert('Успешно')</script>";
    $sql1 = "INSERT INTO intermediate VALUES";
    foreach ($data['rubric']['value'] as $k => $rubric) {
        if ($k != count($data['rubric']['value']) - 1) {
            $sql1 .= " (NULL," . $conn->insert_id . "," . $rubric . "),";
        } else {
            $sql1 .= " (NULL," . $conn->insert_id . "," . $rubric . ")";
        }
    }
    mysqli_query($conn, $sql1);
    mysqli_close($conn);
}

//Активирует или деактивирует новость
function updateVisible($id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM news WHERE ID=".$id;
    $result = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_assoc($result)) {
        $visible = $res['visible'];
    }
    if ($visible==1){
        $sql1 = "UPDATE news SET visible=0 WHERE ID =" . $id;
    } else {
        $sql1 = "UPDATE news SET visible=1 WHERE ID =" . $id;
    }
    
    if (mysqli_query($conn, $sql1)) {
        echo "Успешно!\n";
    }
    mysqli_close($conn);
}

function getActiveRub($id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT rubric_id FROM intermediate WHERE news_id=" . $id;
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM rubric WHERE ";
    $rubid = [];
    while ($res = mysqli_fetch_assoc($result)) {
        $rubid[] = $res['rubric_id'];
    }
    foreach ($rubid as $k => $v) {
        if ($k == count($rubid) - 1) {
            $sql2 .= ' ID=' . $v;
        } else {
            $sql2 .= ' ID=' . $v . ' OR';
        }
    }

    $result2 = mysqli_query($conn, $sql2);
    mysqli_close($conn);
    return $result2;
}

function updateDB($data, $id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "UPDATE news SET date='" . $data['data'] . "',title='" . $data['title'] . "', text='" . $data['text'] . "',img='" . $data['img_name'] . "' WHERE ID =" . $id;
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Успешно')</script>";
    }
    $sql2 = "DELETE FROM intermediate WHERE news_id=" . $id;
    mysqli_query($conn, $sql2);
    $sql3 = "INSERT INTO intermediate VALUES";
    foreach ($data['rubric'] as $k => $rubric) {
        if ($k != count($data['rubric']) - 1) {
            $sql3 .= " (NULL," . $id . "," . $rubric . "),";
        } else {
            $sql3 .= " (NULL," . $id . "," . $rubric . ")";
        }
    }
    mysqli_query($conn, $sql3);
    mysqli_close($conn);
}

//Функция, которая возвращает все новости из БД
function getNews()
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function getActiveNews($id){
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT rubric_id FROM intermediate WHERE news_id=".$id;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
