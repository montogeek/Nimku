<?php

/**
 * Nimku se encarga de mostrar un nimku específico.
 */

class Nimku_Controller extends Base_Controller {
	
	// Si el usuario ingresa a /Nimku se redirecciona al controlador Home.
	public function action_index()
	{
		return Redirect::home();
	}

	/**
	 * Recibe un nombre de usuario, encuentra su id e información sobre sus seguidores y nimkus
	 * y los muestra en la vista Nimku.profile
	 * @param $username nombre de usuario
	 */
	public function action_show($nimku_id)
	{
		// Obtenemos el ID del Nimku, el texto, el usuario, y cuando se creó.
		$user_id = Nimku::where('id','=',$nimku_id)->only('user_id');

		$nimku = Nimku::where('id','=',$nimku_id)->only('nimku');

		$username = User::where('id','=',$user_id)->only('username');

		$name = User::where('id','=',$user_id)->only('name');

		$updated_at = Nimku::where('id','=',$nimku_id)->only('updated_at');

		$followers = 0;

		// Si el ID no existe mostramos un error.
		if ($nimku == null) {
			echo "El nimku no existe.";
		} else {

			// Cargamos los Nimkus del usuario
			$all_nimkus = Nimku::with('user')->where('user_id','=',$user_id);
			// Contamos los seguidores
			$followers = Follower::where('following_id','=',$user_id)->count();

			return View::make('nimku.nimku')
						->with('username', $username)
						->with('user_id', $user_id)
						->with('name', $name)
						->with('followers', $followers)
						->with('nimku', $nimku)
						->with('updated_at', $updated_at);
		}
	}

}
