<?php
if(isset($_POST['submit'])) {
    $rawQuery = $_POST['query'];
    $dbName = $_POST['databaseName'];
//$rawQuery = "INSERT INTO `db_scuba_diving`.`tbl_demo` (`demo_id`, `demo_name`, `demo_cat`) VALUES (NULL, 'salman1', '1,2'"; 
//$rawQuery = "SELECT `user_id`, `user_type`, `user_image`, `user_name`, `password`, `email_id`, `mobile_number`, `date_of_joining`, `status`, `date_created` FROM `tbl_login`";
//$rawQuery = "DELETE FROM `tbl_photos_category` WHERE `photos_category_id` = 1344";
$encodedQuery = base64_encode($rawQuery);
}
else {
    unset($rawQuery);
    unset($encodedQuery);
    unset($dbName);
}


?>
    <br>
    <form method="post">
        <input type="text" name="databaseName" value="" placeholder="Entere Database Name" style="width:500px;" /><br><br>
        <textarea id="query" name="query" value="" placeholder="Enter your sql query" style="width:500px; height:100px"></textarea>
        <br>
        <br>
        <input type="submit" name="submit" value="generate code" />
        <input type="button" onClick="redirect();" value="redirect" />
    </form>
    <br>
    <?php if(isset($encodedQuery)) { echo $encodedQuery; } ?>
        <script>
            function redirect() {
                <?php if(isset($dbName) && isset($encodedQuery)) { ?>
                window.location.href = "getResult.php?db=<?php echo $dbName; ?>&q=<?php echo $encodedQuery; ?>";
                <?php } ?>
            }
        </script>