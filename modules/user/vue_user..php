<?php
class VueUser
{

	public function __construct()
	{
	}

	public function ticket()
	{
		echo ' <h3>Création ticket</h3>
		<hr class="mt-2 mb-4">

		<form action="" method="POST">
			<div class="row">
				<div class="col-4 form-group">
					<label for="intitule">intitule</label>
					<input type="text" name="intitule" required value="intitule" class="form-control">
				</div>
				<div class="col-4 form-group">
					<label for="explication">explication</label>
					<textarea name="explication" required rows="5" cols="33" class="form-control">
				</div>
			<button type="submit" class="btn btn-primary d-block mb-2">Envoyer</button>
		</form>';
	}

	public function newPass()
	{
		echo  '<h3>Changer votre mot de passe</h3>
		<hr class="mt-2 mb-4">
		
		<form action="" method="post">
			<div class="row">
				<div class="col-4 form-group">
					<label for="old_password">Ancien mot de passe</label>
					<input type="password" name="old_password" class="form-control" required>
				</div>
				<div class="col-4 form-group">
					<label for="new_password1">Nouveau mot de passe</label>
					<input type="password" name="new_password1" class="form-control" required>
				</div>
		
				<div class="col-4 form-group">
					<label for="new_password2">Confirmation mot de passe</label>
					<input type="password" name="new_password2" class="form-control" required>
				</div>		
				<div class="col-4">
					<button type="submit" class="btn btn-primary">Modifier</button>
				</div>
			</div>
		</form>';
	}

	public function newPseudo()
	{
		echo '<h3>Changer de pseudo</h3>
		<hr class="mt-2 mb-4">
		
		<div class="card-panel  lighten-4">
			<form action="user/newPseudo" method="POST" >
				<div class="row">
					<div class="col-4 form-group">
						<label for="newPseudo">Nouveau pseudo</label>
						<input name="newPseudo" type="text" class="form-control">
						<button style="margin-top:20px;"class="btn btn-primary" type="submit" name="action">Valider</button>
					</div>
				</div>
			</form>
		</div>';
	}


	public function printMenu()
	{
	}

	public function printCommandes()
	{
	}
}
