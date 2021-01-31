<?php 
    include("includes/db.php");
    include("../includes/product.php");
?>
<html>
    <head>
        <title>Inserting Category</title>
    </head>
<body bgcolor="pink"> 
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Insert new Category here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Category Title:</b></td>
                <td><input type="text" name="new_category" size="35" required/></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <input type="submit" name="add_category" value="Add Category"/>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['add_category'])){
        $category = new Category();
        $category->set_title($_POST['new_category']);
        $category->insert();
    }
?>