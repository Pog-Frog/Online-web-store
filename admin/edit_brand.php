<?php 
    include("includes/db.php");
    include("../includes/product.php");
    if(isset($_GET['edit_brand'])){
        $brand = new Brand($_GET['edit_brand']);
    }
?>
<html>
    <head>
        <title>Edit Brand</title>
    </head>
<body bgcolor="pink"> 
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Edit Brand here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Brand Title:</b></td>
                <td><input type="text" name="new_brand" size="35" value="<?php echo $brand->get_title()?>"/></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <input type="submit" name="update_brand" value="Update Brand"/>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update_brand'])){
        $brand = new Brand($_GET['edit_brand']);
        $brand->set_title($_POST['new_brand']);
        $brand->update();
    }
?>