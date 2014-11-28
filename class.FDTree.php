<?php

    /**
    * FDTree View - PHP Tree View Manager (ADD - EDIT - DELETE) is php class for manage tree structures mysql tables using jquery and FontAwesome
    * PHP Version 5
    * @package FDTreeView
    * @link https://github.com/farzandalaee/ajaxTreeViewAdmin/ The FDTreeView GitHub project
    * @author Brent R. Matzelle (original founder) <farzan.dalaee@gmail.com>
    * @copyright 2012 - 2014 Farzan Dalaee
    * @note This program is distributed in the hope that it will be useful - WITHOUT
    * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
    * FITNESS FOR A PARTICULAR PURPOSE.
    */
    class FDTree
    {
        /**
        * Final Result FDTree.
        * @type Object
        */
        public $tree = '';
        /**
        * Mysql Table Name.
        * @type string
        */
        public $tblName;
        /**
        * Mysql Parent field name.
        * @type string
        */
        public $parentField;
        /**
        * Mysql unique field name.
        * @type string
        */
        public $primaryField;
        /**
        * Mysql title field name.
        * @type string
        */
        public $titleField;
        /**
        * FDTree prefix for use more than 1 treeview on page.
        * @type string
        */
        public $prefix;
        /**
        * Address of images for FDTree
        * Options: "/parent_rott/images/".
        * @type string 
        */
        public $imagesPath = 'images/';
        /**
        * Confirm Message For Delete
        * Options: "Are You Sure To Delete This Node?".
        * @type string 
        */
        public $confirmMessage = 'Are you sure?';
        /**
        * Create jQuery For Trre view
        */
        public function __destruct()
        {
            $prefix = $this->prefix;
            $this->tree .= "
            <script type='text/javascript'>
            \$('#".$prefix." .fdTree').on('click',function(){
            \$('#".$prefix." .fdTree input[type=\"checkbox\"]').prevAll('label').css('background-image','url(\"".$this->imagesPath."toggle-small-expand.png\")').css('background-position','right').css('background-repeat','no-repeat').css('padding-right','30px');
            \$('#".$prefix." .fdTree input[type=\"checkbox\"]:checked').prevAll('label').css('background-image','url(\"".$this->imagesPath."toggle-small.png\")');
            \$('#".$prefix." .fdTree .last').prevAll('label').css('background-image','none');
            })
            \$('#".$prefix." .fdTree .fa-pencil').on('click',function(){
            ".$prefix."clearEdit();
            if(\$(this).prevAll('label').length > 0)
            var text = $(this).prevAll('label').html();
            else
            var text = \$(this).prevAll('span').html();
            var id = \$(this).attr(\"data-id".$prefix."\");
            \$(this).parent().append(\"<input type='text' id='".$prefix."txtUpdate\"+id+\"' placeholder='\"+text+\"' value='\"+text+\"'><i class='fa fa-check' onclick='".$prefix."updateTree(\"+id+\")'></i><i onclick='".$prefix."clearEdit()' class='fa fa-ban'></i>\");
            });

            \$(document).ready(function(){
            //    \$('.fdTree input[type=\"checkbox\"]').attr('checked',false);
            })
            function ".$prefix."clearEdit()
            {
            \$('.fdTree input[type=\"text\"]').remove();
            \$('.fdTree .fa-ban').remove();
            \$('.fdTree .fa-check').remove();
            }
            function ".$prefix."clearEditForLast()
            {
            \$('.fdTree input[type=\"text\"]').remove();
            \$('.fdTree .fa-ban').remove();
            \$('.fdTree .fa-check').remove();
            location.reload();
            }

            //  Update Tree Title
            function ".$prefix."updateTree(id)
            {
            t = $('#".$prefix."txtUpdate'+id).val();
            if(t != '')
            {
            $('#".$prefix."txtUpdate'+id).nextAll('i.fa-check').removeClass('fa-check').addClass('fa-refresh fa-spin').css('color','green');
            ajaxAddres = \$('#".$prefix."ajaxTreeAddress').val();
            ajaxTreePrimaryField = \$('#".$prefix."ajaxTreePrimaryField').val();
            ajaxTreeTitleField = \$('#".$prefix."ajaxTreeTitleField').val();
            ajaxTreeParentField = \$('#".$prefix."ajaxTreeParentField').val();
            ajaxTreeTblName = \$('#".$prefix."ajaxTreeTblName').val();

            \$.post(ajaxAddres,{ajaxUpdateNode:t,ajaxUpdateID:id,ajaxTreePrimaryField:ajaxTreePrimaryField,ajaxTreeTitleField:ajaxTreeTitleField,ajaxTreeParentField:ajaxTreeParentField,ajaxTreeTblName:ajaxTreeTblName},function(data){
            if(data == 'success')
            {
            \$('label[for=".$prefix."sub'+id+']').html(t);
            \$('#".$prefix."lastNod'+id).html(t);
            \$('#".$prefix."txtUpdate'+id).nextAll('i.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-check').css('color','green');
            ".$prefix."clearEdit();
            }
            else
            {
            \$('#".$prefix."txtUpdate'+id).nextAll('i.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-check').css('color','green');
            \$('#".$prefix."txtUpdate'+id).val('Error').css('color','red');
            }
            })        
            }else
            {
            alert('Please Fill TextBox');
            }
            }
            //  Add Sub Cat
            function ".$prefix."insertCat(id)
            {
            t = \$('#".$prefix."txtAddSubCat'+id).val();
            if(t != '')
            {
            \$('#".$prefix."txtAddSubCat'+id).nextAll('i.fa-check').removeClass('fa-check').addClass('fa-refresh fa-spin').css('color','green');
            ajaxAddresAdd = \$('#".$prefix."ajaxTreeAddress').val();
            ajaxTreePrimaryFieldAdd = \$('#".$prefix."ajaxTreePrimaryField').val();
            ajaxTreeTitleFieldAdd = \$('#".$prefix."ajaxTreeTitleField').val();
            ajaxTreeParentFieldAdd = \$('#".$prefix."ajaxTreeParentField').val();
            ajaxTreeTblNameAdd = \$('#".$prefix."ajaxTreeTblName').val();

            \$.post(ajaxAddresAdd,{ajaxAddNode:t,ajaxAddID:id,ajaxTreePrimaryFieldAdd:ajaxTreePrimaryFieldAdd,ajaxTreeTitleFieldAdd:ajaxTreeTitleFieldAdd,ajaxTreeParentFieldAdd:ajaxTreeParentFieldAdd,ajaxTreeTblNameAdd:ajaxTreeTblNameAdd},function(data){
            if(data != 'error')
            {
            location.reload();
            }
            else
            {
            \$('#".$prefix."txtAddSubCat'+id).nextAll('i.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-check').css('color','green');
            \$('#".$prefix."txtAddSubCat'+id).val('Error').css('color','red');
            }
            })          
            }else{
            alert('".$this->confirmMessage."');
            }
            }
            //  Add Main Cat
            function ".$prefix."insertCatMain(id)
            {
            t = \$('#".$prefix."txtAddMainCat').val();
            if(t != '')
            {
            \$('#".$prefix."txtAddMainCat').nextAll('i.fa-check').removeClass('fa-check').addClass('fa-refresh fa-spin').css('color','green');
            ajaxAddresAdd = \$('#".$prefix."ajaxTreeAddress').val();
            ajaxTreePrimaryFieldAdd = \$('#".$prefix."ajaxTreePrimaryField').val();
            ajaxTreeTitleFieldAdd = \$('#".$prefix."ajaxTreeTitleField').val();
            ajaxTreeParentFieldAdd = \$('#".$prefix."ajaxTreeParentField').val();
            ajaxTreeTblNameAdd = \$('#".$prefix."ajaxTreeTblName').val();

            \$.post(ajaxAddresAdd,{ajaxAddNode:t,ajaxAddID:id,ajaxTreePrimaryFieldAdd:ajaxTreePrimaryFieldAdd,ajaxTreeTitleFieldAdd:ajaxTreeTitleFieldAdd,ajaxTreeParentFieldAdd:ajaxTreeParentFieldAdd,ajaxTreeTblNameAdd:ajaxTreeTblNameAdd},function(data){
            if(data != 'error')
            {
            location.reload();
            }
            else
            {
            \$('#".$prefix."txtAddMainCat').nextAll('i.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-check').css('color','green');
            \$('#".$prefix."txtAddMainCat').val('Error').css('color','red');
            }
            })          
            }else{
            alert('Please Fill TextBox');
            }
            }
            // Add Subcat To Last Node

            function ".$prefix."insertCatToLastNode(id)
            {
            t = \$('#".$prefix."txtAddSubCat').val();
            if(t != '')
            {
            \$('#".$prefix."txtAddSubCat'+id).nextAll('i.fa-check').removeClass('fa-check').addClass('fa-refresh fa-spin').css('color','green');
            ajaxAddresAdd = \$('#".$prefix."ajaxTreeAddress').val();
            ajaxTreePrimaryFieldAdd = \$('#".$prefix."ajaxTreePrimaryField').val();
            ajaxTreeTitleFieldAdd = \$('#".$prefix."ajaxTreeTitleField').val();
            ajaxTreeParentFieldAdd = \$('#".$prefix."ajaxTreeParentField').val();
            ajaxTreeTblNameAdd = \$('#".$prefix."ajaxTreeTblName').val();

            \$.post(ajaxAddresAdd,{ajaxAddNode:t,ajaxAddID:id,ajaxTreePrimaryFieldAdd:ajaxTreePrimaryFieldAdd,ajaxTreeTitleFieldAdd:ajaxTreeTitleFieldAdd,ajaxTreeParentFieldAdd:ajaxTreeParentFieldAdd,ajaxTreeTblNameAdd:ajaxTreeTblNameAdd},function(data){
            if(data != 'error')
            {
            location.reload();
            }
            else
            {
            \$('#".$prefix."txtAddSubCat'+id).nextAll('i.fa-refresh').removeClass('fa-refresh fa-spin').addClass('fa-check').css('color','green');
            \$('#".$prefix."txtAddSubCat'+id).val('Error').css('color','red');
            }
            })          
            }else{
            alert('Please Fill TextBox');
            }
            }
            function ".$prefix."deleteTree(id)
            {
            if(confirm('".$this->confirmMessage."'))
            {
            ajaxAddresDelete = \$('#".$prefix."ajaxTreeAddress').val();
            ajaxTreePrimaryFielDelete = \$('#".$prefix."ajaxTreePrimaryField').val();
            ajaxTreeTblNameDelete = \$('#".$prefix."ajaxTreeTblName').val();
            $.post(ajaxAddresDelete,{ajaxDeleteNode:id,ajaxTreePrimaryFielDelete:ajaxTreePrimaryFielDelete,ajaxTreeTblNameDelete:ajaxTreeTblNameDelete},function(data){
            if(data == 'success')
            {
            \$('#".$prefix."sub'+id).parent().remove();
            location.reload();
            }
            })
            }
            }
            // Add Sub Category
            function ".$prefix."addSubCat(id)
            {
            ".$prefix."clearEdit();
            \$('#".$prefix."sub'+id).click();
            \$('#".$prefix."sub'+id).nextAll('ul').append('<li><span><input type=\"text\" id=\"".$prefix."txtAddSubCat'+id+'\"><i class=\"fa fa-check\" onclick=\"".$prefix."insertCat('+id+')\"></i><i onclick=\"".$prefix."clearEdit()\" class=\"fa fa-ban\"></span></li>');
            }
            // Add Sub Category To Last Node
            function ".$prefix."addSubCatLastNode(id)
            {
            ".$prefix."clearEdit();
            var parent = \$('#".$prefix."lastNod'+id).parent('li');
            \$('#".$prefix."lastNod'+id).parent('li').append('<ul class=\"fdTree\"><li><span><input type=\"text\" id=\"".$prefix."txtAddSubCat\" /><i class=\"fa fa-check\" onclick=\"".$prefix."insertCatToLastNode('+id+')\"></i>    <i onclick=\"".$prefix."clearEditForLast()\" class=\"fa fa-ban\"></span></li></ul>');

            \$('#".$prefix."sub'+id).click();
            spanText = parent.find('span').html();
            parent.find('span').first().remove();
            parent.prepend('<label for=\"".$prefix."sub'+id+'\" style=\"background-image: url(&quot;toggle-small.png&quot;);\">'+spanText+'</label>');
            }
            // Add Main Cat
            function ".$prefix."addMainCat()
            {
            \$('.FDTreeDiv .fdTree').first().append('<li><span><input type=\"text\" id=\"".$prefix."txtAddMainCat\" /><i class=\"fa fa-check\" onclick=\"".$prefix."insertCatMain(0)\"></i>    <i onclick=\"".$prefix."clearEditForLast()\" class=\"fa fa-ban\"></span></li>')
            }
            </script>
            ";

        }
        /**
        * Create FDTree instance
        * @param string $tblName Table Name
        * @param string $id Primary Field
        * @param string $title Title Field
        * @param string $parent Parent Field
        * @param string $ajaxAddress Ajax Path 
        * @param string $imagesPath Image Address Path [Prefix = images/]
        * @param string $prefix Prefix For Use More Than One TreeView on Page
        * @param string $confirmMessage Delete Confrim Message [Prefix = Are you sure?]
        * @return FDTree Object 
        */
        public function __construct($tblName,$id,$title,$parent,$ajaxAddress,$imagesPath,$prefix = 'FDTree',$confirmMessage)
        {
            $this->confirmMessage = $confirmMessage;
            $this->tree .= "<div class='FDTreeDiv' id='$prefix'>";
            $this->tree .= "<a href='javascript:void(0)' onclick='".$prefix."addMainCat()'><i class='fa fa-plus-circle'></i> Add New Record</a>";
            $this->tree .= "<input type='hidden' id='".$prefix."ajaxTreeAddress' value=$ajaxAddress>";
            $this->tree .= "<input type='hidden' id='".$prefix."ajaxTreePrimaryField' value=$id>";
            $this->tree .= "<input type='hidden' id='".$prefix."ajaxTreeTitleField' value=$title>";
            $this->tree .= "<input type='hidden' id='".$prefix."ajaxTreeParentField' value=$parent>";
            $this->tree .= "<input type='hidden' id='".$prefix."ajaxTreeTblName' value=$tblName>";

            $this->tblName = $tblName;
            $this->parentField = $parent;
            $this->primaryField = $id;
            $this->titleField = $title;
            $this->prefix = $prefix;

            $mysqli = new mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_DATABASE);
            $mysqli->query("SET NAMES utf8;");
            $q = "SELECT $id,$title,$parent FROM ".$tblName ." ORDER BY $title ASC";
            $query = $mysqli->query($q);

            $arrayCategories = array();
            while ($row = $query->fetch_assoc()) {
                $arrayCategories[$row['id']] = array($this->parentField => $row[$this->parentField], $this->titleField => $row[$this->titleField]);   
            }
            $mysqli->close();
            $this->createTree($arrayCategories,0);      
            $this->tree .= "</div>";  
            $this->__destruct();    
        }
        protected function createTree($array, $currentParent, $currLevel = 0, $prevLevel = -1) 
        {
            foreach ($array as $categoryId => $category) 
            {
                if ($currentParent == $category[$this->parentField]) 
                {                       
                    if ($currLevel > $prevLevel) 
                        $this->tree .= '<ul class="fdTree">'; 
                    if ($currLevel == $prevLevel) 
                        $this->tree .= '</li>';
                    $mysqli = new mysqli(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                    $q = "SELECT ".$this->primaryField." FROM ".$this->tblName." WHERE ".$this->parentField." = ".$categoryId;
                    $checkLast = $mysqli->query($q);
                    $id = $checkLast->fetch_array();
                    if(count($id) > 0)
                        $label = '<label class="labelTree" for="'.$this->prefix.'sub'.$categoryId.'">'.$category[$this->titleField].'</label><i data-id'.$this->prefix.'="'.$categoryId.'" class="fa fa-pencil"></i><i onclick="'.$this->prefix.'addSubCat('.$categoryId.')" class="fa fa-plus" ></i>';
                    else
                        $label = '<span id="'.$this->prefix.'lastNod'.$categoryId.'" onclick="'.$this->prefix.'nod('.$categoryId.')">'.$category[$this->titleField].'</span><i data-id'.$this->prefix.'="'.$categoryId.'" class="fa fa-pencil"></i><i onclick="'.$this->prefix.'addSubCatLastNode('.$categoryId.')" class="fa fa-plus" ></i><i onclick="'.$this->prefix.'deleteTree('.$categoryId.')" class="fa fa-trash-o "></i>';
                    $this->tree .= '<li>'.$label.'<input type="checkbox" id="'.$this->prefix.'sub'.$categoryId.'">';

                    if ($currLevel > $prevLevel) 
                        $prevLevel = $currLevel; 
                    $currLevel++; 
                    $this->createTree ($array, $categoryId, $currLevel, $prevLevel);
                    $currLevel--;               
                }  
            }
            if ($currLevel == $prevLevel) 
                $this->tree .= " </li>  </ul> ";
        }
    }
?>
