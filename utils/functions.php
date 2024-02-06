<?php
    function checkExists($field, $param, $pdo) {


$sql = "SELECT * FROM users WHERE $field = ?";
                    $stmt = $pdo->prepare($sql);
                    $result= $stmt->execute([$param]);

                    if ($stmt->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                    return($stmt->rowCount() > 0) ? true : false;
                }


function dd($param) {
    echo "<pre>";
    var_dump($param);
    echo "</pre>";
    die();
}
?>