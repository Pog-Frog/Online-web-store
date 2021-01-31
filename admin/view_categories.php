<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="6"><h2>View All Categories</h2></td>
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
        $cat_q = mysqli_query($con, "select * from categories");
        $i = 0;
        while($row_cat = mysqli_fetch_array($cat_q)){
            $cat_id = $row_cat['category_id'];
            $pro_q = "select * from products where product_category='$cat_id'";
            $pro = mysqli_query($con, $pro_q);
            $no_pros = mysqli_num_rows($pro);
            $category = new Category($cat_id);
            $i++;
    ?>
        <tr align="center">
            <td><?php echo $i?></td>
            <td><?php echo $category->get_title()?></td>
            <td><?php echo $no_pros ?></td>
            <td><a href="index.php?edit_category=<?php echo $category->get_id()?>">Edit</a></td>
            <td><a href="delete_category.php?delete_category=<?php echo $category->get_id()?>">Delete</a></td>
        </tr>
        <?php } ?>
</table>