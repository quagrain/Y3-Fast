<?php

include './functions/getAllTags.php';

$tags = getAllTags();

if ($tags = false) {
    $response = ["status" => 0, "message" => "failed", "result" => null];
} else {
    $response = ["status" => 1, "message" => "successful", "result" => $tags];
}

echo json_encode($response);
exit();
