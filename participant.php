<!DOCTYPE html>

<?php 
    include("includes/dataBaseConnect.php");// dataBase is $dB
    
    if(isset($_GET['id']))
       $id = $_GET['id'];
    
    $sql = "SELECT name, date, time, location from events JOIN participant ON events.id = participant.eventId WHERE participant.userId = $id ORDER BY date, time;";
    $result = $dB->query($sql);
?>

<html lang="en">
    <head>
        <title>SignMeUp - Event Management - Participant Home</title>
    
    	<?php include("includes/head.php"); ?>
    
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header>
           <?php include("includes/nav.php"); ?>
        </header>
        <main role="main" class="container flex-grow-1" >
    	    <h3>Participant Home</h3>
    	    
    	    <table class="table">
    	        
    	        <thead>
    	            <tr>
    	                <th>Name</th> <th>Location</th> <th>Date</th> <th>Time</th>
    	            </tr>
    	        </thead>
    	        <tbody>
    	                <?php 
    	                    while($row = $result->fetch_assoc())
    	                    {
    	                        $name = $row['name'];
    	                        $time = $row['time'];
    	                        $date = $row['date'];
    	                        $location = $row['location'];
    	               ?>
    	               <tr>
    	                    <td><?php echo $name ?></td> <td><?php echo $location ?></td> <td><?php echo $date ?></td> <td><?php echo $time ?></td>
    	               </tr> 
    	               <?php } ?>
    	                
    	        </tbody>
    	    </table>
    
    	
    	
    
        </main><!-- /.container -->
        <?php include("includes/footer.php"); ?>
    </body>
</html>