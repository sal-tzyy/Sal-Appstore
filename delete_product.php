<?php
include 'connection.php';
//$id= $_GET['id'];
$id= $_POST['id'];

//$sql= 'delete from tbl_product where id =' .$id;
$sql= 'Update tbl_product set status = 0 where id =' .$id;
if (mysqli_query($conn, $sql)){
  echo "Record has delete. <br> Delete SuccessFully...!";
}else {
    echo "Can not delete this record ....<br> Please check again...!";
}
?>