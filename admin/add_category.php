<?php 
include('header.php');
$id = '';
$name='';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "select * from category where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
}
if(isset($_POST['submit'])){
    if($id==''){
        $name = get_safe_value($_POST['name']);
        $res = mysqli_query($con, "insert into category (name) values ('$name')");
        if($res){
            echo "<script>
                    alert('Category added');
                    </script>";
            redirect('category.php');     
        }
    }
    elseif($id){
        $name = get_safe_value($_POST['name']);
        $res = mysqli_query($con, "update category set name='$name' where id='$id'");
        if($res){
            echo "<script>
                    alert('Category updated');
                    </script>";
            redirect('category.php');     
        }
    }
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <h1 class="card-title ml10">Add category</h1>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="post">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                    name="name" value="<?php echo $name;?>" required>
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