<?php
include("header.php");
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
        redirect('index.php');  
    }
}
$sql = "select book.name, book.writer, book.filename,category.name as category,language.name as language from book 
JOIN category
ON book.category_id = category.id
JOIN language
ON book.language_id = language.id
where book.status = 1
order by book.name";
$book = getData(mysqli_query($con,$sql));
// pre($book);
?>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Writer</th>
                            <th scope="col">Language</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        foreach($book as $key=>$val){
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i;?></th>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo $val['category'];?></td>
                            <td><?php echo $val['writer'];?></td>
                            <td><?php echo $val['language'];?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="filename" value="<?php echo $val['filename'];?>">
                                    <button class="btn btn-danger btn-sm" name="download">Download</button>
                                </form>
                            </td>

                        </tr>
                        <?php
$i++;
}
?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <p>

                        </p>
                    </div>
                    <div class="col-md-12">
                        <p>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>