<?php
if(isset($_GET['db']))
{
    $database = $_GET['db']; //'db_mbanking';
    if($database == "db_mbanking"){
        $user = "mbanking";
        $password = "waltrump123";
    } else if ($database == "db_taxiPay") {
        $user = "taxipay";
        $password = "waltrump123";
    } else if ($database == "db_minsurance") {
        $user = "insurance";
        $password = "waltrump123";
    }
    $link = mysqli_connect('199.168.191.130:3306', $user, $password, $database);
    //$link = mysqli_connect('localhost', 'root', '', 'db_scuba_diving');
    mysqli_set_charset($link,'utf8');

    if(isset($_GET['q']))
    {
        $encoded_query = $_GET['q'];
        $query = base64_decode($encoded_query);
        $commandArray = explode(" ", $query);
        foreach($commandArray as $ca) {
            if (preg_match('/tbl_/', $ca)) {
                $tableName = str_replace('`', '', $ca);
            }
        }
        $commandType = $commandArray[0];
        echo '{';
        echo '"command":"'.$commandType.'"';
        echo ',"query":"'.$query.'"';
        echo ',"query_encoded":"'.$encoded_query.'"';

        $result = mysqli_query($link, $query);
    //    echo $result;
        if($result) {

            echo ',"status":"success"';

            if(strtoupper($commandType) == "SELECT") {
                $num = mysqli_num_rows($result);
                echo ',"rowCount":"'.$num.'"';
                if($num != 0){
                    echo ',"data":{"'.$tableName.'":[';
                    for ($i=0;$i<mysqli_num_rows($result);$i++) {
                    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
                    }
                    echo ']}';
                }
            }    
        }
        else {
            echo ',"status":"fail"';
        }
        echo '}';
    }
}

?>