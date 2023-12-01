<?php

class User
{
    // Підключення до таблиці "users"
    private $conn;
    private $table_name = "users";

    // Властивості
    public $id;
    public $name;
    public $password;

    // Конструктор класа User
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function login() {
            if(!$this->name) return false;
            $sql = "SELECT password, rights FROM " . $this->table_name . " WHERE name = '$this->name'";
            $result = $this->conn->query($sql);
            $row = $result->fetch();
            if($row['password'] == $this->password) {
                $this->rights = $row['rights'];
                return true;
            } else {
                return false;
            }
        $this->conn->close();
    }
    
    // function get_status($email) {
    //         $sql = "SELECT status FROM users WHERE email = '$email'";
    //         $result = $this->conn->query($sql);
    //         $row = $result->fetch();
    //         return $row['status'];
    //     // Close the database connection
    //     $this->conn->close();
    // }
    

    // Метод для створення нового користувача
    // function create()
    // {
    //     // Запит на додавання нового користувача в БД
    //     $query = "INSERT INTO " . $this->table_name . "
    //             SET
    //                 email = :email,
    //                 password = :password,
    //                 status = 'waiting'";

    //     // Підготовка запиту
    //     $stmt = $this->conn->prepare($query);

    //     // Ін'єкція
    //     $this->email = htmlspecialchars(strip_tags($this->email));
    //     $this->password = htmlspecialchars(strip_tags($this->password));

    //     // Прив'язуємо значення
    //     $stmt->bindParam(":email", $this->email);

    //     // Для захисту пароля
    //     // Хешуємо пароль перед береженням в БД
    //     $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    //     $stmt->bindParam(":password", $password_hash);

    //     // Виконуємо запит
    //     // Якщо запит виконано успішно, то повертаємо TRUE
    //     if ($stmt->execute()) {
    //         return true;
    //     }
    //     return false;
    // }

    // Перевірка, чи існує email в БД
    // function emailExists() {
    //     // Запит для перевірки існування
    //     $query = "SELECT id, password
    //             FROM " . $this->table_name . "
    //             WHERE email = ?
    //             LIMIT 0,1";
    
    //     // Підготовка запиту
    //     $stmt = $this->conn->prepare($query);
    
    //     // Ін'єкція
    //     $this->email=htmlspecialchars(strip_tags($this->email));
    
    //     // Прив'язуємо значення до email
    //     $stmt->bindParam(1, $this->email);
    
    //     // Виконуємо запит
    //     $stmt->execute();
    
    //     // Отримуємо кількість рядків
    //     $num = $stmt->rowCount();
    
    //     // Якщо електронна пошта існує,
    //     // Присвоїмо значення властивостям об'єкта для легкого доступу та використання для php сессії
    //     if ($num > 0) {
    
    //         // Отримуємо значення
    //         $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //         // Присвоїмо значення властивостям об'єкта
    //         $this->id = $row["id"];
    //         $this->password = $row["password"];
    
    //         // Повернемо TRUE, тому що в БД існує дана електронна пошта
    //         return true;
    //     }
    //     // Повернемо FALSE, якщо даної електронної пошти ще не існує в БД
    //     return false;
    // }

}