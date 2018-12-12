<?php $tittle = "MANGODEV"; require "includes/header.php";
$count = 10;
$result00 =  R::getAll( 'SELECT * FROM notes' );
$len = floor((count($result00)-1) / $count);
$page = isset($_GET['p']) ? (int) $_GET['p'] : 0;
$start = $page * $count;
$query = R::getAll( "SELECT * FROM notes ORDER BY id DESC LIMIT $start, $count" );
?>
<main>
  <?php foreach ($query as $row){
  ?>
  <br>
    <div class="noteOne">
      <p class="textDate"><?=$row['date']?></p>
      <img src="http://localhost/mangodev/img/<?=$row['img']?>">
        <div class="noteText">
          <a href="page.php?id=<?=$row['id']?>" id="h1"><h1><?=$row['title']?></h1></a>
          <p><?=$row['text']?></p>
          <a href="page.php?id=<?=$row['id']?>" align="right" class="more">More..</a>
        </div>
    </div>
    <br>
  <?php } ?>
</main>
<navig>
<ul class="pagination">
  <? for($i = 0; $i <= $len; $i++){ ?>
    <a href="?p=<?= $i ?>"><?= $i+1 ?></a>
  <? } ?>
</ul>
</navig>
<?php $footerTit = "MANGODEV © 2018"; require "includes/footer.php";?>
