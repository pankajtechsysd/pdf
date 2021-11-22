<?php
function pre($arr){
    echo "<pre>";
    print_r($arr);
    die();
}
function get_safe_value($str){
    global $con;
    $str = strip_tags($str);
    $str = mysqli_real_escape_string($con,$str);
    return $str;
}

function redirect($link){
    ?>
<script>
window.location.href = '<?php echo $link;?>';
</script>
<?php
    die();
}

function getData($query){
    $arr = [];
    while($row = mysqli_fetch_assoc($query)){
        $arr[] = $row;
    }
    return $arr;
}
?>