<?php
include_once('bd.php');
include_once('user.php');
include_once('constants.php');
include_once('utils/helper.php');

class UserManager
{

    public function __construct()
    {

    }

    public function getAllUsers()
    {
        $sql = "select * from ".Constants::$TABLE_PREFIX."users ";
        $bdMan = new BdManager();
        $entetes = array("id","fullname","login","password","email","profile");
        $res = $bdMan->executeSelect($sql,$entetes);
        $users = array();

        for ($i = 0 ; $i < count($res) ; $i++)
        {
            $id = $res[$i]["id"];
            $fullname = $res[$i]["fullname"];
            $login = $res[$i]["login"];
            $password = $res[$i]["password"];
            $email = $res[$i]["email"];
            $profile = $res[$i]["profile"];

            $currentUser = new User($id,$fullname,$login,$password,$email,$profile);

            $users[] = $currentUser;

        }

        return $users;
    }

    function isAuth($login, $pwd){
        $resultat = Helper::createResponseObject();
        $sql = "select * from ".Constants::$TABLE_PREFIX."users where login = :login and password = :password";
        $dicoParam = array(
          "login" => $login,
          "password" => $pwd
        );
        $bdMan = new BdManager();
        $entetes = array("id","fullname","login","password","email","profile");
        $res = $bdMan->executePreparedSelect($sql, $dicoParam, $entetes);
        if (count($res) > 0){
            $resultat["code"] = Constants::$SUCCES_CODE;
            $resultat["message"] = "";
            $resultat["fullname"] = $res[0]["fullname"];
            $resultat["id"] = $res[0]["id"];
        }
        return $resultat;
    }

    public function getUserById($idUser){
        $sql = "select * from ".Constants::$TABLE_PREFIX."users where id = :idUser";
        $dicoParam = array(
            "idUser" => $idUser
        );
        $bdMan = new BdManager();
        $entetes = array("id","fullname","login","password","email","profile");
        $res = $bdMan->executePreparedSelect($sql, $dicoParam, $entetes);
        $_user = null;
        if (count($res) > 0)
        {
            $_id = $res[0]["id"];
            $_fullname = $res[0]["fullname"];
            $_login = $res[0]["login"];
            $_password = $res[0]["password"];
            $_email = $res[0]["email"];
            $_profile = $res[0]["profile"];
            $_user = new User($_id,$_fullname,$_login,$_password,$_email,$_profile);
        }
        return $_user;
    }

    public function updateUser($id, $newUser)
    {
        $resultat = Helper::createResponseObject();;
        $sql = "update ".Constants::$TABLE_PREFIX."users set fullname = :fullname , login = :login , password = :password , email = :email , profile = :profile where id = :id";
        $dicoParam = array(
            "fullname" => $newUser->fullname,
            "login" => $newUser->login,
            "password" => $newUser->password,
            "email" => $newUser->email,
            "profile" => $newUser->profile,
            "id" => $id
        );
        $bdMan = new BdManager();
        $bdMan->executePreparedQuery($sql, $dicoParam);
        $resultat["code"] = Constants::$SUCCES_CODE;
        return $resultat;
    }

    public function createUser($newUser)
    {
        $resultat = Helper::createResponseObject();;
        $sql = "insert into ".Constants::$TABLE_PREFIX."users (fullname, login, password, email, profile) values (:fullname, :login, :password, :email, :profile)";
        $dicoParam = array(
            "fullname" => $newUser->fullname,
            "login" => $newUser->login,
            "password" => $newUser->password,
            "email" => $newUser->email,
            "profile" => $newUser->profile
        );
        $bdMan = new BdManager();
        $bdMan->executePreparedQuery($sql, $dicoParam);
        $resultat["code"] = Constants::$SUCCES_CODE;
        return $resultat;
    }

    public function deleteUser($id){
        $sql = "delete from ".Constants::$TABLE_PREFIX."users where id = :idUser";
        $dicoParam = array(
            "idUser" => $id
        );
        $bdMan = new BdManager();
        $bdMan->executePreparedQuery($sql, $dicoParam);
        $resultat["code"] = Constants::$SUCCES_CODE;
        return $resultat;
    }
}

 ?>
