<?php $tittle = "MANGODEV"; require "includes/header.php";
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$query = R::getAll( "SELECT * FROM notes WHERE id='$id'" );
$data = $_POST;
if (isset($data["addNoteDb"])){
  $errorsNote = array();

  if($data["textarea"] == ""){
    $errorsNote[] = "Enter Content!";
  }
  if (empty($errorsNote)){
    $comment = R::dispense('comment');
    $comment->articleId = $id;
    $comment->text = $data['textarea'];
    $comment->author = $data['author'];
    $comment->date = $data['date'];
    R::store($comment);
  } else {
  echo "<warn id='warn'>
  <div>
  ".array_shift($errorsNote)."
  </div>
  </warn>";
  }
}
?>

<main>
  <?php foreach ($query as $row){
  ?>
  <div class="notePage">
    <h1 id="h1Page"><?=$row['title']?></h1>
    <img id='imgPage' src="/img/<?=$row['img']?>">
    <p id='textPage'><?=$row['text']?></p>
    <div class="divPage">
      <p id='datePage'>Date of publication: <?=$row['date']?></p>
      <p id ='authorPage'>Author article: <?=$row['author']?></p>
    </div>
  </div>
<?php } ?>
  <comment>
    <div>
<?php
$comments = R::getAll( "SELECT * FROM comment WHERE article_id='$id'" );
foreach ($comments as $com){
?>
      <div class="noteComment">
        <h1 id="h1Comment">Comment author: <?=$com['author']?></h1>
        <p id='textPage'><?=$com['text']?></p>
        <div class="divPage">
          <p id='datePage'>Date: <?=$com['date']?></p>
        </div>
      </div>
<?php } ?>
    </div>
  </cooment>
<?php  if( isset($_SESSION['logged_user']) ) : ?>
  <div class="comment">
    <h1 id="h1Page">leave a comment</h1>
    <form method="post" enctype="multipart/form-data" >
      <textarea rows="10" cols="165" name="textarea" placeholder="CONTENT TEXT"></textarea><br>
      <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>"/>
      <input type="hidden" name="author" value="<?php echo $_SESSION['logged_user']->login; ?>"/>
      <input id="buttonForm" type="submit" name="addNoteDb" value="add note">
    </form>
  </div>
  <?php else : ?>
    <h1 id="h1Page">leave a comment</h1>
    <h1 id="h1Page">You are not logged in.</h1>
  <?php endif; ?>
</main>

<?php $footerTit = "MANGODEV © 2018"; require "includes/footer.php";?>
