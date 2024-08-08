<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    $server = "localhost";
    $user = "root";
    $pwd = "";

    $db = "fruit_market";

    $conn = mysql_connect("$server","$user","$pwd") or die(mysql_error());

    mysql_select_db($db,$conn);
    // echo "connected to $db";
?>

<h1>Welcome to Taste Table</h1>

<form action="#" method="POST">

    <input type="text" placeholder="Enter Taste Value" name="taste_name" id="taste_name" value="">
    <input type="submit" value="Save it!" name="btn" id="btn">

</form>

<?php
    if(isset($_POST['btn'])){
        $taste_name = $_REQUEST['taste_name'];
        $query4 = mysql_query("select * from taste where taste='$taste_name'") or die(mysql_error());
        $count = mysql_num_rows($query4);

        if($count <1){

            $query1=  mysql_query("insert into taste (taste) values ('$taste_name')") or die(mysql_error());
            $msg = $taste_name." Inserted Successfully...";
        }else{
            $msg = $taste_name." Already Exists...";

        }
    }

?>

<table border="3px solid green">
    <tr>
        <th>S.N.</th>
        <th>Taste Name</th>
        <th>Availability</th>
        <th>Remove</th>
        <th>Update</th>
    </tr>
    <h1><?php echo $msg; ?></h1>

    <?php
        $query2 = mysql_query("select * from taste where status='1'") or die(mysql_error());

        $i = 1;
        while($obj = mysql_fetch_object($query2)){
            $taste_id = $obj->t_id;
            $taste_name = $obj->taste;
            $taste_status = $obj->status;

            if($taste_status == 1){
                $taste_status ="Available";

            }else{
                $taste_status = "Not Available";
            }


    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $taste_name; ?></td>
        <td><?php echo $taste_status; ?></td>
        <td><button onclick="remove_taste(<?php echo $taste_id; ?>)">Remove</button></td>
        <td></td>
    </tr>

    <?php
    $i = $i+1;
        }
        ?>

        <form  method="post" id="hiddenForm">
            <input type="hidden" name="hid" id="hid" value="">
            <input type="submit" value="" id="hidBtn" name="hidBtn">
        </form>

        <script>
            function remove_taste(tid){

                document.getElementById("hid").value=tid;
                document.getElementById("hiddenForm").submit();

            }
        </script> 
        <?php 
            $tasteId = $_POST['hid'];
            $query3 = mysql_query("UPDATE taste SET status='0' WHERE t_id='$tasteId'") or die(mysql_error());
        ?>


</table>