<?php 
include("header.php");

if(isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['type']) && $_GET['type'] != ''){
    
    function updateStatus($status,$id){
        global $con;
        $res = mysqli_query($con,"update book set status = '$status' where id = '$id'");
        if($res){
        redirect('books.php');
        }
    }
    $type = get_safe_value($_GET['type']);
    $id = get_safe_value($_GET['id']);
    if($type == 'active'){
        $status = 1;
        updateStatus($status,$id);
    }
    elseif($type == 'deactive'){
        $status = 0;
        updateStatus($status,$id);
    }
    elseif($type == 'delete'){
        $row = mysqli_fetch_assoc(mysqli_query($con,"select * from book where id='$id'"));
        $filename = $row['filename'];
        $res = mysqli_query($con, "delete from book where id='$id'");
        unlink(SERVER_FILE_UPLOAD.$filename);
        if($res){
            redirect('books.php');
        }
    }
    
    
}

$sql = "SELECT book.id,book.name as bookname,category.name as category, book.filename,language.name as language,book.writer,book.status
FROM book JOIN category
ON book.category_id = category.id
JOIN language
ON book.language_id = language.id";
$data = getData(mysqli_query($con,$sql));
// pre($data);
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                    <h1 class=""><a href="add_book.php">Add a book</a></h1>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th width="">S No</th>
                                        <th width="">Name</th>
                                        <th width="">Category</th>
                                        <th width="">Language</th>
                                        <th width="">Writer</th>
                                        <th width="">Status</th>
                                        <th width="">Actions</th>
                                        <th width="">Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach($data as $key => $val){
                                        ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $val['bookname'];?></td>
                                        <td><?php echo $val['category'];?></td>
                                        <td><?php echo $val['language'];?></td>
                                        <td><?php echo $val['writer']?></td>
                                        <td>
                                            <?php if($val['status']) {?>
                                            <label class="badge badge-info"><a style="color:#fff;"
                                                    href="?id=<?php echo $val['id'];?>&type=deactive">Active</a></label>
                                            <?php }else{?>
                                            <label class="badge badge-secondary"><a style="color:#fff;"
                                                    href="?id=<?php echo $val['id'];?>&type=active">Deactive</a></label>
                                            <?php  }?>
                                        </td>
                                        <td>
                                            <a href="add_book.php?id=<?php echo $val['id'];?>"
                                                class="btn btn-outline-primary btn-sm">Edit</a>
                                            <a href="?id=<?php echo $val['id'];?>&type=delete"
                                                class="btn btn-outline-danger btn-sm">Delete</a>
                                        </td>
                                        <td>
                                            <form method="post" action="download.php">
                                                <input type="hidden" name="filename"
                                                    value="<?php echo $val['filename'];?>">
                                                <button class="btn btn-outline-info btn-sm"
                                                    name="download">Download</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <?php include("footer.php")?>