<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $pdo;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // PDO bağlantısını oluştur
        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Bağlantı hatası: " . $e->getMessage());
        }
    }

    // Yeni bir kayıt ekler
    public function create($data)
    {
        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

            $query = "INSERT INTO your_table_name ($columns) VALUES ($values)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);

            return true;
        } catch (PDOException $e) {
            die("Oluşturma hatası: " . $e->getMessage());
        }
    }

    // Belirli bir ID'ye sahip kaydı getirir
    public function read($id)
    {
        try {
            $query = "SELECT * FROM your_table_name WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Okuma hatası: " . $e->getMessage());
        }
    }

    // Belirli bir ID'ye sahip kaydı günceller
    public function update($id, $data)
    {
        try {
            $set = "";
            foreach ($data as $key => $value) {
                $set .= "$key=:$key, ";
            }
            $set = rtrim($set, ', ');

            $query = "UPDATE your_table_name SET $set WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute($data);

            return true;
        } catch (PDOException $e) {
            die("Güncelleme hatası: " . $e->getMessage());
        }
    }

    // Belirli bir ID'ye sahip kaydı siler
    public function delete($id)
    {
        try {
            $query = "DELETE FROM your_table_name WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Silme hatası: " . $e->getMessage());
        }
    }
}

// Kullanım örneği
$database = new Database("localhost", "username", "password", "database_name");

// Yeni kayıt ekleme
$newData = array("column1" => "value1", "column2" => "value2");
$database->create($newData);

// Belirli bir ID'ye sahip kaydı getirme
$record = $database->read(1);
print_r($record);

// Belirli bir ID'ye sahip kaydı güncelleme
$updateData = array("column1" => "new_value1", "column2" => "new_value2");
$database->update(1, $updateData);

// Belirli bir ID'ye sahip kaydı silme
$database->delete(1);

?>
