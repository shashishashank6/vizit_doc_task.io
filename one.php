<?php
$datetime1 = new DateTime('13:00:20');
$datetime2 = new DateTime('17:59:59');

$interval = $datetime1->diff($datetime2);

$hours   = $interval->format('%h');
$minutes = $interval->format('%i');
$result=$hours * 60 + $minutes;
?>
<html>
<head>
    
</head>
<body>
<?php echo $result; ?>    
</body>
</html>
