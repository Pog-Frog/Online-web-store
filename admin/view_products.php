<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="9"><h2>View All Products</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>S.N</th>
        <th>Title</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Quantity</th>
        <th>Image</th>
        <th>Price</th>
        <th>Customers</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        include("../includes/db.php");
        include("../includes/product.php");
        $pro_q = mysqli_query($con, "select * from products");
        $i = 0;
        while($row_pro = mysqli_fetch_array($pro_q)){
            $product = new Product($row_pro['product_id']);
            $i++;
    ?>
        <tr align="center">
            <td><?php echo $i?></td>
            <td><?php echo $product->get_title()?></td>
            <td><?php echo $product->get_category()->get_title()?></td>
            <td><?php echo $product->get_brand()->get_title()?></td>
            <td><?php echo $product->get_quantity()?></td>
            <td><img src="product_images/<?php echo $product->get_image()?>" width="60" height="60"/></td>
            <td><?php echo $product->get_price()?></td>
            <td><a href="index.php?product_customers=<?php echo $product->get_id()?>">View</a></td>
            <td><a href="index.php?edit_product=<?php echo $product->get_id()?>">Edit</a></td>
            <td><a href="delete_product.php?delete_product=<?php echo $product->get_id()?>">Delete</a></td>
        </tr>
        <?php } ?>
</table>