<?php
session_start();
include('db.php');
include('function.php');
include('constant.php');
if(isset($_SESSION['ADMIN'])){
    if(isset($_POST['download'])){
        $filename = get_safe_value($_POST['filename']);
        if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $filename)){

            $filepath = SERVER_FILE_UPLOAD.$filename;

            if(file_exists($filepath)){

                header('Content-description: File Transfer');
                header('Content-Type: application/octet-stream');//This enables the browsers to treat the file as a binary
                header('Content-Disposition: attachment; filename="'.basename($filepath).'"'); //opens download dialog box with filename
                header('Expires: 0');
                header('Cache-Control: must-revalidate');//This is because most information about the file is cached,so it's important to control the cache.
                header('Pragma: public');
                header('Content-Length: '.filesize($filepath)); //This is used to display the file size information in the download dialog box
                flush(); //flush system output buffer
                readfile($filepath);//To retrieve the actual file contents form the server,
                die();
            }else{
                http_response_code(404);
                echo "File not found";
                die();
            }
        }else{
            echo "<script>
            alert('Invalid file');
            </script>";
            redirect('books.php');
        }
    }
}else{
    redirect('login.php');
}


?>