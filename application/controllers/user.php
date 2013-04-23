<?php

/**
 * User se encarga de mostrar el perfil del usuario conectado, publicar un Nimku y seguir/no seguir otros usuarios.
 */
class User_Controller extends Base_Controller {

	// Declaración del controlador RESTful para utilizar get y post en el nombre de las funciones.
	public $restful = true;

	// Todas las funciones de este controlador primero pasarán por el filtro Auth.
	public function __construct(){
		$this->filter('before', 'auth');
	}
	
	/**
	 * get_index muestra el perfil del usuario conectado con paginácion e información sobre el
	 * número de Nimkus y seguidores.
	 */

	public function get_index()
	{
		// Obtenemos el ID del usuario conectado.
		$all_nimkus = Nimku::where('user_id','=',Auth::user()->id);

		// Los ordenamos por el más reciente y los separamos en lotes de 10.
		$nimkus = $all_nimkus->order_by('created_at','desc')->paginate(10);

		// Contamos el número de Nimkus
		$count = $all_nimkus->count();

		// Contamos los seguidores
		$followers = Follower::where('following_id','=',Auth::user()->id)->count();
	
		return View::make('user.profile')
					->with('count', $count)
					->with('followers', $followers)
					->with('nimkus', $nimkus);
	}

	/**
	 * post_index valida el nuevo Nimku y lo guarda en la base de datos.
	 */
	public function post_index()
	{
		// Filtramos el input del Nimku.
		$new_nimku = array(
        	'nimku'		=> htmlspecialchars(Input::get('new_nimku'))
	    );
	   
	    $rules = array(
	        'nimku'		=> 'required|min:3|max:321'
	    );
	    
	    $validation = Validator::make($new_nimku, $rules);

	    if ($validation->fails())
	    {   
	        return Redirect::to_action('user@index')
	                ->with('user', Auth::User())
	                ->with_errors($validation)
	                ->with_input();
	    }

	    // Agregamos el ID del usuario conectado para guardar el nuevo Nimku.
	    $new_nimku['user_id'] = Auth::user()->id;

	    $critt = new Nimku($new_nimku);
	    $critt->save();
	    return Redirect::to_action('user@index');
	}

	/**
	 * post_follow se encarga de procesar la solicitud cuando se quiere seguir un usuario.
	 */
	public function post_follow()
	{
		// ID del usuario a seguir.
		$following_id = Input::get('id');
		// ID del usuario conectado.
		$follower_id = Auth::user()->id;

		$new_follower = array(
			'user_id' => $follower_id, 
			'following_id' => $following_id
		);

		$follower = new Follower($new_follower);
		$follower -> save();
		return Redirect::back();
	}

	/**
	 * post_unfollow se encarga de procesar la solicitud cuando se quiere dejar de seguir un usuario.
	 */
	public function post_unfollow()
	{
		$following_id = Input::get('id');
		$follower_id = Auth::user()->id;

		Follower::where('user_id','=',$follower_id)->where('following_id','=',$following_id)->delete();
		return Redirect::back();
	}
}