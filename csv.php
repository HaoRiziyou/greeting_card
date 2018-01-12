<?php
/**
 * Created by PhpStorm.
 * User: zhangyujia
 * Date: 4617.11.17
 * Time: 13:31
 */
session_start();

$name = $visitorInfo = $browser = $os = $browserCounter = "";

//count the total visitors' number
if(isset($_SESSION['views']))
    $_SESSION['views']=$_SESSION['views']+1;
else
    $_SESSION['views']=0;

//get the visitor's general information and process it
$visitorInfo = $_SERVER['HTTP_USER_AGENT'];

//determine the browser type and count the number of same browser's user
if(strpos($visitorInfo,'Chrome')){
    $browser = "Chrome";
    if(!isset($_SESSION['chrome']))
        $_SESSION['chrome']= 0;
    else
        $_SESSION['chrome'] ++;
    $browserCounter = $_SESSION['Safari'];
}elseif (strpos($visitorInfo,'Firefox')){
    $browser = "Firefox";
    if(!isset($_SESSION['firefox']))
        $_SESSION['firefox']= 0;
    else
        $_SESSION['firefox'] ++;
    $browserCounter = $_SESSION['firefox'];
}elseif (strpos($visitorInfo,'Safari')){
    $browser = "Safari";
    if(!isset($_SESSION['safari']))
        $_SESSION['safari']= 0;
    else
        $_SESSION['safari'] ++;
    $browserCounter = $_SESSION['safari'];
}elseif (strpos($visitorInfo,'Mozilla')){
    $browser = "Mozilla";
    if(!isset($_SESSION['mozilla']))
        $_SESSION['mozilla']= 0;
    else
        $_SESSION['mozilla'] ++;
    $browserCounter = $_SESSION['mozilla'];
}


//determine the OS type
if(strpos($visitorInfo,"Mac")){
    $os= "Mac";
}elseif(stripos($sys, "Linux")){
    $os = "Linux";
}elseif(stripos($sys, "Android")){
    $os = "Android";
}elseif(stripos($sys, "NT")){
    $os = "Windows";
}

?>

<html>
<body>



<form action="test1.php" method="post">
    What's your name: <input type="text" name="name">
    <input type="submit" name="submit"><br>
</form>

<?php
if (isset($_POST['submit'])) {
    echo "Hello " . $_POST['name'] . ", you are visitor " . $_SESSION['views'] . "!" . "<br>";
    echo $browserCounter . " visitors also use " . $browser . ".";
    $userInfo = $_SESSION['views'] . "," . $_POST['name'] . "," . $browser . "," . $os . "\n";


    if (($handle = fopen('visitorData.csv', 'r+')) !== FALSE) {
        fputcsv($handle, array('ID', 'Name', 'Client', 'OS'));
        $row = 0;
        $data = array(str_getcsv($userInfo));
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        // inc the row
        $row++;
        fclose($handle);
    }
    echo "<html><body><table>\n\n";
    $f = fopen("visitorData.csv", "r");
    while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
    }

}


?>


</body>
</html>





