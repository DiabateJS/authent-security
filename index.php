<?php
  include_once('models/userManager.php');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Content-Type: application/json');


  $method = isset($_GET["method"]) ? strtolower($_GET["method"]) : "";
  $detail = isset($_GET["detail"]) ? strtolower($_GET["detail"]) : "";

  $data = json_decode(file_get_contents("php://input"));
  $userManager = new UserManager();

  if ($method == "get"){
      if ($detail == "users"){
          echo json_encode($userManager->getAllUsers());
      }
      if ($detail == "user"){
          $id = isset($_GET["id"]) ? $_GET["id"] : "";
          echo json_encode($userManager->getUserById($id));
      }
  }
  if ($method == "auth"){
      $login = isset($_POST["login"]) ? $_POST["login"] : $data->login;
      $pwd = isset($_POST["password"]) ? $_POST["password"] : $data->password;
      echo json_encode($userManager->isAuth($login, $pwd));
  }
    if ($method == "put"){
        if ($detail == "user"){
            $id = $data->id ?? "";
            $fullname = $data->fullname ?? "";
            $login = $data->login ?? "";
            $password = $data->password ?? "";
            $email = $data->email ?? "";
            $profile = $data->profile ?? "";
            $newUser = new User($id, $fullname, $login, $password, $email, $profile);
            echo json_encode($userManager->updateUser($id, $newUser));
        }
    }
    if ($method == "post"){
        if ($detail == "user"){
            $id = $data->id ?? "";
            $fullname = $data->fullname ?? "";
            $login = $data->login ?? "";
            $password = $data->password ?? "";
            $email = $data->email ?? "";
            $profile = $data->profile ?? "";
            $newUser = new User($id, $fullname, $login, $password, $email, $profile);
            echo json_encode($newUser->isEmpty() ? Helper::createResponseObject() : 
                                                   $userManager->createUser($newUser));
        }
    }
    if ($method == "delete"){
        if ($detail == "user"){
            $id = isset($_GET["id"]) ? $_GET["id"] : "";
            echo json_encode($userManager->deleteUser($id));
        }
    }

?>
