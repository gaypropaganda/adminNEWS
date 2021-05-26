<?php
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';
$rubrics = getRubric();
$fields = load($fields);

if (!empty($_POST)) {
    if ($errors = validate($fields)) {
        echo "<script>alert('Заполнены не все поля')</script>";
    } else {
        addDB($fields);
        
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Добавить</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="/"><img src="../img/logo.png" alt="logo" width="180" height="70"></a>
                </div>
                <div class="admin-txt">
                    Добавить новость
                </div>
                <div class="enter-btn">
                    <a class="add-btn" href="/">Вернуться обратно</a>
                </div>
            </div>
        </div>
    </header>
    <!--Header-->
    <main class="main">
        <div class="container">
            <form class="form" method="post">
                <div class="form-group">
                    <label for="data">Дата</label>
                    <input class="form-input" name="data" type="datetime-local" id="date">
                </div>
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input class="form-input title" name="title" type="text" id="title">
                </div>
                <div class="form-group">
                    <label for="text">Текст новости</label>
                    <textarea class="form-input textarea" name="text" id="text" placeholder="Текст новости"></textarea>
                </div>
                <div class="form-group">
                    <label for="rubric">Категории</label>
                    <select class="form-input select" name="rubric[]" id="rubric" multiple>
                        <?php
                        foreach ($rubrics as $rubric) {
                            echo "<option value=\"" . $rubric[0] . "\">" . $rubric[1] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">Название картинки</label>
                    <input class="form-input img-name" name="img_name" type="text" id="img">
                </div>
                <button class="enter-btn" type="submit">Добавить</button>
                <button class="enter-btn res" type="reset">Очистить</button>
            </form>
        </div>
    </main>
</body>

</html>