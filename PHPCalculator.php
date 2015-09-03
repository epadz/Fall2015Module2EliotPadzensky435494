<?php
if(isset($_GET['firstNumber']) && isset($_GET['opperator']) && isset($_GET['secondNumber'])){
	$a = floatval($_GET['firstNumber']);
	$o = $_GET['opperator'];
	$b = floatval($_GET['secondNumber']);
	
	$r = 0.0;
	
	if($o == 'add'){
		$r = $a + $b;
	}else if($o == 'sbt'){
		$r = $a - $b;
	}else if($o == 'mlt'){
		$r = $a * $b;
	}else if($o == 'dvd' && $b != 0.0){
		$r = $a / $b;
	}else if($o == 'dvd' && $b == 0.0){
		$r = 'ERROR';
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Calculator - By Eliot Padzensky</title>
<style type="text/css">
table{
	width:400px;
	height:500px;
	padding:0px;
	margin:0px;
	background-color:#999999;
	border:solid 20px #999999;
	border-radius:10px;
	box-shadow: 0px 15px 0px rgba(100,100,100,1), 0px 9px 25px rgba(0,0,0,.7);
	-moz-box-shadow: 0px 15px 0px rgba(100,100,100,1), 0px 9px 25px rgba(0,0,0,.7);
	-webkit-box-shadow: 0px 15px 0px rgba(100,100,100,1), 0px 9px 25px rgba(0,0,0,.7);
	position:relative;
	left:200px;
	top:10px;
}
tr{
	width:400px;
	height:100px;
	padding:0px;
	margin:0px;
	
}
td{
	height:100px;
	padding:0px;
	margin:0px;
}
#readout{
	height:80px;
	width:380px;
	border:10px solid #666;
	background-color:#333333;
	color:#090;
	padding:0px;
	margin:0px;
	line-height:80px;
	font-size:60px;
}
#readout input[type = radio]{
	display:none;
}
#readout input[type = text]{
	width:170px;
	height:80px;
	padding:0;
	margin:0;
	background:none;
	border:none;
	position:relative;
	float:left;
	color:#090;
	line-height:80px;
	font-size:30px;
}
#readout div{
	width:40px;
	height:80px;
	position:relative;
	float:left;
	margin:0;
	padding:0;
	color:#090;
	line-height:80px;
	font-size:60px;
}
.button{
	width:auto;
	height:80px;
	line-height:80px;
	text-align:center;
	font-size:60px;
	color:#fff;
	margin:10px;
	padding:0px;
	border-radius:10px;
	background-color:#FF6600;
	cursor:pointer;
	box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
	-moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
	-webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
	text-decoration:none;
	display:block;
	position:relative;
	
}
.button:visited{
	color:#fff;
}
.button:active{
	box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
	-moz-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
	-webkit-box-shadow: 0px 3px 0px rgba(219,31,5,1), 0px 3px 6px rgba(0,0,0,.9);
}
</style>
<script type="text/javascript">
var cur = 1;
var inputs;
var hasStarted = false;
window.onload = function(){
	inputs = [document.getElementById('oppDisplay'), document.getElementById('firstNumber'), document.getElementById('secondNumber')];

}
function press(n){
	var isSecondDecimal = n == '.' && inputs[cur].value.indexOf('.') > -1;
	if(inputs[cur].value.length <= 10 && !isSecondDecimal){
		if(inputs[cur].value == '0' || inputs[cur].value == 'ERROR' || !hasStarted){
			inputs[cur].value = n;
			hasStarted = true;
		}else{
			inputs[cur].value +=n;
		}
	}
	
}
function add(){
	if(inputs[1].value == 'ERROR'){clearAll(); return false;}
	inputs[0].innerHTML = "+";
	document.getElementById("add").checked = true;
	cur = 2;
	inputs[cur].value = 0;
	hasStarted = true;
}
function sbt(){
	if(inputs[1].value == 'ERROR'){clearAll(); return false;}
	inputs[0].innerHTML = "-";
	document.getElementById("sbt").checked = true;
	cur = 2;
	inputs[cur].value = 0;
	hasStarted = true;
}
function mul(){
	if(inputs[1].value == 'ERROR'){clearAll(); return false;}
	inputs[0].innerHTML = "X";
	document.getElementById("mlt").checked = true;
	cur = 2;
	inputs[cur].value = 0;
	hasStarted = true;
}
function div(){
	if(inputs[1].value == 'ERROR'){clearAll(); return false;}
	inputs[0].innerHTML = "&divide;";
	document.getElementById("dvd").checked = true;
	cur = 2;
	inputs[cur].value = 0;
	hasStarted = true;
}
function enter(){
	if(inputs[1].value == 'ERROR'){clearAll(); return false;}
	fn = inputs[1].value && inputs[1].value != '';
	sn = inputs[2].value && inputs[2].value != '';
	op = document.getElementById("add").checked || document.getElementById("sbt").checked || document.getElementById("mlt").checked || document.getElementById("dvd").checked;
	if(fn && op && sn){
		document.getElementById('calculator').submit();
	}else{
		alert('please make sure input is valid');
	}
}
function clearAll(){
	inputs[1].value = '0';
	inputs[0].innerHTML = '';
	inputs[2].value = '';
	document.getElementById("add").checked = false;
	document.getElementById("sbt").checked = false;
	document.getElementById("mlt").checked = false;
	document.getElementById("dvd").checked = false;
	cur = 1;
}
</script>
</head>

