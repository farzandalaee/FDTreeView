<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Lang" content="en">
        <meta name="author" content="Farzan Dalaee">
        <meta http-equiv="Reply-to" content="farzan.dalaee@gmail.com">
        <meta name="generator" content="PhpED 8.0">
        <meta name="description" content="PHP Tree View Manager (ADD - EDIT - DELETE) is php class for manage tree structures mysql tables using jquery and bootstrap">
        <meta name="keywords" content="FDTree View | TreeView | mysql tree">
        <title>FDTree View</title>
    </head>
    <body>
        <!--    Add jQuery    -->
        <script type="text/javascript" src="jquery.js"></script>
        <!--   Add Css File     -->
        <link rel="stylesheet" type="text/css" href="FDTree.css">
        <!--   Add Font Awesome   -->
        <link rel="stylesheet" type="text/css" href="awesome/css/font-awesome.min.css">
        
        <?php
            include 'class.FDTree.php';
            include 'config/config.php';

            $tree = new FDTree('countries','id','title','parent_id','ajaxTree.php','images/','FDTree','Are You Sure To Delete This Node?');
            echo $tree->tree;
        ?>
    </body>
</html>


