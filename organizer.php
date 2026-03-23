<!DOCTYPE html>
<?php 
    include("includes/dataBaseConnect.php");// dataBase is $dB
    
    if(isset($_GET['id']))
       $id = $_GET['id'];
    
    $eventSql = "SELECT id, date, time, name, location from events WHERE orgId = $id ORDER BY date, time;";
    $eventResult = $dB->query($eventSql);
?>
<html lang="en">
    <head>
        <title>SignMeUp - Event Management - Organizer Home</title>
    
    	<?php include("includes/head.php"); ?>
    	
    
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header>
           <?php include("includes/nav.php"); ?>
        </header>
        <main role="main" class="container flex-grow-1" >
    	    <h3>Organizer Home</h3>
    	    
    	    <ul class="list-group border border-dark mb-4">
            <?php
                while($eventRow = $eventResult->fetch_assoc())
                {// start while
                    $name = $eventRow['name'];
                    $date = $eventRow['date'];
                    $time = $eventRow['time'];
                    $location = $eventRow['location'];
                    
                    // Get list of all users subbed to that event
                    $id = $eventRow['id'];
                    $partSql = "SELECT DISTINCT users.firstName, users.lastName, users.email, users.phone FROM participant JOIN users ON users.id = participant.userId WHERE participant.eventId = $id ORDER BY users.lastName, users.firstName;";
                    $partResult = $dB->query($partSql);
                    
            ?>
                   
            <li class="list-group-item fw-bold events"><?php echo"$date - $time - $name - $location" ?>
                <br>
                <div class="users">
                    <ol class="list-group border border-dark">
                        <?php
                            while ($partRow =$partResult->fetch_assoc())
                            {
                                $userLast = $partRow['lastName'];
                                $userFirst = $partRow['firstName'];
                                $userEmail = $partRow['email'];
                                $userPhone = $partRow['phone'];
                        ?>     
                        
                            <li class="list-group-item"><?php echo "$userLast, $userFirst, " ?><a href="https://www.youtube.com/watch?v=Aq5WXmQQooo"><?php echo $userEmail?></a>, 
                            <?php echo $userPhone ?>
                            </li>
                            
                           <?php } ?>
                    </ol>
                </div>
            </li> 
            <?php
                }// end while
            ?>
        </ul>
    
    	
    	
    
        </main><!-- /.container -->
        <?php include("includes/footer.php"); ?>
    </body>
    
</html>