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
    public $fourth_rep_date;
    public $is_fourth_done;
    public $fiveth_rep_date;
    public $is_fiveth_done;

    // consturcor for class Word
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to add a new word in db
    public function add($add_days)
    {
        $days_rep = [$add_days + 0, $add_days + 1, $add_days + 3, $add_days + 7, $add_days + 30];
        // Запит на додавання нового користувача в БД
        $query = "SET time_zone = '-7:00';
                INSERT INTO " . $this->table_name . "
                    SET
                        word = :word,
                        type = :type,
                        definition = :definition,
                        examples = :examples,
                        user_id = :user_id,
                        added_date = NOW(),
                        first_rep_date = DATE_ADD(NOW(), INTERVAL " . $days_rep[0] . " DAY),
                        second_rep_date = DATE_ADD(NOW(), INTERVAL  " . $days_rep[1] . "  DAY),
                        third_rep_date = DATE_ADD(NOW(), INTERVAL  " . $days_rep[2] . "  DAY),
                        fourth_rep_date = DATE_ADD(NOW(), INTERVAL  " . $days_rep[3] . "  DAY),
                        fiveth_rep_date = DATE_ADD(NOW(), INTERVAL  " . $days_rep[4] . "  DAY)";
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
    
    public function get_number_of_words_for_the_day($add_days) {
        
        $add_days--; // to prevent 1 day difference
        
        $query = "SELECT COUNT(*) AS row_count 
                    FROM " . $this->table_name . "
                    WHERE first_rep_date = DATE_ADD(CURDATE(), INTERVAL " . $add_days . " DAY);";

        $statement = $this->conn->prepare($query);
        
        
        
        // Execute the query
        $statement->execute();
        
        // Fetch the result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
}