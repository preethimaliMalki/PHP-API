<?php

class Customer
{
    private $conn;

    public $id;
    public $name;
    public $address;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create()
    {
        $query = 'INSERT INTO customer SET name = :name, address = :address, email = :email, password = :password';
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        $stmt->execute();
        return $stmt;
    }
    public function update()
    {
        $queryUp = 'UPDATE customer SET name = :name, address = :address, email = :email, password = :password WHERE id = :id';
        $stmt = $this->conn->prepare($queryUp);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function read_all()
    {
        $query = 'SELECT * FROM customer';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function read_single()
    {
        $query = 'SELECT name,address,email,password,id FROM customer WHERE id=? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }
    public function delete_customer()
    {
        $query = 'DELETE FROM customer WHERE id=?';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }
}
