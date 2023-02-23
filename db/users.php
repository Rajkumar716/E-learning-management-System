<?php
class users{
    private $id;
    private $name;
    private $uid;
    private $loginStatus;
    private $lastLogin;
    private $dbConn;


    function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setName($name) { $this->name = $name; }
		function getName() { return $this->name; }
		function setUid($uid) { $this->uid = $uid; }
		function getUid() { return $this->uid; }
		function setLoginStatus($loginStatus) { $this->loginStatus = $loginStatus; }
		function getLoginStatus() { return $this->loginStatus; }
		function setLastLogin($lastLogin) { $this->lastLogin = $lastLogin; }
		function getLastLogin() { return $this->lastLogin; }


        public function __construct() {
			require_once("DbConnect.php");
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}


        public function save(){
            $sql = "INSERT INTO `users`(`id`, `name`, `email`, `login_status`, `last_login`) VALUES (null, :name, :email, :loginStatus, :lastLogin)";
			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":name", $this->name);
			$stmt->bindParam(":email", $this->email);
			$stmt->bindParam(":loginStatus", $this->loginStatus);
			$stmt->bindParam(":lastLogin", $this->lastLogin);
            try {
				if($stmt->execute()) {
					return true;
				} else {
					return false;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
        }


        public function getUserByUid() {
			$stmt = $this->dbConn->prepare('SELECT * FROM chat_user WHERE user_id = :uid');
			$stmt->bindParam(':uid', $this->uid);
			try {
				if($stmt->execute()) {
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			return $user;
		}

		public function getUserById() {
			$stmt = $this->dbConn->prepare('SELECT * FROM chat_user WHERE chat_id = :id');
			$stmt->bindParam(':id', $this->id);
			try {
				if($stmt->execute()) {
					$user = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			return $user;
		}


        public function updateLoginStatus() {
			$stmt = $this->dbConn->prepare('UPDATE chat_user SET login_status = :loginStatus, last_login = :lastLogin WHERE chat_id = :id');
			$stmt->bindParam(':loginStatus', $this->loginStatus);
			$stmt->bindParam(':lastLogin', $this->lastLogin);
			$stmt->bindParam(':id', $this->id);
			try {
				if($stmt->execute()) {
					return true;
				} else {
					return false;
				}
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}


        public function getAllUsers() {
			$stmt = $this->dbConn->prepare("SELECT * FROM chat_user");
			$stmt->execute();
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $users;
		}


}


?>