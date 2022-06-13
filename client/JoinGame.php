<?php
session_start();

//when joining this game I need to set the game uuid of the session
if(!isset($_SESSION['uuid']))
{
	//go to the welcome page
	header('Location: Welcome.php');
}

?>
<html>
	<head>
		<link rel="stylesheet" href="stylesheet.css">
	</head>
	<body>
		<div class="flex-column-container-nowrap">
			<div style="flex: 1 1 0;">
				<h1>Join Game</h1>
			</div>
			<div style="flex: 2 1 0;">
				<h3>List of current games</h3>
				<div id="game-list">
			
				</div>
				<button class="btn-generic" id="create-new-game">Create New</button>
			</div>
		</div>
		<div id="new-game-modal" class="modal">
			<div class="modal-content">
				<input id="game-name" type="text" placeholder="Name">
				<label for="game-type">Select Game Type:</label>
				<select id="game-type">
					<option value="draw">Drawing Game</option>
					<option value="society">Society Game</option>
				</select>
				<button id="submit-new-game" class="btn-generic">Create Game</button>
			</div>
		</div>
		<script>
			var modal = document.getElementById("new-game-modal");
			document.getElementById("create-new-game").addEventListener("click", (e) => 
			{
				//ideally bring up a modal to name the game and select the type
				modal.style.display = "block";
			});
			document.getElementById("submit-new-game").addEventListener("click", (e) =>
			{
				console.log(document.getElementById("game-name").value+" "+ document.getElementById("game-type").value);
				uploadInfo({func:"newGame", name:document.getElementById("game-name").value, type:document.getElementById("game-type").value}, redirect);
			});

			window.onclick = (e) => {
				if(e.target == modal)
					modal.style.display = "none"
			};
	
			uploadInfo({func:"currentGames"}, fillList);
			//run at the start
			//this function needs a better name and i need to make sure
			//i am more discrete about the naming so people can't do
			//weird shit with my server
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
			function printData(data)
			{
				console.log(data);
			}
			function redirect(data)
			{
				window.location = "/client/"+data;
			}
			function fillList(data)
			{
				console.log(data);
				data = JSON.parse(data);
				let games = document.getElementById("game-list");
				for(let i = 0; i < data.length; i++)
				{
					let item = document.createElement("button");
					item.classList = "btn-generic";
					item.innerHTML = data[i];
					item.setAttribute("onclick", "redirect('"+data[i]+".php')");
					games.append(item);
				}
			}
		</script>
	</body>
</html>
