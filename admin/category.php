<?php 
include("header.php");
if(isset($_GET['id']) && $_GET['id'] != '' && isset($_GET['type']) && $_GET['type'] != ''){
    
    function updateStatus($status,$id){
        global $con;
        $res = mysqli_query($con,"update category set status = '$status' where id = '$id'");
        if($res){
        redirect('category.php');
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
        $res = mysqli_query($con, "delete from category where id='$id'");
        if($res){
            redirect('category.php');
        }
    }
    
    
}
$res = mysqli_query($con, "select * from category order by name");
$data = getData($res);
// pre($data);
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                    <h1 class=""><a href="add_category.php">Add Category</a></h1>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($data as $key=>$val){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $val['name'];?></td>
                                        <td>
                                            <?php if($val['status']){?>
                                            <label class="badge badge-info"><a style="color:#fff;"
                                                    href="?id=<?php echo $val['id'];?>&type=deactive">Active</a></label>
                                            <?php }else{
                                                ?>
                                            <label class="badge badge-secondary"><a style="color:#fff;"
                                                    href="?id=<?php echo $val['id'];?>&type=active">Deactive</a></label>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-primary"
                                                href="add_category.php?id=<?php echo $val['id'];?>">Edit</a>
                                            <a class="btn btn-outline-danger"
                                                href="?id=<?php echo $val['id'];?>&type=delete">Delete</a>
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