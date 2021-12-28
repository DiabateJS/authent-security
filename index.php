<?php
  include_once('models/userManager.php');
  header('Access-Control-Allow-Origin: *');
<<<<<<< Updated upstream
  header('Content-Type: application/json');


  $method = isset($_GET["method"]) ? $_GET["method"] : "";
  $detail = isset($_GET["detail"]) ? $_GET["detail"] : "";

  $data = json_decode(file_get_contents("php://input"));

  if (strtolower($method) == "get"){
      if (strtolower($detail) == "users"){
          $userManager = new UserManager();
          echo json_encode($userManager->getAllUsers());
      }
      if (strtolower($detail) == "user"){
=======
  header('Access-Control-Allow-Headers: Content-Type');
  header('Content-Type: application/json');


  $method = isset($_GET["method"]) ? strtolower($_GET["method"]) : "";
  $detail = isset($_GET["detail"]) ? strtolower($_GET["detail"]) : "";

  $data = json_decode(file_get_contents("php://input"));

  if ($method == "get"){
      if ($detail == "users"){
          $userManager = new UserManager();
          echo json_encode($userManager->getAllUsers());
      }
      if ($detail == "user"){
>>>>>>> Stashed changes
          $id = isset($_GET["id"]) ? $_GET["id"] : "";
          $userManager = new UserManager();
          echo json_encode($userManager->getUserById($id));
      }
  }
<<<<<<< Updated upstream
  if (strtolower($method) == "auth"){
      $login = isset($_POST["login"]) ? $_POST["login"] : "";
      $pwd = isset($_POST["password"]) ? $_POST["password"] : "";
      $userManager = new UserManager();
      echo json_encode($userManager->isAuth($login, $pwd));
  }
    if (strtolower($method) == "put"){
        if (strtolower($detail) == "user"){
=======
  if ($method == "auth"){
      $login = isset($_POST["login"]) ? $_POST["login"] : $data->login;
      $pwd = isset($_POST["password"]) ? $_POST["password"] : $data->password;
      $userManager = new UserManager();
      echo json_encode($userManager->isAuth($login, $pwd));
  }
    if ($method == "put"){
        if ($detail == "user"){
>>>>>>> Stashed changes
            $id = $data->id ?? "";
            $fullname = $data->fullname ?? "";
            $login = $data->login ?? "";
            $password = $data->password ?? "";
            $email = $data->email ?? "";
            $profile = $data->profile ?? "";
            $newUser = new User($id, $fullname, $login, $password, $email, $profile);
            $userManager = new UserManager();
            echo json_encode($userManager->updateUser($id, $newUser));
        }
    }
<<<<<<< Updated upstream
    if (strtolower($method) == "post"){
        if (strtolower($detail) == "user"){
=======
    if ($method == "post"){
        if ($detail == "user"){
>>>>>>> Stashed changes
            $id = $data->id ?? "";
            $fullname = $data->fullname ?? "";
            $login = $data->login ?? "";
            $password = $data->password ?? "";
            $email = $data->email ?? "";
            $profile = $data->profile ?? "";
            $newUser = new User($id, $fullname, $login, $password, $email, $profile);
            $userManager = new UserManager();
            echo json_encode($userManager->createUser($newUser));
        }
    }
<<<<<<< Updated upstream
    if (strtolower($method) == "delete"){
        if (strtolower($detail) == "user"){
=======
    if ($method == "delete"){
        if ($detail == "user"){
>>>>>>> Stashed changes
            $id = isset($_GET["id"]) ? $_GET["id"] : "";
            $userManager = new UserManager();
            echo json_encode($userManager->deleteUser($id));
        }
    }

?>
