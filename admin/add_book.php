<?php
include("header.php");
$msg = '';
$id = '';
$name='';
$writer="";
$category='';
$language='';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);
    $sql = "select * from book where id ='$id'";
    $row = mysqli_fetch_assoc(mysqli_query($con,$sql));
    // pre($row);
    $name = $row['name'];
    $writer = $row['writer'];
    $category_id = $row['category_id'];
    $language_id = $row['language_id'];
    $writer = $row['writer'];
}
if(isset($_POST['submit'])){
    $name = get_safe_value($_POST['name']);
    $writer = get_safe_value($_POST['writer']);
    $category_id = get_safe_value($_POST['category']);
    $language_id = get_safe_value($_POST['language']);
    $pdf = $_FILES['pdf']['name'];
    $pdf_type = $_FILES['pdf']['type'];
    if($id != ''){
        if($pdf == ''){
            $sql = "update book set name='$name',writer='$writer',category_id='$category_id',language_id='$language_id' where id='$id'";
           $res = mysqli_query($con,$sql);
           if($res){
                echo "<script>
                            alert('Data updated');
                            </script>";
                redirect('books.php');
                } 
        }else{
            if($pdf_type != "application/pdf"){
                $msg = "Invalid file";
            }else{
                // remove pdf before uploading new
                $row = mysqli_fetch_assoc(mysqli_query($con,"select * from book where id='$id'"));
                $filename = $row['filename'];
                unlink(SERVER_FILE_UPLOAD.$filename);

                $pdf = rand(1111111111,999999999).'_'.$pdf;
                move_uploaded_file($_FILES['pdf']['tmp_name'], SERVER_FILE_UPLOAD.$pdf);

                $sql = "update book set name='$name',writer='$writer',category_id='$category_id',
                language_id='$language_id',filename='$pdf' where id='$id'";
                $res = mysqli_query($con,$sql);
                if($res){
                    echo "<script>
                            alert('Data updated');
                            </script>";
                    redirect('books.php');
                }     
            }
        }

    }else{
        // echo " $category_id  $language_id";
        // pre($_POST);
        if($pdf_type != "application/pdf"){
                $msg = "Invalid file";
            }else{
            
                $pdf = rand(1111111111,999999999).'_'.$pdf;
                move_uploaded_file($_FILES['pdf']['tmp_name'], SERVER_FILE_UPLOAD.$pdf);
                $res = mysqli_query($con,"insert into book(category_id,language_id,name,writer,filename)
                values('$category_id','$language_id','$name','$writer','$pdf')");
                if($res){
                    echo "<script>
                            alert('Data added');
                            </script>";
                    redirect('add_book.php');
                }     
            }
            }
    
}
$category = getData(mysqli_query($con,"select * from category where status = 1"));
$language = getData(mysqli_query($con,"select * from language where status = 1"));
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <h1 class="card-title ml10">Add a PDF or Book</h1>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                    name="name" value="<?php echo $name;?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Writer</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                    name="writer" value="<?php echo $writer;?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Category</label>
                                <select class="form-control" id="exampleSelectGender" name="category" required>
                                    <option value="">Select category</option>
                                    <?php 
                                        foreach($category as $key=>$val){
                                            if($category_id == $val['id']){
                                                echo "<option value='".$val['id']."' selected>".$val['name']."</option>";
                                            }else{
                                                echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                            }
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Language</label>
                                <select class="form-control" id="exampleSelectGender" name="language" required>
                                    <option value="">Select language</option>
                                    <?php foreach($language as $key=>$val){
                                        if($language_id == $val['id']){
                                                echo "<option value='".$val['id']."' selected>".$val['name']."</option>";
                                            }else{
                                                echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                            } 
                                    
                                        } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Upload PDF</label>
                                <input type="file" class="form-control" placeholder="upload-pdf" name="pdf">
                                <div class="error mt-8"><?php echo $msg;?></div>

                            </div>

                            <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php include('footer.php');?>