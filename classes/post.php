<?php
class Posts{
 
    // database connection and table name
    private $conn;
    private $table_name = "tblPost";
 
    // object properties
    public $pID;
    public $pTitle;
    public $pContent;
    public $cID;
    public $timestamp;
  
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create post
    function create(){
 
        // to get time-stamp for 'created' field
        $this->getTimestamp();
 
        //write query
        $query = "INSERT INTO
            " . $this->table_name . "
                SET
                    pTitle = ?, pContent = ?, cID = ?, created = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->pTitle);
        $stmt->bindParam(2, $this->pContent);
        $stmt->bindParam(3, $this->cID);
        $stmt->bindParam(4, $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }
    
    
    // used for the 'created' field when creating a product
    function getTimestamp(){
        date_default_timezone_set('Asia/Manila');
        $this->timestamp = date('Y-m-d H:i:s');
    }
    
    function readAll($page, $from_record_num, $records_per_page){
 
        $query = "SELECT
                    pID, pTitle, pContent, cID
                FROM
                    " . $this->table_name . "
                ORDER BY
                    created ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }
       
    
     function readbyChapter(){
 
        $query = "SELECT
                    pID, pTitle, pContent
                FROM
                    " . $this->table_name . "
                WHERE
                    cID = ?
                ORDER BY
                    created ASC";
     
       
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->cID);
        $stmt->execute();
     
       return $stmt;
    }
    
    
    // used for paging post
    public function countAll(){
     
        $query = "SELECT pID FROM " . $this->table_name . "";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $num = $stmt->rowCount();
     
        return $num;
    }
    
    
    
    function readOne(){
 
        $query = "SELECT
                    pTitle,pContent,cID
                FROM
                    " . $this->table_name . "
                WHERE
                    pID = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->pID);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->pTitle = $row['pTitle'];
        $this->pContent = $row['pContent'];
        $this->cID = $row['cID'];
    }
    
    function update(){
 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    pTitle = :pTitle,
                    pContent = :pContent,
                    cID  = :cID
                WHERE
                    pID = :pID";
     
        $stmt = $this->conn->prepare($query);
     
        $stmt->bindParam(':pTitle', $this->pTitle);
        $stmt->bindParam(':pContent', $this->pContent);
        $stmt->bindParam(':cID', $this->cID);
        $stmt->bindParam(':pID', $this->pID);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    // delete the post
    function delete(){
     
        $query = "DELETE FROM " . $this->table_name . " WHERE pID = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->pID);
     
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>