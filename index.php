<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>BattlefieldDuck | Tic Tac Toe</title>
	
	<link rel="apple-touch-icon" sizes="120x120" href="https://server.battlefieldduck.com/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="https://server.battlefieldduck.com/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="https://server.battlefieldduck.com/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="https://server.battlefieldduck.com/assets/favicon/site.webmanifest">
	<link rel="mask-icon" href="https://server.battlefieldduck.com/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="https://server.battlefieldduck.com/assets/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="https://server.battlefieldduck.com/assets/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="bg-dark">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<div id="ttt_board" width="30"></div>
	<script>$(function(){$("#ttt_board").load("tictactoe.php");});</script>
	
</body>
</html>
