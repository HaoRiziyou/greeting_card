<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>

        label {
            display: inline-block;
            width: 220px;
            text-align: right;
        }

        pre {

            font-size: 20px;
        }
    </style>
</head>
<body>

<h1>Create your own greeting card!</h1>
<form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label>Name</label><input type="text" name="sender" value="<?php echo msg() ?>"><br>
    <label>Recipient</label><input type="text" name="receiver" value="<?php echo $_POST['receiver'] ?>"><br>
    <label>What do you wish him/her?</label><input type="text" name="content"
                                                   value="<?php echo $_POST['content'] ?>"><br>
    <label>Design character</label><input type="text" name="char" value="<?php echo $_POST['char'] ?>"><br>
    <label style="width: 163px"></label>
    <input type="submit" name="reset" value="Clear">
    <input type="submit" name="submit" value="Submit">
</form>

<?php
/**
 * Created by PhpStorm.
 * User: MQ
 * Date: 2017/11/17
 * Time: 16:22
 */

// detect whether click the submit button and ensure the field is  not empty
if (isset($_POST['submit']) && !empty($_POST['sender']) || !empty($_POST['receiver']) || !empty($_POST['content']) || !empty($_POST['char'])) {
    //used for form validation
    if (preg_match("/^[a-zA-Z]+[\s]?[a-zA-Z]+[\s]?[a-zA-Z]+$/", $_POST['sender'])) {
        if (preg_match("/^[a-zA-Z]+[\s]?[a-zA-Z]+[\s]?[a-zA-Z]+$/", $_POST['receiver'])) {
            if (preg_match("/([^0-9][a-zA-z]*)/", $_POST['content'])) {
                if (preg_match("/^(\S){1}$/", $_POST['char'])) {
                    echo "<pre>";
                    $line1 = "";
                    $line2 = "";
                    $line3 = "";
                    $line4 = "";
                    $line6 = "";
                    $line7 = "";
                    $length = strlen(" " . "Dear" . " " . $_POST['receiver']);
                    $length1 = strlen("I wish you " . $_POST['content'] . "!");
                    $widelength = max($length, $length1) + 2;

                    for ($i = 0; $i < $widelength; $i++) {
                        $line1 = $line1 . $_POST['char'];
                    }

                    $line2 = str_pad(" " . "Dear" . " " . $_POST['receiver'], $widelength, " ");


                    $line3 = str_pad("", $widelength, " ");

                    $line4 = str_pad(" " . "I wish you" . $_POST['content'] . " " . "!", $widelength, " ");


                    $line6 = str_pad(" " . "Greetings" . " ", $widelength, " ");


                    $line7 = str_pad($_POST['sender'], $widelength, " ", STR_PAD_BOTH);

                    echo $_POST['char'] . $line1 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line2 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line3 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line4 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line3 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line6 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line3 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line7 . $_POST['char'] . "<br>";
                    echo $_POST['char'] . $line1 . $_POST['char'] . "<br>";
                    echo "</pre>";
                } else {
                    echo "The character should not more than 1 characters";
                }
            } else {
                echo "The content should not  contain digits";
            }
        } else {
            echo "The reveiver should only contain letters like Ma Qiang";
        }
    } else {
        echo "The name should only contain letters eg.li fang tian";
    }

    // if not click the button  but do not want to inform the user
} elseif (!isset($_POST['submit'])) {
    $_POST['sender'] = "";
    $_POST['receiver'] = "";
    $_POST['content'] = "";
    $_POST['char'] = "";
} else {
    // if click the buttton and the input is empty
    echo "Please enter the information";
}
// this function is used to define index  before the execution of php
function msg()
{
    if (!isset($_POST['submit'])) {
        $_POST['sender'] = "";
        $_POST['receiver'] = "";
        $_POST['content'] = "";
        $_POST['char'] = "";
    } else {
        echo $_POST['sender'];
    }

}


?>


</body>
</html>








