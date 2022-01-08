<!DOCTYPE>
<?php 
    include("includes/db.php");
    include("../includes/product.php");
?>
<html>
    <head>
        <title>Inserting Product</title>
    </head>
<body bgcolor="pink"> 
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Insert new Post here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Product Title:</b></td>
                <td><input type="text" name="product_title" size="50" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Category:</b></td>
                <td>
                    <select name="product_category" required>
                        <option>Select a category</option>
                        <?php
                            $get_cats = "select * from categories";
                            $run_cats = mysqli_query($con, $get_cats);
                            while($row_cats = mysqli_fetch_array($run_cats)){
                                $cat_id = $row_cats['category_id'];
                                $cat_title = $row_cats['category_title'];
                                echo "<option value='$cat_id'>$cat_title</option>";
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Brand:</b></td>
                <td>
                    <select name="product_brand" required>
                    <option>Select a Brand</option>
                    <?php
                        $get_brands = "select * from brand";
                        $run_brands = mysqli_query($con, $get_brands);
                        while($row_brands = mysqli_fetch_array($run_brands)){
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Image:</b></td>
                <td><input type="file" name="product_image" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Price:</b></td>
                <td><input type="text" name="product_price" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Quantity:</b></td>
                <td><input type="text" name="product_quantity" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Describtion:</b></td>
                <td><textarea name="product_description" cols="40" rows="10"></textarea></td>
            </tr>
            <tr>
                <td align="right"><b>Product Keywords:</b></td>
                <td><input type="text" name="product_keywords" size="60" required/></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="insert_post" value="Insert Product"/></td>
            </tr>
            </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['insert_post'])){
        $product = new Product();
        $category = new Category($_POST['product_category']);
        $brand = new Brand($_POST['product_brand']);
        $product->set_title($_POST['product_title']);
        $product->set_category($category);
        $product->set_brand($brand);
        $product->set_price($_POST['product_price']);
        $product->set_describtion($_POST['product_description']);
        $product->set_keywords($_POST['product_keywords']);
        $product->set_quantity($_POST['product_quantity']);
        $product->set_image($_FILES['product_image']['name']);
        $product_image = $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'],"product_images/$product_image");
        $product->insert();
    }
?>