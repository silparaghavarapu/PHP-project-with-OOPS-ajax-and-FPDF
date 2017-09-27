<script type="text/javascript">
function show_hide_column(col_no, do_show) {
    var rows = document.getElementById('id_of_table').rows;
    
    for (var row = 0; row < rows.length; row++) {
        var cols = rows[row].cells;
        if (col_no >= 0 && col_no < cols.length) {
            cols[col_no].style.display = do_show ? '' : 'none';
        }
    }
}
</script>

<?php  

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

$file_name="";
$new_filename=$_POST['First_name']."_".$_POST['shop_id']."_".$_FILES['Document']['name'];

if ($_FILES['Document']['name']<>NULL)
{
    $file_name=$new_filename.".".pathinfo($_FILES['Document']['name'],PATHINFO_EXTENSION);
    $file_path=MEMBERSUPLOAD.$file_name;
    
    move_uploaded_file($_FILES['Document']['tmp_name'], $file_path);
    
}
$image_name="";
$new_imagename=$_POST['First_name']."_".$_POST['shop_id']."_".$_FILES['image_upload']['name'];
if ($_FILES['image_upload']['name']<>NULL)
{
    $image_name=$new_imagename.".".pathinfo($_FILES['image_upload']['name'],PATHINFO_EXTENSION);
    $image_path=MEMBERSPHOTOS.$image_name;
    
    move_uploaded_file($_FILES['image_upload']['tmp_name'], $image_path);
    
        }?>

<table id='id_of_table' border=1>
    <tr><td colspan="4"><table><tr><td>Can haz nested table?</td></tr></table></td></tr>
    <tr><td>  2</td><td>   two</td><td>   deux</td><td>     zwei</td></tr>
    <tr><td>  3</td><td> three</td><td>  trois</td><td>     drei</td></tr>
    <tr><td>  4</td><td>  four</td><td>quattre</td><td>     vier</td></tr>
    <tr><td>  5</td><td>  five</td><td>   cinq</td><td>f&uuml;nf</td></tr>
    <tr><td>  6</td><td>   six</td><td>    six</td><td>    sechs</td></tr>
</table>

<form>
    Enter column no: <input type='text' name=col_no><br>
    <input type='button' onClick='javascript:show_hide_column(col_no.value, true);' value='show'>
    <input type='button' onClick='javascript:show_hide_column(col_no.value, false);' value='hide'>
</form>