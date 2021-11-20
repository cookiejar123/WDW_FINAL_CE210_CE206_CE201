<?php
   
   require('connection.php');

   $request= json_decode(file_get_contents('php://input'),true);

   if(isset($request['name'])){
       
       $query = mysqli_query($conn,"select `email` from `user` where `email` = '".$request['name']."' limit 1");


        if(mysqli_num_rows($query) >= 1)
        {
            echo json_encode(true);
        }
        else{
            // echo json_encode(false);
            echo json_encode(false);
        }

    }

?>
