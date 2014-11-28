<?php
    include "config/config.php";
    //  Update Noe
    if(isset($_POST['ajaxUpdateNode']) && isset($_POST['ajaxTreePrimaryField']) && isset($_POST['ajaxTreeTitleField']) && isset($_POST['ajaxTreeParentField']) && isset($_POST['ajaxTreeTblName']) && isset($_POST['ajaxUpdateID']) && $_POST['ajaxTreePrimaryField'] != '' && $_POST['ajaxTreeTitleField'] != '' && $_POST['ajaxTreeParentField'] && $_POST['ajaxTreeTblName'] != '' && $_POST['ajaxUpdateID'] != '')
    {
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $mysqli->query("SET NAMES utf8;");
        $sql = "UPDATE ".$_POST['ajaxTreeTblName']." SET ".$_POST['ajaxTreeTitleField']." = '".$_POST['ajaxUpdateNode']."' WHERE ".$_POST['ajaxTreePrimaryField']." = ".$_POST['ajaxUpdateID'];
        if($mysqli->query($sql))
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }
    }
    //  Add Sub Noe
    if(isset($_POST['ajaxAddNode']) && isset($_POST['ajaxTreePrimaryFieldAdd']) && isset($_POST['ajaxTreeTitleFieldAdd']) && isset($_POST['ajaxTreeParentFieldAdd']) && isset($_POST['ajaxTreeTblNameAdd']) && isset($_POST['ajaxAddID']) && $_POST['ajaxTreePrimaryFieldAdd'] != '' && $_POST['ajaxTreeTitleFieldAdd'] != '' && $_POST['ajaxTreeParentFieldAdd'] && $_POST['ajaxTreeTblNameAdd'] != '' && $_POST['ajaxAddID'] != '')
    {
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        $mysqli->query("SET NAMES utf8;");
        $sql = "INSERT INTO ".$_POST['ajaxTreeTblNameAdd']." (".$_POST['ajaxTreeTitleFieldAdd']." ,".$_POST['ajaxTreeParentFieldAdd']." )VALUES('".$_POST['ajaxAddNode']."',".$_POST['ajaxAddID']." )";
        if($mysqli->query($sql))
        {
            $sqlGetLast = 'SELECT '.$_POST['ajaxTreePrimaryFieldAdd'].' FROM '.$_POST['ajaxTreeTblNameAdd'].' WHERE '.$_POST['ajaxTreeTitleFieldAdd'].' = "'.$_POST['ajaxAddNode'].'" AND '.$_POST['ajaxTreeParentFieldAdd'].' = '.$_POST['ajaxAddID'];
            $getInsertID = $mysqli->query($sqlGetLast);
            $res = $getInsertID->fetch_array(MYSQLI_NUM);
            if(count($res) != null)
                echo $res[0];
            else
                echo 'error';
        }
        else
        {
            echo 'error';
        }
    }
    //    Delete Node
    if(isset($_POST['ajaxDeleteNode']) && isset($_POST['ajaxTreePrimaryFielDelete']) && isset($_POST['ajaxTreeTblNameDelete']) && $_POST['ajaxDeleteNode'] != '' && $_POST['ajaxTreePrimaryFielDelete'] != '' && $_POST['ajaxTreeTblNameDelete'])
    {
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        $sql = "DELETE FROM ".$_POST['ajaxTreeTblNameDelete']." WHERE ".$_POST['ajaxTreePrimaryFielDelete']." = ".$_POST['ajaxDeleteNode'];
        if($mysqli->query($sql))
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }

    }
?>
