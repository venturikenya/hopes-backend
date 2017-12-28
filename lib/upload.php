<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');

$succesful = array();

if (isset($_FILES['files']) && !empty($_FILES['files'])) {


    $no_files = count($_FILES["files"]['name']);



    for ($i = 0; $i < $no_files; $i++) {


        if ($_FILES["files"]["error"][$i] > 0) {

        	//file upload error


            echo '{"status","error","message":"error uploading file"}';
        }

         else { //file already exists


            if (file_exists('../ui/assets/images/' . $_FILES["files"]["name"][$i])) {



                echo '{"status","error","message":"file already exists"}';
            } 


            else {

            	//file upload succesful



                move_uploaded_file($_FILES["files"]["tmp_name"][$i], '../ui/assets/images/' . $_FILES["files"]["name"][$i]);

                array_push($succesful, $_FILES["files"]["name"][$i]);


                echo '{"status","success","message":"file uploaded successfully"}';
            }
        }
    }

    
}


exit;
