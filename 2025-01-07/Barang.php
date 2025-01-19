<?php
class Barang {
    private $conn;
    private $table_name = "barang";

    public $id;
    public $nama_barang;
    public $harga;
    public $stok;
    public $gambar;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_barang=:nama_barang, harga=:harga, stok=:stok, gambar=:gambar";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":gambar", $this->gambar);
        return $stmt->execute();
    }

    // Read All
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read Single
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->nama_barang = $row['nama_barang'];
        $this->harga = $row['harga'];
        $this->stok = $row['stok'];
        $this->gambar = $row['gambar'];
    }

    // Update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_barang=:nama_barang, harga=:harga, stok=:stok, gambar=:gambar WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":gambar", $this->gambar);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    // Delete
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
