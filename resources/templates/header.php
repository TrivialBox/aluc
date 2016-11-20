<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<?php
if ($get('title')) {
    echo <<<TAG
<title>
    $get('title')
</title>
TAG;

}

?>

<!-- Bootstrap -->
<!-- Local
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Local
<script src="bower_components/jquery/dist/jquery.js"></script>
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

