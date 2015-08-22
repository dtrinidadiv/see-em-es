<?php
$page_title = "Chapters";
include_once "header.php";

 
    // page given in URL parameter, default page is one
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
     
    // set number of records per page
    $records_per_page = 3;
     
    // calculate for the query LIMIT clause
    $from_record_num = ($records_per_page * $page) - $records_per_page;
    
    // include database and object files
    include_once '../classes/database.php';
    include_once '../classes/chapter.php';
    include_once '../classes/post.php';
     
    // instantiate database and post object
    $database = new Database();
    $db = $database->getConnection();
     
    $chapter = new Chapters($db);
     
    // query post
    $stmt = $chapter->readAll($page, $from_record_num, $records_per_page);
    $num = $stmt->rowCount();
     
    // display the products if there are any
    if($num>0){
     
        $chapter = new Chapters($db);
     
        echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Description</th>";
                echo "<th>Actions</th>";
            echo "</tr>";
     
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     
                extract($row);
     
                echo "<tr>";
                    echo "<td>{$cTitle}</td>";
                    echo "<td>{$cDesc}</td>";
    
     
                 
                       echo "<td>";
                        // edit and delete button is here
                            echo "<a href='update_chapter.php?cID={$cID}' class='btn btn-primary left-margin'>Edit</a>";
                            echo "<a delete-id='{$cID}' class='btn btn-danger delete-object'>Delete</a>";
                        echo "</td>";
               
     
                echo "</tr>";
     
            }
            
            
     
        echo "</table>";
     
        // paging buttons will be here
         include_once 'paging_chapter.php'; 
    }
     
    // tell the user there are no products
    else{
        echo "<div>No products found.</div>";
    }
    


?>
<div class="form-group pull-right">
<a type="button" class="btn btn-sm btn-warning" href="create_chapter.php" >
    <span class="glyphicon glyphicon-plus-sign"></span> Create Chapter
  </a>
  <a type="button" class="btn btn-sm btn-warning"  href="create_post.php" >
    <span class="glyphicon glyphicon-pencil"></span> Create Post
  </a>
  <a type="button" class="btn btn-sm btn-warning"  href="read_chapter.php">
    <span class="glyphicon glyphicon-search"></span> View Chapter
  </a>
  <a href="index.php" type="button" class="btn btn-sm btn-warning">
  <span class="glyphicon glyphicon-list-alt"></span> View Post</a>
 
 </div> 


  
<script>
$(document).on('click', '.delete-object', function(){
         
    var id = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
    
    if (q == true){
 
        $.post('delete_chapter.php', {
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
 
    }
         
    return false;
});
</script>
<?php
include_once "footer.php";
?>
