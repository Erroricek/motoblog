
<?php
class User{

	public $id;
	public $login;
	public $name;
	public $firstName;
	public $lastName;
	public $email;
	
	private $role;
	
	public function __construct($input){
		if(is_int($input)){
			return $this->loginById($input);
		}
		return $this;
	}

	public function isAdmin()
	{
		if((int)($this->role) == 1){//'admin'
			return TRUE;
		}else{
			return FALSE;
		}
	}


	private function loginById($id){
		$row = DB::query("SELECT * FROM users WHERE id=$id")[0];
		$this->id = $id;
		$this->login = $row['login'];
		$this->firstName = $row['firstName'];
		$this->lastName = $row['lastName'];
		$this->email = $row['email'];
		$this->role = $row['role'];
		return $this;
	}


	

	private static function validateMember($login){
		$sql = "SELECT * FROM users WHERE login='$login'";
		$result = DB::query($sql);

		if(count($result) == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}


	public static function register($input){
		$errorMessage = [];
		
		if(!isset($input["firstName"]) || $input["firstName"]==""){
			$errorMessage[] = "Jméno je povinný údaj";
		}
		if(!isset($input["lastName"]) || $input["lastName"]==""){
			$errorMessage[] = "Příjmení je povinný údaj";
		}
		if(!isset($input["password"]) || $input["password"]==""){
			$errorMessage[] = "Heslo je povinný údaj";
		}
		if(!isset($input["login"]) || $input["login"]==""){
			$errorMessage[] = "Login je povinný údaj";
		}
		if(!self::validateMember($input["login"])){
			
			$errorMessage[] = "Tento uživatel existuje";
		}
		if(!isset($input["email"]) || $input["email"]==""){
			$errorMessage[] = "Email je povinný údaj";
		}
		if(empty($errorMessage)){
			$password_hash = hash("sha256", $input["password"]); 
			$sql = "INSERT INTO users (firstName, lastName, login, email, password, role) VALUES ('{$input["firstName"]}', '{$input["lastName"]}', '{$input["login"]}', '{$input["email"]}', '$password_hash', 2)"; 
			$result = DB::query($sql);
			if($result){
				$login = $input['login'];
				$password = $input['password']; 
				$user = User::login($login, $password);

				$last_id = DB::$conn->insert_id;
				Log::add("uspesne registrovan. login: " . $input["login"] . " Jmeno: " . $input["firstName"] . " Prijmeni: " . $input["lastName"]);
				$_SESSION["loged"] = TRUE;
				$_SESSION["id"] = $user->id;
				$_SESSION["success"][] = "Úspěšně přihlášen";
				return TRUE;
			}
			return FALSE;
		}else {
			display_errors($errorMessage); // alerty erroru
		}
		
		return FALSE;
	}



	public function update($input){
		$errorMessage = [];
		
		if(!isset($input["password"]) || $input["password"]==""){
			$errorMessage[] = "Heslo je povinný údaj";
		}else {
			$password = $_POST['password'];
			$password_check = $_POST['confirm_password'];
			
			if ($password != $password_check) {
				$errorMessage[] = "Tato hesla se neshoduji";
			}
		}


		if(!isset($input["firstName"]) || $input["firstName"]==""){
			$errorMessage[] = "Jméno je povinný údaj";
		}
		if(!isset($input["lastName"]) || $input["lastName"]==""){
			$errorMessage[] = "Příjmení je povinný údaj";
		}
		if(!isset($input["email"]) || $input["email"]==""){
			$errorMessage[] = "Email je povinný údaj";
		}
		if(empty($errorMessage)){
			$password_hash = hash("sha256", $input["password"]); 
			$fullName = $input["firstName"] . " " .  $input["lastName"];
			
			$sql = "UPDATE users SET firstName='{$input['firstName']}', lastName='{$input['lastName']}', email='{$input['email']}', password='$password_hash' WHERE id='$this->id'";
			$result = DB::query($sql);
			if($result){
				$last_id = DB::$conn->insert_id;
				Log::add("uspesne aktualizovan uživatelský profil:  " . $this->id);
				$this->loginById($this->id);
				return new User($last_id);
			}
			display_errors($errorMessage);
			Log::add("Neuspesne aktualizovan uživatelský profil. ID:  " . $this->id);
			return $errorMessage;
		}
		return $errorMessage;
	}


	public static function login($login, $password){
		$password = hash("sha256", $password); 
		$sql = "SELECT id FROM users WHERE login='$login' AND password='$password'";
		$result = DB::query($sql);
		
		if ($result) {
			$last_id = (int)$result[0]["id"];
			$user = new User($last_id);
			
			return $user;
		}else{
			return FALSE;
		}
	}

	public function updateFotky($input)
	{
		$target = "galerie/user_profile_picture/";
		$allowTypes = array('jpg','JPG','png','jpeg','gif');
		$errorMessage = [];
		
		if($_FILES['fotka']){
			// File upload path
			$fileName = basename($_FILES['fotka']['name']);
			$fileType = pathinfo($fileName,PATHINFO_EXTENSION);
			$targetFilePath = $target . $this->id . "." . $fileType;
			
			if(in_array($fileType, $allowTypes))
			{
				$oldPicture = $target . $this->getProfileImage();
				if(file_exists($oldPicture))
				{
					if(!unlink($oldPicture))
					{
						$errorMessage[] = "nepodarilo se starou smazat fotku.";
						
						return $errorMessage;
					}
				}
				if(move_uploaded_file($_FILES["fotka"]["tmp_name"], $targetFilePath))
				{
					Log::add("obrazek ulozen: $targetFilePath");
					return TRUE;
				}else
				{
					$errorMessage[] = "nepovedlo se uložit obrázek";
					Log::add("obrazek neulozen. ID uživatele: " . $this->id);
				}
			}
			else
			{
				$errorMessage[] = "nepodporuju typ souboru: " . $fileType;
			}
		}
		return $errorMessage;
	}

	public function getProfileImage()
	{
		$profilePictures = scandir('galerie/user_profile_picture');
		
		for ($i=2; $i < count($profilePictures); $i++)
		{ 
			$picture = explode(".", $profilePictures[$i]);
			if ($picture[0] == $this->id) 
			{
				return $profilePictures[$i];
			}
		}
		return FALSE;
	}


	public function getName(){
		return $this->name;
	}

	public function getId(){
		return $this->id;
	}

	public function sayHello($person){
		return "Hello ".$person->getName().", I am ".$this->getName()." and I am ".$this->age." years old.";
	}
	
}

