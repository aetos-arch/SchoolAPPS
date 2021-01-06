<?php
class VueTechnicien
{

	public function __construct()
	{
	}



	public function afficheMenu()
	{
	}

	public function afficheTickets()
	{
	}

	public function afficheTicket()
	{
	}

	public function nouveauMotDePasse()
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

	public function nouveauMotDePasse()
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
}