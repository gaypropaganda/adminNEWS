<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="header">
    <div class="container">
      <div class="header-inner">
        <div class="logo">
          <a href="/"><img src="img/logo.png" alt="logo" width="180" height="70"></a>
        </div>
        <div class="admin-txt">
          Система администрирования
        </div>
        <div class="enter-btn">
          <a class="add-btn" href="/incs/add.php">Добавить новость</a>
        </div>
      </div>
    </div>
  </header>
  <!--Header-->
  <main class="main">
    <div class="container">
     <?php 
     if (!isset($_GET['page'])){
       require __DIR__ . '/incs/loadNews.php';
     } elseif ($_GET['page']=='delete'){
       require __DIR__ . '/incs/delete.php';

     } elseif ($_GET['page'] == 'edit'){
      $id = $_GET['id'];
      require __DIR__ . '/incs/functions.php';
      $newsArr = getNews();
      $rubrics = getRubric();
      $wantedNews = [];
      while ($result = mysqli_fetch_assoc($newsArr)) { 
        if ($id == $result['ID']){
           $wantedNews = $result;
           break;
        }
     }
     require __DIR__ . '/incs/edit.php';
    } elseif ($_GET['page']=='deactivate'){
      require __DIR__ . '/incs/deactivate.php';
    }
     ?>
    </div>
  </main>

</html>