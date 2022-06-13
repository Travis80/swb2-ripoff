<?php
session_start();

/*
So I need to save the user name in the session
then after that I need to save it in a json file for the profile
and be able to access it when I need to
I also need an update system that doesnt
just work on mousemove because that is way
much information

*/
?>
<html>
	<head>
		<link rel="stylesheet" href="stylesheet.css">
	</head>
	<body>
		<p id="mouseloc"></p>
		<div id="submit" class="flex-column-container-nowrap" style="background-color: #ffffff;">
			<div style="flex: 1 1 0;">
				<h1 class="title">Multiplayer Drawing Game</h1>
			</div>
			<div style="flex: 2 1 0;">
				<div style="border-radius: 20px; border: 1px solid #b8b8b8; padding: 20px; width: 600px; background-color: #f8f8f8;"> 
					<label style="width: 100%; padding: 8px 0px;" for="user">Enter username:</label>
					<input style="width: 100%; margin: 20px 0px;" type="text" id="user"/>
					<button class="btn-generic" style="margin: 8px 0px;" onclick="submitUser();">Submit</button>
				</div>
			</div>
		</div>
		<script>

			function submitUser()
			{
				console.log("submit user");
				document.getElementById("submit").style.display = "none";
				let user = document.getElementById("user").value;
				uploadInfo({func:"register", user}, startGame);
			}

			function startGame(response)
			{
				//console.log(response);
				//here I redirect to the joingame.html
				window.location = "./JoinGame.php";
			}

			function uploadInfo(post, callback)
			{
				fetch("../api/api.php", {
					method: 'POST',
					headers:{
						'Content-Type':'application/json',
					},
					body: JSON.stringify(post),
				})
				.then(response => response.text())
				.then(data => {
					if(callback)
						callback(data);
				});
			}
		</script>
	</body>
</html>
