<?php 
    include("includes/db.php");
    include("../includes/product.php");
    if(isset($_GET['edit_category'])){
        $category = new Category($_GET['edit_category']);
    }
?>
<html>
    <head>
        <title>Edit Category</title>
    </head>
<body bgcolor="pink"> 
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Edit Category here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Category Title:</b></td>
                <td><input type="text" name="new_category" size="35" value="<?php echo $category->get_title()?>"/></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <input type="submit" name="update_category" value="Update Category"/>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update_category'])){
        $category = new Category($_GET['edit_category']);
        $category->set_title($_POST['new_category']);
        $category->update();
    }
?>