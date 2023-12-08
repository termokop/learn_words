<?php

class Word
{
    // connect to table 'words'
    public $conn;
    private $table_name = "words";

    // Properties
    public $id;
    public $word;
    public $type;
    public $definition;
    public $examples;
    public $user_id;
    public $added_date;
    public $first_rep_date;
    public $is_first_done;
    public $second_rep_date;
    public $is_second_done;
    public $third_rep_date;
    public $is_thirth_done;
    public $forth_rep_date;
    public $is_forth_done;

    // consturcor for class Word
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to add a new word in db
    public function add()
    {
        // Запит на додавання нового користувача в БД
        $query = "INSERT INTO " . $this->table_name . "
                    SET
                        word = :word,
                        type = :type,
                        definition = :definition,
                        examples = :examples,
                        user_id = :user_id,
                        added_date = NOW(),
                        first_rep_date = DATE_ADD(NOW(), INTERVAL 1 DAY),
                        second_rep_date = DATE_ADD(NOW(), INTERVAL 3 DAY),
                        third_rep_date = DATE_ADD(NOW(), INTERVAL 7 DAY),
                        fourth_rep_date = DATE_ADD(NOW(), INTERVAL 30 DAY)";
        // prepare query
        $stmt = $this->conn->prepare($query);

        // Injection
        $this->word = htmlspecialchars(strip_tags($this->word));
        $this->type = htmlspecialchars(strip_tags($this->type));
        // $this->definition = htmlspecialchars(strip_tags($this->definition));
        // $this->examples = htmlspecialchars(strip_tags($this->examples));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        // Bind params
        $stmt->bindParam(":word", $this->word);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":definition", $this->definition);
        $stmt->bindParam(":examples", $this->examples);
        $stmt->bindParam(":user_id", $this->user_id);
        // execute request
        if ($stmt->execute()) {
            return true; // if success -> new word will be saved to DB
        }
        
        return false;
    }
}