<?php

class Model{
    
    public $conn;

    public function makeConnect(){
        $servername = "mysql.zzz.com.ua";
        $username = "testuser";
        $password = "4023Kerri";
        $db = "kerri";
        try {
            $connect = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $connect;
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getAll(){
        $query = "SELECT * FROM tasks";
        global $conn;
        $raw_result = $this->$conn->query($query);
        $result = array();


        while($row = $raw_result->fetch()){
            $username = $row['username'];
            $email = $row['email'];
            $text = $row['text'];
            $status = $row['status'];
            array_push($result, ["username" => $username, 
                                "email" => $email, 
                                "text" => $text,
                                "status" => $status]);
        }
        return $result;
    }

    public function countRow(){
        $query = "SELECT COUNT(id) AS count_id FROM tasks";
        global $conn;
        $raw_result = $this->conn->query($query);
        $row = $raw_result->fetch();
        return $row["count_id"];
    }

    public function getLimited($num){
        $startRow = $num * 3 - 3;
        $endRow = 3;
        $query = "SELECT * FROM tasks LIMIT $startRow, $endRow";
        global $conn;
        $raw_result = $this->conn->query($query);
        $result = array();

        while($row = $raw_result->fetch()){
            $id = $row['id'];
            $username = $row['username'];
            $email = $row['email'];
            $text = $row['text'];
            $status = $row['status'];
            $edited = $row['edited'];
            array_push($result, ["id" => $id,
                                "username" => $username, 
                                "email" => $email, 
                                "text" => $text,
                                "status" => $status,
                                "edited" => $edited]);
        }
        return $result;
    }

    public function getLimitedSort($num, $field, $sort){
        $startRow = $num * 3 - 3;
        $endRow = 3;
        global $conn;
        $query = "SELECT * FROM tasks ORDER BY $field $sort, id $sort LIMIT $startRow, $endRow";
        $raw_result = $this->conn->query($query);

        $result = array();

        while($row = $raw_result->fetch()){
            $id = $row['id'];
            $username = $row['username'];
            $email = $row['email'];
            $text = $row['text'];
            $status = $row['status'];
            $edited = $row['edited'];
            array_push($result, ["id" => $id,
                                "username" => $username, 
                                "email" => $email, 
                                "text" => $text,
                                "status" => $status,
                                "edited" => $edited]);
        }
        return $result;
    }

    public function checkAdmin($login, $password){
        global $conn;
        $query = $this->conn->prepare('SELECT `id`, `login` FROM admin_users WHERE login = :login AND password = :password');
        $query->execute([ 'login' => $login, 'password' => $password]);
        $result = $query->fetch();

        return $result["login"];
    }

    public function insertTask($username, $email, $text, $status){
        global $conn;
        $this->conn->beginTransaction();
        $query = $this->conn->prepare('INSERT INTO tasks SET username = :username, email = :email, text = :text, status = :status');
        $query->execute([':username' => $username, ':email' => $email, ':text' => $text, ':status' => $status]);
        $this->conn->commit();
    }

    public function updateTask($id, $username, $email, $text, $status, $edited){
        global $conn;
        $this->conn->beginTransaction();
        $query = $this->conn->prepare('UPDATE tasks SET username = :username, email = :email, text = :text, status = :status, edited = :edited WHERE id = :id');
        $query->execute([':username' => $username, ':email' => $email, ':text' => $text, ':status' => $status, ':id' => $id, ':edited' => $edited]);
        $this->conn->commit();
    }

    public function getTask($id){
        global $conn;
        $query = $this->conn->prepare('SELECT * FROM tasks WHERE id = :id');
        $query->execute([':id' => $id]);
        $result = $query->fetch();
        
        return $result;
    }
}

?>