<table class="table">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Заголовок</th>
            <th>Текст статьи</th>
            <th>Категории</th>
            <th>Картинка</th>
            <th>Команды</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/connect.php';
        require_once __DIR__ . '/functions.php';
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM news ORDER BY date DESC";
        $res = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_assoc($res)) {
            $db_id = $result["ID"];
            $db_rubrics = getActiveRub($db_id);
            $db_title = $result["title"];
            $db_date = $result["date"];
            $db_text = $result["text"];
            $db_img = $result["img"];
            $visible = $result['visible'];
            echo "<tr>
      <td>$db_date</td>
      <td>$db_title</td>
      <td><div>$db_text</div></td>
      <td>";
            while ($result = mysqli_fetch_assoc($db_rubrics)) {
                echo $result['rubric']."<br>";
            }
            echo "</td>
      <td>/img/img-news/$db_img</td>
      <td>
                <a href='index.php?page=edit&id=$db_id'>Редактировать</a>\n";
                if ($visible==1){
                echo "<a href='index.php?page=deactivate&id=$db_id'>Деактивировать</a>\n";}
                else {
                    echo "<a href='index.php?page=deactivate&id=$db_id'>Активировать</a>\n";}
                
                echo "<a href='index.php?page=delete&id=$db_id'>Удалить</a>
      </td>
      </tr>
   ";
        }
        ?>
    </tbody>
</table>