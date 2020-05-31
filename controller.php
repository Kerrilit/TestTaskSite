<?php
    //model for db
    include("model.php");
    $model = new Model;
    $model->makeConnect();

    //handling login
    if (isset($_POST["Form2"]) && isset($_POST['login']) && isset($_POST['password'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (!($model->checkAdmin($login, $password))){
        $_SESSION["error"] = "Wrong Login or Password!";
    }else{
        $data = "Welcome, ";
        $data .= $model->checkAdmin($login, $password);
        $_SESSION["user"] = $login;
        unset($_SESSION["error"]);
    }

}

    //handling actions
    if(isset($_POST["action_type"]) && $_POST["action_type"] == "save"){
        $model->insertTask(htmlspecialchars($_POST['username']), $_POST['email'], htmlspecialchars($_POST['text']), $_POST['status']);
        $_SESSION["message"] = "<div class=\"alert alert-success\" role=\"alert\">Data was saved!</div>";
    }
    if(isset($_POST["action_type"]) && $_POST["action_type"] == "update" && isset($_SESSION["user"])){
        $yyy=strcmp($_POST["orig_text"], $_POST["text"]);
        if ($yyy=="0"){
            $edited = "";
        }else{
            $edited = "Edit by Admin";
        }

        $model->updateTask($_POST['id'], htmlspecialchars($_POST['username']), $_POST['email'], htmlspecialchars($_POST["text"]), $_POST['status'], $edited);
        $_SESSION["message"] = "<div class=\"alert alert-success\" role=\"alert\">Data was saved!</div>";
    }
    if(isset($_GET["action_type"]) && $_GET["action_type"] == "edit"){
        $result_task = $model->getTask($_GET['id']);
    }

    //calculating pages for pagination
    if (isset($_GET["page"])){
        $page = $_GET["page"];
    }else{
        $page = 1;
    }
    $countedRow = $model->countRow();
    $btnNum = ceil($countedRow / 3);
    if (!isset($_GET["field"])){
        $result = $model->getLimited($page);
    }elseif ($_GET["field"] != "") {
        $result = $model->getLimitedSort($page, $_GET["field"], $_GET["sort"]);
    }

    //making full view
    require("nav.php");
    if(isset($_GET["form1"])){
        require("view_edit_task.php");
    }elseif(isset($_GET["action_type"]) && $_GET["action_type"] == "edit"){
        require("view_edit_task.php");
    }else{
        require("view.php");
    }
?>