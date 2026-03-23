        <?php
            $dB = new mysqli("localhost", "borys_devUser", "Db588407200511!", "borys_SignMeUp");
            if($dB->connect_error)
                echo "error". $dB->connect_error;
        ?>