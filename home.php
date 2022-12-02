<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
        <title>PHP-Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="styleapi.css?v=<?php echo time(); ?>">
	</head>
	<body>
		<h1 class = "title">Big Man Clicker</h1>
		<a href = "logout.php"><button class = "logoutbutt">Log Out</button></a>
		<div class = "main">
			<div class = "baseUpgrades">
				<h1 class = 'upgradeText'>Food</h1>
				<div class = "upgrade">
					<h3>Rice</h3>
					<p id = 'riceUpg'>Gain 1 pound every so often</p>
					<input type = "button"  id = "riceButt" value = "100 Pounds" onclick = "addToRiceCount()">
				</div>
				<div class = "upgrade">
					<h3>Protein Shake</h3>
					<p id = 'pshakeUpg'>Gain 3 pounds every second</p>
					<input type = "button"  id = "pshakeButt" value = "500 Pounds" onclick = "addToPshakeCount()">
				</div><div class = "upgrade">
					<h3>Chicken</h3>
					<p id = 'chickUpg'>Gain 500 pounds every ten seconds</p>
					<input type = "button"  id = "chickButt" value = "2000 Pounds" onclick = "addToChickenCount()">
				</div><div class = "upgrade">
					<h3>Cake</h3>
					<p id = 'cakeUpg'>Eat your heart away</p>
					<input type = "button"  id = "cakeButt" value = "10000 Pounds" onclick = "addToCakeCount()">
				</div>
			</div>
			<div id = "clickMain">
				<center><input type = "image" src = "pics/skinniest.jpg" onclick = imgClicked() id = "but"></center>
			</div>
			<div class = "betterUpgrades">
				<h1>Chefs</h1>
				<div class = "pastrychef">
					<h3>Pastry Chef</h3>
					<p>Increase the amount that each click gives</p>
					<input type = "button" id = "pchefButt" value = "150 Pounds" onclick = "addToPchefCount()">
				</div>
				<div class = "souschef">
					<h3>Sous Chef</h3>
					<p>Double amount given by each base upgrade</p>
					<input type = "button" id = "schefButt" value = "5000 Pounds" onclick = "addToSchefCount()">
				</div>
			</div>
		</div>
		<h1 id = "count">0 Pounds</h1>
	<script>
		var clickCount = 1;
		var count = 0;
		var riceAmount = 0;
		var riceAdd = 0;
		var riceCost = 100;
		var pshakeAmount = 0;
		var pshakeAdd = 0;
		var pshakeCost = 500;
		var chickenAmount = 500;
		var chickenAdd = 0;
		var chickenCost = 2000;
		var cakeAdd = 0;
		var cakeCost = 10000;
		var schefCount = 0;
		var pchefCount = 0;
		var pchefAmount = 0;
		var schefCost = 5000;
		var pchefCost = 150;
		
		setInterval(addRice, 5000);
		setInterval(addPshake, 1000);
		setInterval(addChicken,10000);
		setInterval(addCake, 5000);
		setInterval(checkAndChange, 100);



		function addToPchefCount(){
			if (count > pchefCost){
				count -= pchefCost;
				pchefAmount += 1;
				pchefCost = Math.round(pchefCost*1.25);
				clickCount += pchefAmount;
				document.getElementById("count").innerHTML = count + " Pounds";
				document.getElementById("pchefButt").value = pchefCost + " Pounds";
			}
			else {
				alert("You're not fat enough");
			}
		}
		function addToSchefCount(){
			if (count > schefCost){
				count -= schefCost;
				schefCost = Math.round(schefCost*3);
				riceAdd = riceAdd*2;
				cakeAdd = cakeAdd *2;
				pshakeAdd = pshakeAdd*2;
				chickenAdd = chickenAdd*2;
				document.getElementById("count").innerHTML = count + " Pounds";
				document.getElementById("schefButt").value = schefCost + " Pounds";
			}
			else {
				alert("You're not fat enough");
			}
		}

		function checkAndChange(){
			if (count < 5000){
				document.getElementById("but").src = "pics/skinniest.jpg";
			}
			if (count >= 5000){
				document.getElementById("but").src = "pics/medium.jpg";
			}
			if (count >= 15000){
				document.getElementById("but").src = 'pics/fat.webp';
			}
			if (count >= 100000){
				document.getElementById("but").src = "pics/bigman.jpg";
			}
		}
		function imgClicked(){
			count += clickCount;
			document.getElementById("count").innerHTML = count + " Pounds";
		}

		function addToCakeCount() {
			console.log(cakeCost);
			if (cakeAdd == 0){
				if (count >= cakeCost){
					count -= cakeCost;
					cakeCost = Math.round(cakeCost*1.25);
					cakeAdd += 2000;
					document.getElementById("cakeButt").value = cakeCost + " Pounds";
					document.getElementById("count").innerHTML = count + " Pounds";
				}
				else {
					alert("You're not fat enough");
				}
			}
			else {
				if (count >= cakeCost){
					count -= cakeCost;
					cakeCost = Math.round(cakeCost*1.25);
					cakeAdd += Math.round(cakeAdd*1.3);
					document.getElementById("cakeButt").value = cakeCost + " Pounds";
					document.getElementById("count").innerHTML = count + " Pounds";
				}
				else {
					alert("You're not fat enough");
				}
			}
		}
		
		function addCake() {
			count += cakeAdd;
			document.getElementById("count").innerHTML = count + " Pounds";
		}


		function addToChickenCount() {
			if (chickenAdd == 0){
				if (count >= chickenCost){
					chickenAmount+=200;
					count -= chickenCost;
					chickenCost = Math.round(chickenCost*1.25);
					const s = chickenAmount +1;
					chickenAdd += 500;
					document.getElementById("chickUpg").innerHTML = "Gain " + s + " pounds every second";
					document.getElementById("chickButt").value = chickenCost + " Pounds";
					document.getElementById("count").innerHTML = count + " Pounds";
				}
				else {
					alert("You're not fat enough");
				}
			}
			else {
				if (count >= chickenCost){
					chickenAmount+=200;
					count -= chickenCost;
					chickenCost = Math.round(chickenCost*1.25);
					const s = chickenAmount +1;
					chickenAdd += 200;
					document.getElementById("chickUpg").innerHTML = "Gain " + s + " pounds every second";
					document.getElementById("chickButt").value = chickenCost + " Pounds";
					document.getElementById("count").innerHTML = count + " Pounds";
				}
				else {
					alert("You're not fat enough");
				}
			}

		}
		
		function addChicken() {
			count += chickenAdd;
			document.getElementById("count").innerHTML = count + " Pounds";
		}

		function addToPshakeCount() {
			if (count >= pshakeCost){
				pshakeAmount+=3;
				count -= pshakeCost;
				pshakeCost = Math.round(pshakeCost*1.25);
				const s = pshakeAmount +3;
				pshakeAdd += 3;
				document.getElementById("pshakeUpg").innerHTML = "Gain " + s + " pounds every second";
				document.getElementById("pshakeButt").value = pshakeCost + " Pounds";
				document.getElementById("count").innerHTML = count + " Pounds";
			}
			else {
				alert("You're not fat enough");
			}
		}
		
		function addPshake() {
			count += pshakeAdd;
			document.getElementById("count").innerHTML = count + " Pounds";
		}

		function addToRiceCount() {
			if (count >= riceCost){
				riceAmount+=1;
				riceAdd += 1;
				count -= riceCost;
				riceCost = Math.round(riceCost*1.25);
				const s = riceAmount +1;
				
				document.getElementById("riceUpg").innerHTML = "Gain " + s + " pounds every so often";
				document.getElementById("riceButt").value = riceCost + " Pounds";
				document.getElementById("count").innerHTML = count + " Pounds";
			}
			else {
				alert("You're not fat enough");
			}
		}
		
		function addRice() {
			count += riceAdd;
			document.getElementById("count").innerHTML = count + " Pounds";
		}

	</script>
	
	</body>
	
</html>
