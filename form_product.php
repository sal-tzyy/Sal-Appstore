<?php
 include 'connection.php';
 $sql='select*from tbl_category';
 $result=mysqli_query($conn,$sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <style>
        #form{
            
            padding:5px;
            width: 30%;
            height:auto;
            margin:0 auto;
            margin-Top:20px;
            background-color: #bfe1f7;
        }
        h2{
           color:orange;
           margin-Top:30px;
           
        }
    </style>
</head>
<body>
    
    <div id="form">
         <h2>Add Product</h2>
    <form action="save_product.php" method="post" enctype="multipart/form-data" >
        Product : 
        <input type="text" name="product" id=""><br><br>
        Price :   
        <input type="text" name="price" id=""><br><br>
        Quantity : 
        <input type="text" name="qty" id=""><br><br>
        Category :
         <select name="cat" id="">
            <?php
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['id'].'">'.$row['product'].'<option>';
              }
            ?>
         </select><br><br>
        Picture  : <input type="file" name="fileToUpload" id=""><br><br>
                   <input type="submit" name="submit" id="save"><br>
    </form>
</div>
</body>
</html>