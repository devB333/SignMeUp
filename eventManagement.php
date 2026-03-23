<!DOCTYPE html>

<?php 
    include("includes/dataBaseConnect.php");// dataBase is $dB
    $eventSql = "SELECT id, date, time, name, location from events ORDER BY date, time;";
    $eventResult = $dB->query($eventSql);
?>


<html lang="en">
    <head>
        <title>SignMeUp - Event Management - Admin Home</title>
    
    	<?php include("includes/head.php"); ?>
    	
    	<style>
    	    .users{
    	        display: none;
    	    }
    	    
    	    
            .events:hover {
                text-decoration: underline;
                cursor: pointer;
            }
    	</style>
    
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header>
           <?php include("includes/nav.php"); ?>
        </header>
       <main role="main" class="container flex-grow-1" >
    	    <h3>Admin Home - Event Management</h3>
    
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
                    <ol class="list-group list-group-numbered border border-dark">
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
        <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('.events').click(function(){
                $(this).children().slideToggle();
            })// end events click
        });// end start jquery
    </script>
    </body>
</html>