<?php
require_once 'config/config.php';
    if(isset($_POST['save'])){
        $fruit=$_REQUEST['fruit_name'];
    //$_REQUEST can be used to handle both get and post requests
        $qry2 = mysql_query("select * from fruits where fruit='$fruit'") or die(mysql_error());
        $count = mysql_num_rows($qry2);
        if($count<1){
            $sql_qry = mysql_query("insert into fruits (fruit) values ('$fruit')") or die(mysql_error());
            $success= $fruit." has been succesfully saved";


        }else{
      
            $success = $fruit." already exists";
        }
    }
?>
<div style="margin:auto">
<h1 style="text-align:center;">Welcome to Fruit Market</h1>

<form method="post" style="display:flex;align-items:center;justify-content:center;">
    <input type="text" name="fruit_name" id="fruit_name" value="">
    <br>
    <br>

    <input type="submit" value="Add Fruit" name="save" id="save">
</form>
<br>
<br>

<h1 style="text-align:center;color:green;">

<?php 

    echo $success;
?>
</h1>
<table border="1px"  style="border-collapse:collapse;margin:auto;">
<tr>
    <th>S.NO</td>
    <th>Fruit</th>
    <th>Availability</th>
    <th>Delete</th>
    <th>Update</th>
</tr>



<?php
$qry1=mysql_query("select * from fruits where status='1'") or die(mysql_error());
$i = 1;
while($res1=mysql_fetch_object($qry1))
{
$fruit_id=$res1->f_id;
$fruit=$res1->fruit;
$status=$res1->status;
if($status==1)
{
    $status="Available";
}else{
    $status="Unavailable";
}
?>

<tr>
    <td><?php echo $i;?></td>
    <td><?php echo $fruit;?></td>
    <td><?php echo $status;?></td>
    <td>
        <button type="button" onclick="remove(<?php echo $fruit_id; ?>)">Delete</button>
    </td>
</tr>



<?php
    $i = $i+1;
}

?>
</table>

<form method="post" id="hiddenForm">
    <input type="hidden" name="hid" id="hid" value="">
    <input type="hidden" name="hid2" id="hid2" value="">
    <input type="hidden" name="fruitName" id="fruitName" value="">

</form>

<script>
    function remove(f_id) {
        document.getElementById("hid").value=f_id;
        document.getElementById("hiddenForm").submit();
        
    }
</script>
<?php
$removed_fruit_id = $_POST['hid'];
$update_query = mysql_query("update fruits set status='0' where f_id ='$removed_fruit_id'") or die(mysql_error());

?>


</div>