<?php
    include("header.php");
    if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && $_GET['type'] != ''){
        $id = get_safe_value($_GET['id']);
        $type = get_safe_value($_GET['type']);

        if($type == 'delete'){
            $res = mysqli_query($con,"delete from messages where id = '$id'");
            if($res){
                redirect('messages.php');
            }
        }
    }
    $data = getData(mysqli_query($con,"select * from messages")); 
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>

                                        <!-- <th>Status</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $key => $val){
                                    ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>

                                        <td><?php echo $val['name'];?></td>
                                        <td><?php echo $val['email'];?></td>
                                        <td><?php echo $val['message'];?></td>
                                        <!-- <td>
                                            <label class="badge badge-info">On hold</label>
                                        </td> -->
                                        <td>
                                            <a class="btn btn-outline-danger"
                                                href="?id=<?php echo $val['id'];?>&type=delete">Delete</a>
                                        </td>
                                    </tr>
                                    <?php }?>
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
    <?php
    include("footer.php"); 
    ?>