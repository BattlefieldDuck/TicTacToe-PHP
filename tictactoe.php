<?php
//None = -1, circle = 0, cross = 1
session_start();

//Load when game start or restart
if (!isset($_SESSION['board']) || ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['restart']))) {
	//Set board
	$board = array(-1,-1,-1,-1,-1,-1,-1,-1,-1);
	$_SESSION['board'] = $board;
	
	//Set turn to circle
	$_SESSION['turn'] = 0;
	
	//Highlight the box or not
	$btnsuccess = array(0,0,0,0,0,0,0,0,0);
	$_SESSION['btnsuccess'] = $btnsuccess;
	
	$_SESSION['win'] = -1;
}

//Load when receive data
if (isset($_SESSION['board']) && $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['board_position']) && isset($_POST['type'])) {
	//Update board data
	$_SESSION['board'][(int)$_POST['board_position']] = (int)$_POST['type'];

	//Update should highlight (Check win)
	//Horizontal
	if (iswin(0,1,2)) {
		$_SESSION['btnsuccess'][0] = 1;
		$_SESSION['btnsuccess'][1] = 1;
		$_SESSION['btnsuccess'][2] = 1;
		$_SESSION['win'] = $_SESSION['board'][0];
	} else if (iswin(3,4,5)) {
		$_SESSION['btnsuccess'][3] = 1;
		$_SESSION['btnsuccess'][4] = 1;
		$_SESSION['btnsuccess'][5] = 1;
		$_SESSION['win'] = $_SESSION['board'][3];
	} else if (iswin(6,7,8)) {
		$_SESSION['btnsuccess'][6] = 1;
		$_SESSION['btnsuccess'][7] = 1;
		$_SESSION['btnsuccess'][8] = 1;
		$_SESSION['win'] = $_SESSION['board'][6];
	}
	//Vertical
	if (iswin(0,3,6)) {
		$_SESSION['btnsuccess'][0] = 1;
		$_SESSION['btnsuccess'][3] = 1;
		$_SESSION['btnsuccess'][6] = 1;
		$_SESSION['win'] = $_SESSION['board'][0];
	} else if (iswin(1,4,7)) {
		$_SESSION['btnsuccess'][1] = 1;
		$_SESSION['btnsuccess'][4] = 1;
		$_SESSION['btnsuccess'][7] = 1;
		$_SESSION['win'] = $_SESSION['board'][1];
	} else if (iswin(2,5,8)) {
		$_SESSION['btnsuccess'][2] = 1;
		$_SESSION['btnsuccess'][5] = 1;
		$_SESSION['btnsuccess'][8] = 1;
		$_SESSION['win'] = $_SESSION['board'][2];
	}
	//
	if (iswin(0,4,8)) {
		$_SESSION['btnsuccess'][0] = 1;
		$_SESSION['btnsuccess'][4] = 1;
		$_SESSION['btnsuccess'][8] = 1;
		$_SESSION['win'] = $_SESSION['board'][0];
	}
	if (iswin(2,4,6)) {
		$_SESSION['btnsuccess'][2] = 1;
		$_SESSION['btnsuccess'][4] = 1;
		$_SESSION['btnsuccess'][6] = 1;
		$_SESSION['win'] = $_SESSION['board'][2];
	}

	//Update turn
	$_SESSION['turn'] = (int)!(bool)$_SESSION['turn'];
}

function iswin($b1, $b2, $b3) {
	if ($_SESSION['board'][$b1] != -1) {
	   if (($_SESSION['board'][$b1] == $_SESSION['board'][$b2]) && ($_SESSION['board'][$b2] == $_SESSION['board'][$b3])) {
		   return true;
	   }
	}
	return false;
}


echo "<div class='container mt-3'><div class='card'><div class='card-body'>";
	echo "<div class='card'><div class='card-body'><span>";
	if ($_SESSION['win'] == 0) {
		echo "&#9711; WIN!";
	} else if ($_SESSION['win'] == 1) {
		echo "&#10060; WIN!";
	} else if ($_SESSION['turn'] == 0) {
		echo "&#9711; turn";
	} else if ($_SESSION['turn'] == 1) {
		echo "&#10060; turn";
	}
    echo "</span></div></div>";

	//Echo 9 boxes
	echo "<div class='container mt-3 mb-3' style='width:355px;'>";
		foreach($_SESSION['board'] as $i=>$board_value) {
			echo "<button id='ttt".$i."' type='button' class='btn btn-";

			if ((bool)$_SESSION['btnsuccess'][$i]) {
				echo "success";
			} else {
				echo "light";
			}

			echo " m-1' style='height:100px;width:100px;'><font size='7'>";
			
			switch ((int)$board_value) {
				case 0: echo "&#9711;"; break;
				case 1: echo "&#10060;"; break;
			}

			echo "</font></button>";
		}
	echo "</div>";

	//Echo Restart button
	echo "<button id='ttt_restart' type='button' class='btn btn-danger btn-lg btn-block'";
	if (!in_array(0, $_SESSION['board']) && !in_array(1, $_SESSION['board'])) echo "disabled";
	echo ">Restart</button>";
echo "</div></div></div>";
	
	
echo "<script>";
//JS: 9 boxes
if (!in_array(1, $_SESSION['btnsuccess'])) {
	foreach($_SESSION['board'] as $i=>$board_value) {
		if ((int)$board_value == -1) {
			echo "$('#ttt".$i."').click(function(){
					$.ajax({
						url:'tictactoe.php',
						method:'POST',
						data:{'board_position':".$i.",'type':".$_SESSION['turn']."},
						success: function(){
							$('#ttt_board').load('tictactoe.php');
						}
					})
				});";
		}
	}
}

//JS: restart button
if (in_array(0, $_SESSION['board']) || in_array(1, $_SESSION['board'])) {
	echo "$('#ttt_restart').click(function(){
			$.ajax({
				url:'tictactoe.php',
				method:'POST',
				data:{'restart':1},
				success: function(){
					 $('#ttt_board').load('tictactoe.php');
				}
			})
		});";
}
	
echo "</script>";

