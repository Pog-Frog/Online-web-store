<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="6"><h2>View All Brands</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>S.N</th>
        <th>Title</th>
        <th>No of products</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        include("../includes/db.php");
        include("../includes/product.php");
        $brand_q = mysqli_query($con, "select * from brand");
        $i = 0;
        while($row_brand = mysqli_fetch_array($brand_q)){
            $brand_id = $row_brand['brand_id'];
            $pro_q = "select * from products where product_brand='$brand_id'";
            $pro = mysqli_query($con, $pro_q);
            $no_pros = mysqli_num_rows($pro);
            $brand = new Brand($brand_id);
            $i++;
    ?>
        <tr align="center">
            <td><?php echo $i?></td>
            <td><?php echo $brand->get_title()?></td>
            <td><?php echo $no_pros ?></td>
            <td><a href="index.php?edit_brand=<?php echo $brand->get_id()?>">Edit</a></td>
            <td><a href="delete_brand.php?delete_brand=<?php echo $brand->get_id()?>">Delete</a></td>
        </tr>
        <?php } ?>
</table>