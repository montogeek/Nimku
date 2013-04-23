<?php

/**
 * Others se encarga de mostrar el perfil de otros usuarios con su respectiva información.
 */

class Others_Controller extends Base_Controller {
	
	// Si el usuario ingresa a /others se redirecciona al controlador Home.
	public function action_index()
	{
		return Redirect::home();
	}

	/**
	 * Recibe un nombre de usuario, encuentra su id e información sobre sus seguidores y nimkus
	 * y los muestra en la vista others.profile
	 * @param $username nombre de usuario
	 */
	public function action_show($username)
	{
		// Obtenemos el ID del usuario.
		$user_id = User::where('username','=',$username)->only('id');

		$following = null;
		$followers = 0;

		// Si el ID no existe mostramos un error.
		if ($user_id == null) {
			echo "El usuario no existe.";
		} 
		else {
			if (Auth::user()){

				// Si el usuario entra a su propio perfil lo redireccionamos a user@index
				if ($user_id == Auth::user()->id){
					return Redirect::to_action('user@index');
				} 
				
				// Comprobamos si el usuario actual ya esta siguiendo al usuario que estamos visitando.
				$following = (Follower::where('user_id','=',Auth::user()->id)->where('following_id','=',$user_id)->get()) ? true : false ; 
			}

			// Cargamos los Nimkus del usuario
			$all_nimkus = Nimku::with('user')->where('user_id','=',$user_id);
			// Los ordenamos por el más reciente y los separamos en lotes de 10.
			$nimkus = $all_nimkus->order_by('created_at','desc')->paginate(10);
			// Contamos el número de Nimkus
			$nimkus_count = $all_nimkus->count();
			// Contamos los seguidores
			$followers = Follower::where('following_id','=',$user_id)->count();

			return View::make('others.profile')
						->with('username', $username)
						->with('user_id', $user_id)
						->with('following', $following)
						->with('followers', $followers)
						->with('count', $nimkus_count)
						->with('nimkus', $nimkus);
		}
	}

}
