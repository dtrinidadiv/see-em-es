<?php
	 // get database connection
    include_once '../classes/database.php';
 	include_once '../classes/chapter.php';
 	include_once '../classes/post.php';
 	
    $database = new Database();
    $db = $database->getConnection();

                
    $chapter = new Chapters($db);
    $post = new Posts($db);
	$stmt = $chapter->read();
	$stmt2 = $chapter->read();
	
								
							
                 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Multimedia Images</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="all" href="../css/style.css">
    <link rel="stylesheet" type="text/css" media="all" href="../css/animate.css">

  </head>
  <body>


    <div class="container-fluid">
	<div class="row" >
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					<small>Welcome in</small>
					Multimedia Images
				</h1>
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-8" >
			<ul class="breadcrumb" >
				<li>
					<a href="userMain.html">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="quizzes.html">Quizzes</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="activities.html">Activities</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Handouts</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">About Us</a> <span class="divider">/</span>
				</li>
				
			</ul>
		</div>
		<div class="col-md-2">
			
			<img class="fpic" src="../images/fpic.jpg"> <a>Fname Lname</a>
		</div>
		<div class="col-md-2">
			<div class="btn-group">
				 
				<button class="btn btn-default">
					Action
				</button> 
				<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a href="#">Action</a>
					</li>
					<li class="disabled">
						<a href="#">Another action</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="index.html">Logout</a>
					</li>
				</ul>
			</div>
		</div>

		<br>

	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="heading-msg">
			<h3>
				Structured Tutorial Plan
			</h3>
			<p>
				The lesson plan for this Computer Assisted Instruction will focused on Multimedia Fundamental about Images. It covers the discussion and demonstration about Digital image, Digital Editing and digital Photography.
			</p>
			<p>
				<a class="btn" href="#">View details »</a>
			</p>
			</div>

	<div class="tabbable" id="tabs-721418">
				<div class="post">
					<ul class="nav nav-tabs">
			<?php $count = 0;?>
			

			
						
		<?php while ($row_chapter = $stmt->fetch(PDO::FETCH_ASSOC)){
				 extract($row_chapter);
		?>
					
				<?php if($count == 0){?>
						<li class="active">
							<a  href="#chapter-<?php echo $cID; ?>" data-toggle="tab"><?php echo $cTitle; ?></a>
						</li>
				<?php }else {?>
				<li >
							<a  href="#chapter-<?php echo $cID; ?>" data-toggle="tab"><?php echo $cTitle; ?></a>
						</li>
				
				<?php }?>
				<?php $count=$count+1;?>
		<?php } ?>
			</ul>
			
		
		
				<?php $count = 0;?>
			<div class="tab-content">
					
	<?php $x = new Posts($db);?>

		<?php while ($row_chapter = $stmt2->fetch(PDO::FETCH_ASSOC)){
				 extract($row_chapter);
		?>
							<?php $x->cID = $cID?>	
									<?php $stmt3 = $x->readbyChapter() ?>	
					
				<?php if($count == 0){?>
						<div class="tab-pane active" id="chapter-<?php echo $cID; ?>">
						<h2><p><?php echo $cTitle . ": " .  $cDesc; ?></p></h2>
								
								<li>
										<?php foreach ( $stmt3 as $post ) : ?>
				
										<h3><a href="#"><?php echo $post['pTitle']; ?></a></h3>
									<?php endforeach; ?>
								</li>
								
									
													
						</div>
						
				<?php }else {?>
						<div class="tab-pane" id="chapter-<?php echo $cID; ?>">
						<h2><p><?php echo $cTitle. ": " .   $cDesc; ?></p></h2>
						
							
								<li>
										<?php foreach ( $stmt3 as $post ) : ?>
				
										<h3><a href="#"><?php echo $post['pTitle']; ?></a></h3>
									<?php endforeach; ?>
									
								</li>	
							
								
									
													
						</div>
				
				<?php }?>	
				
					
						
				
				
				
				
				
				<?php $count=$count+1;?>
				
				
		<?php } ?>
		
								
			

			</div>
			</div>
			</div>

		
</div>
		<br>

		<div class="col-md-4">
			<div class="sideBar">
			<!--<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Panel title
					</h3>
				</div>
				<div class="panel-body">
					Panel content
				</div>
				<div class="panel-footer">
					Panel footer
				</div>
			</div>-->
			<blockquote>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
				</p> <small>Someone famous <cite>Source Title</cite></small>
			</blockquote>
		</div>
	</div>
	</div>

	<br>
	<div class="baba">	
	<div class="row">
		<div class="col-md-4">
			 <center>
			<address>
				 <strong>Copyright © 2015 </strong><br /> UNC Naga, Suite 600<br /> Philippines, PH 4400<br /> <abbr title="Phone">P:</abbr> (123) 09091019090
			</address>
			</center>
		</div>
		<div class="col-md-4">
			 <center>
			<address>
				 <strong>Copyright © 2015 </strong><br /> UNC Naga, Suite 600<br /> Philippines, PH 4400<br /> <abbr title="Phone">P:</abbr> (123) 09091019090
			</address>
			</center>
		</div>
		<div class="col-md-4">
			 <center>
			<address>
				 <strong>Copyright © 2015 </strong><br /> UNC Naga, Suite 600<br /> Philippines, PH 4400<br /> <abbr title="Phone">P:</abbr> (123) 09091019090
			</address>
			</center>
		</div>
	</div>
</div>
</div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>

 
  </body>
</html>