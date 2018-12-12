<?php
  $data = $_POST;
  if (isset($data["doRegister"])){
    $errors = array();
    if(trim($data["login"]) == ""){
      $errors[] = "Enter Login!";
    }
    if(trim($data["email"]) == ""){
      $errors[] = "Enter Email!";
    }
    if($data["password"] == ""){
      $errors[] = "Enter Password!";
    }
    if($data["confirmPassword"] != $data["password"]){
      $errors[] = "Wrong password entered incorrectly!";
    }
    if(R::count('users', "login = ?", array($data['login']))>0){
      $errors[] = "User with this login already exists!";
    }
    if(R::count('users', "email = ?", array($data['email']))>0){
      $errors[] = "User with this email already exists!";
    }
    if (empty($errors)){
      $user = R::dispense('users');
      $user->login = $data['login'];
      $user->email = $data['email'];
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
      R::store($user);
      $_SESSION['logged_user'] = $user;
    } else {
    echo "<warn id='warn'>
    <div>
    ".array_shift($errors)."
    </div>
    </warn>";
    }
  }
  if (isset($data["doLogin"])){
    $user = R::findOne('users', 'email = ?', array($data['emailLogin']));
    if($user){
      if(password_verify($data['passwordLogin'], $user->password)){
        $_SESSION['logged_user'] = $user;
      }else{
        $errorsLogin[] = 'You entered the wrong password!';
      }
    }else{
      $errorsLogin[] = 'User with this email not found!';
    }
    if ( ! empty($errorsLogin)){
      echo "<warn id='warn'>
      <div>
      ".array_shift($errorsLogin)."
      </div>
      </warn>";
    }
  }
?>
<register>
      <div onclick="show('none', 'registerForm', 'darkBackgroundRegister')" id="darkBackgroundRegister" class="darkBackground"></div>
        <form method="POST" class="regForm" id="registerForm">
          <h2>Register</h2>
          <input type="text" id="formText" name="login" placeholder="LOGIN" value="<?php echo @$data['login'];?>"><br>
          <input type="email" id="formText" name="email" placeholder="EMAIL" value="<?php echo @$data['email'];?>"><br>
          <input type="password" id="formText" name="password" placeholder="PASSWORD"><br>
          <input type="password" id="formText" name="confirmPassword" placeholder="CONFIRM PASSWORD"><br>
          <button type="submit" name="doRegister" id="buttonForm">Continue</button>
        </form>
</register>
<login>
      <div onclick="show('none', 'loginForm', 'darkBackgroundLogin')" id="darkBackgroundLogin" class="darkBackground"></div>
        <form method="POST" class="regForm" id="loginForm">
          <h2>Login</h2>
            <input type="text" id="formText" name="emailLogin" placeholder="YOUR EMAIL" value="<?php echo @$data['emailLogin'];?>"><br>
            <input type="password" id="formText" name="passwordLogin" placeholder="YOUR PASSWORD">
          <button type="submit" name="doLogin" id="buttonForm">Continue</button>
        </form>
</login>
