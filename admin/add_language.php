<?php
include('header.php');
$name = '';
$id = '';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $id = get_safe_value($_GET['id']);
    $res = mysqli_query($con, "select * from language where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $name = $row['name'];
}
if(isset($_POST['submit'])){
    $name = get_safe_value($_POST['name']);
    if($id == ''){
        $res = mysqli_query($con,"insert into language (name) values ('$name')");
        if($res){
            echo "<script>
                    alert('Language added');
                    </script>";
            redirect('language.php');
        }
    }
    elseif($id){
        $res = mysqli_query($con, "update language set name = '$name' where id = '$id'");
        if($res){
            echo "<script>
                    alert('Language updated');
                    </script>";
            redirect('language.php');
        }
    }
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <h1 class="card-title ml10">Add language</h1>
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="post">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="exampleInputName1"
                                    placeholder="Enter Language" name="name" value="<?php echo $name;?>" required>
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
    <?php
include('footer.php');
?>