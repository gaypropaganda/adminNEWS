<?php if (!empty($_POST)){
         updateDB($_POST, $id);
         
        
    }
   
    $bdNews=getActiveNews($id);
    $actNews=[];
    while ($result = mysqli_fetch_assoc($bdNews)) {
        $actNews[]=$result['rubric_id'];
    }
    ?>

<form class="form" method="post">
    <div class="form-group">
        <label for="data">Дата</label>
        <input class="form-input" name="data" type="datetime-local" id="date" value="<?php $date = new DateTime($wantedNews['date']);
            $new_date = $date->format('Y-m-d\TH:i');
            
            echo $new_date; ?>">
    </div>
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input class="form-input title" name="title" type="text" id="title" value="<?php echo $wantedNews['title'] ?>">
    </div>
    <div class="form-group">
        <label for="text">Текст новости</label>
        <textarea class="form-input textarea" name="text" id="text" placeholder="Текст новости"><?php echo $wantedNews['text'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="rubric">Категории</label>
        <select class="form-input select" name="rubric[]" id="rubric" multiple>
            <?php
            
            foreach ($rubrics as $k=>$rubric) {
                $key = array_search($rubric[0],$actNews);
                if (false !== $key){
                    echo "<option value=\"" . $rubric[0] . "\" selected>" . $rubric[1] . "</option>";
                } else {
                    echo "<option value=\"" . $rubric[0] . "\">" . $rubric[1] . "</option>";
                }
            } 
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="img">Название картинки</label>
        <input class="form-input img-name" name="img_name" type="text" id="img" value="<?php echo $wantedNews['img'] ?>">
    </div>
    <button class="enter-btn" type="submit">Добавить</button>
    <button class="enter-btn res" type="reset">Очистить</button>
    <a class="enter-btn res" href="/">Вернуться обратно</a>
</form>