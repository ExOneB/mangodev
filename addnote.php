<?php
$tittle = "Add note"; require "includes/header.php";
$data = $_POST;
if (isset($data["addNoteDb"])){
  $errorsNote = array();
  if($data["title"] == ""){
    $errorsNote[] = "Enter Tittle!";
  }
  if($data["textarea"] == ""){
    $errorsNote[] = "Enter Content!";
  }
  if (empty($errorsNote)){
    $notes = R::dispense('notes');
    $notes->title = $data['title'];
    $notes->text = $data['textarea'];
    $notes->author = $data['author'];
    $notes->date = $data['date'];
    if ($_FILES['imageForm']) {
    $path = '/mangodev/img/';
    $exts = explode('.',$_FILES['imageForm']['name']);
    $ext = strtolower(array_pop($exts));
    $new_name = time().'.'.$ext;
    $full_path = dirname(__DIR__).$path.$new_name;
    if($_FILES['imageForm']['error'] == 0){
    if(move_uploaded_file($_FILES['imageForm']['tmp_name'], $full_path)){
        $notes->img = $new_name;
    }
  }
}
    R::store($notes);
  } else {
  echo "<warn id='warn'>
  <div>
  ".array_shift($errorsNote)."
  </div>
  </warn>";
  }
}
if( !isset($_SESSION['logged_user']) ){header("Location: index.php");}

?>
<main>
  <br>
  <div class="addNote">
    <form method="post" enctype="multipart/form-data" >
      <input id="textA" type="text" name="title" placeholder="TITTLE" value="<?php echo @$data['title'];?>"/><br>
      <textarea rows="10" cols="165" name="textarea" placeholder="CONTENT TEXT"></textarea><br>
      <input type="hidden" name="date" value="<?php echo date('Y-m-d');?>"/>
      <input type="hidden" name="author" value="<?php echo $_SESSION['logged_user']->login; ?>"/>
      <input type="file" name="imageForm" />
      <input id="buttonForm" type="submit" name="addNoteDb" value="add note">
    </form>
  </div>
</main>
<?php $footerTit = "MANGODEV © 2018"; require "includes/footer.php";?>
