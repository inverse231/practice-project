<?php

$source = '{"name":"nastya","name_sanitized":"Nastya","country":"RU","gender":"female","samples":1440,"accuracy":99,"duration":"20ms","credits_used":1}';
$json = json_decode($source, true);
echo $json['gender'];
print_r($json);

$aJson = json_decode("name.json", true);
echo $aJson['gender'];
?>