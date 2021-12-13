<?php
  include_once('models/userManager.php');
  header('Access-Control-Allow-Origin: *');
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
          $id = isset($_GET["id"]) ? $_GET["id"] : "";
          $userManager = new UserManager();
          echo json_encode($userManager->getUserById($id));
      }
  }
  if (strtolower($method) == "auth"){
      $login = isset($_POST["login"]) ? $_POST["login"] : "";
      $pwd = isset($_POST["password"]) ? $_POST["password"] : "";
      $userManager = new UserManager();
      echo json_encode($userManager->isAuth($login, $pwd));
  }
    if (strtolower($method) == "put"){
        if (strtolower($detail) == "user"){
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
    if (strtolower($method) == "post"){
        if (strtolower($detail) == "user"){
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
    if (strtolower($method) == "delete"){
        if (strtolower($detail) == "user"){
            $id = isset($_GET["id"]) ? $_GET["id"] : "";
            $userManager = new UserManager();
            echo json_encode($userManager->deleteUser($id));
        }
    }

?>
