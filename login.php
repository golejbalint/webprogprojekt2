<?php
function decodePasswords($filename, $keyArray) {
    $encrypted = file_get_contents($filename);

    $decodedString = '';

    foreach (explode("\n", $encrypted) as $line) {
        if (empty($line)) {
            continue;
        }
        $decodedPass = '';
        for ($i = 0; $i < strlen($line); $i++) {
            $charCode = ord($line[$i]);
            $keyIndex = $i % count($keyArray);
            $decodedCharCode = ($charCode - $keyArray[$keyIndex]) % 256;
            if ($decodedCharCode < 0) {
                $decodedCharCode += 256;
            }
            $decodedPass .= chr($decodedCharCode);
        }
        $decodedString .= $decodedPass . "\n";
    }
    return $decodedString;
}

function get_Color($Username){
    $servername = "127.0.0.1";
    $username = "root2";
    $password = "asddsa123";
    $dbname = "root2";

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Titkos FROM tabla where Username = '$Username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        return $row["Titkos"];
    }
    } else {
        return "NULL";
    }
    $conn->close();
}


$decoded = decodePasswords('password.txt', array(5, -14, 31, -9, 3));

$username = $_POST['uname'];
$password = $_POST['passwd'];

$IsUser = false;
$CorrectPass = false;
foreach (explode("\n", $decoded) as $line) {
    if (empty($line)) {
        continue;
    }
    list($lineUsername, $linePassword) = explode('*', $line);
    if ($lineUsername === $username){
        $IsUser = true;
        if ($linePassword === $password) {
            $CorrectPass = true;
            break;
        }
    }
}

if ($CorrectPass) {
    echo "Login successful!";

    $Color = array(
        "piros" => "red",
        "zold" => "green",
        "sarga" => "yellow",
        "kek" => "blue",
        "fekete" => "black",
        "feher" => "white",
        "lila" => "purple"
    );

    $Secret = $Color[get_Color($username)];
    header("Location: index.php?response=Login Sucsessful!&Secret=$Secret");
    
} else {
    if (!isset($username) || $username == '') {
        header("Location: index.php?response=incorret user");
    } else if ($IsUser) {
        header("Location: index.php?response=Incorrect password!&redirect=police.hu&delay=3");
    } else {
        header("Location: index.php?response=Invalid username!&redirect=police.hu&delay=3");
    }
}
?>