<body>
	<h1>Eliot Padzensky's PHP Calculator</h1>
    <form id="calculator" action="PHPCalculator.php" method="get">
    <table>
    	<tbody>
        	<tr>
            	<td colspan="4">
                	<div id="readout">
                        <input id="firstNumber"  name="firstNumber"  type="text" value="<?php if(isset($r)){echo $r;}else{echo 0;}?>" readonly  required />
                        <div id="oppDisplay"></div>
                        <input id="add"    name="opperator"    type="radio" value="add"  required />
                        <input id="sbt"    name="opperator"    type="radio" value="sbt"  required />
                        <input id="mlt"    name="opperator"    type="radio" value="mlt"  required />
                        <input id="dvd"    name="opperator"    type="radio" value="dvd"  required />
                        <input id="secondNumber" name="secondNumber" type="text" value="" readonly  required/>
                    </div>
                </td>
            </tr>
            <tr>
            	<td colspan="4"><a href="#" class="button" id="clr"  onclick="clearAll()">CLEAR</a></td>
            </tr>
            <tr>
            	<td><a href="#" class="button" id="b1"  onclick="press(1)">1</a></td>
                <td><a href="#" class="button" id="b2"  onclick="press(2)">2</a></td>
                <td><a href="#" class="button" id="b3"  onclick="press(3)">3</a></td>
                <td><a href="#" class="button" id="addB" onclick="add()"   >+</a></td>
            </tr>
            <tr>
            	<td><a href="#" class="button" id="b4"  onclick="press(4)">4</a></td>
                <td><a href="#" class="button" id="b5"  onclick="press(5)">5</a></td>
                <td><a href="#" class="button" id="b6"  onclick="press(6)">6</a></td>
                <td><a href="#" class="button" id="sbtB" onclick="sbt()"   >-</a></td>
            </tr>
            <tr>
            	<td><a href="#" class="button" id="b7"  onclick="press(7)">7</a></td>
                <td><a href="#" class="button" id="b8"  onclick="press(8)">8</a></td>
                <td><a href="#" class="button" id="b9"  onclick="press(9)">9</a></td>
                <td><a href="#" class="button" id="mulB" onclick="mul()"   >x</a></td>
            </tr>
            <tr>
            	<td><a href="#" class="button" id="b0"   onclick="press(0)">0</a></td>
                <td><a href="#" class="button" id="bdec"   onclick="press('.')">.</a></td>
                <td><a href="#" class="button" id="eql"  onclick="enter()">=</a></td>
                <td><a href="#" class="button" id="divB" onclick="div()"   >&divide;</a></td>
            </tr>
        </tbody>
    </table>
    </form>
</body>
</html>