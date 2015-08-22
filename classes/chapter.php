<?php
class Chapters{
    
  // database connection and table name
    private $conn;
    private $table_name = "tblChapter";
 
    // object properties
    public $cID;
    public $cTitle;
    public $cDesc;
 
    public function __construct($db){
        $this->conn = $db;
    }
    
      // create chapter
    function create(){
 
    
 
        //write query
        $query = "INSERT INTO
            " . $this->table_name . "
                SET
                    cTitle = ?, cDesc = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->cTitle);
        $stmt->bindParam(2, $this->cDesc);

 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    
    
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    cID, cTitle, cDesc
                FROM
                    " . $this->table_name . "
                ORDER BY
                    cTitle";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    
    // used to read chapter name by its ID
    function readName(){
         
        $query = "SELECT cTitle FROM " . $this->table_name . " WHERE cID = ? limit 0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->cID);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $this->cTitle = $row['cTitle'];
    }
    
    function readAll($page, $from_record_num, $records_per_page){
 
        $query = "SELECT
                    cID,cTitle, cDesc
                FROM
                    " . $this->table_name . "
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }
       
       // used for paging chapter
    public function countAll(){
     
        $query = "SELECT cID FROM " . $this->table_name . "";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $num = $stmt->rowCount();
     
        return $num;
    }
    
     function readOne(){
 
        $query = "SELECT
                    cTitle,cDesc
                FROM
                    " . $this->table_name . "
                WHERE
                    cID = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->cID);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->cTitle = $row['cTitle'];
        $this->cDesc = $row['cDesc'];
    }
    
 
    
     function update(){
 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    cTitle = :cTitle,
                    cDesc = :cDesc
                WHERE
                    cID = :cID";
     
        $stmt = $this->conn->prepare($query);
     
        $stmt->bindParam(':cTitle', $this->cTitle);
        $stmt->bindParam(':cDesc', $this->cDesc);
        $stmt->bindParam(':cID', $this->cID);
   
      
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    // delete the chapter
    function delete(){
     
        $query = "DELETE FROM " . $this->table_name . " WHERE cID = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->cID);
     
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}

?>