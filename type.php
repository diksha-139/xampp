<?php
require 'config/config.php';

?>

<h1>Welcome to Fruit Market</h1>

<form method="post" id="firstForm">
<input type="text" placeholder="Enter Type Name" name="type" id="type" value="">
<br>
<input type="submit" value="Save" name="save_type" id="save_type">
<br>
</form>

<?php
    if(isset($_POST['save_type']))
    
    {

        $type_name = $_POST['type'];
        $qry_check=mysql_query("select * from type where type='$type_name'") or die(mysql_error());
        $count=mysql_num_rows($qry_check);
            if($count<1)
            {
                mysql_query("insert into type (type) values ('$type_name')") or die(mysql_error());
            }
            else
            {
                echo $type_name." already exsists";

            }
    }

    $hid = $_POST['hid'];
    
    $qry_update=mysql_query("UPDATE type SET status ='0' WHERE ty_id = '$hid'") or die(mysql_error());




?>



<table border="2px">
    <tr>
        <th>
            S.N.
        </th>
        <th>
            Type        
        </th>
        <th>
            Status
        </th>
        <th>
            Action
        </th>
        <th>
            Update
        </th>
    </tr>

<?php
    $qry1 = mysql_query("select * from type where status='1'") or die(mysql_error());
    $i=1;
    while($obj = mysql_fetch_object($qry1)){
        $type_id = $obj->ty_id;
        $type = $obj->type;
        $status = $obj->status;

        if($status == 1){
            $status = "Available";
        }else{
            $status = "Unavailable";
        }

    
?>

<tr>
        <td>
          <?php  echo $i; ?>
        </td>
        <td>
            <?php echo $type; ?>  
        </td>
        <td>
           <?php echo $status; ?>
        </td>
        <td>
            <button onclick="del(<?php echo $type_id;?>)">Delete</button>
        </td>
        <td>
            <button onclick="update_type(<?php echo $type_id; ?>,'<?php echo $type; ?>')">
                Update
            </button>
        </td>
    </tr>


<?php
    $i++;
        
}

?>


</table>

<form method="POST" id="hidform">

    <input type="hidden" name="hid" id="hid" value="">
    <input type="hidden" name="hid2" id="hid2" value="">
    <input type="hidden" name="tyname" id="tyname" value="">

</form>



<script>
    function del(a)
    {
        document.getElementById('hid').value=a;
        document.getElementById("hidform").submit();
    }


    function update_type(ty_id,ty_name){
        // alert(ty_id);
        // alert(ty_name);
        new_type = document.getElementById("type").value;
        document.getElementById('tyname').value=new_type;


        document.getElementById('hid2').value=ty_id;

        // ty_name = document.getElementById('type').value;


        // document.getElementById("firstForm").submit()
        document.getElementById("hidform").submit();


    }
    </script>

<?php
    $ty_id = $_POST['hid2'];
    $ty_name = $_POST['tyname'];

    $qry3 = mysql_query("update type set type='$ty_name' where ty_id='$ty_id'") or die(mysql_error());
?>