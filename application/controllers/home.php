<?php

/*
* Home se encarga de mostrar la página de inicio, procesar los formularios de inicio
* de sesión, registro y desconectarse de la aplicación.
*/

class Home_Controller extends Base_Controller {

	// Declaración del controlador RESTful para utilizar get y post en el nombre de las funciones.
	public $restful = true;

	public function __construct() 
    {
        $this->filter('before', 'csrf')->on('post');
    }

	/**
	 * get_index verifica si el usuario ya está conectado, si no lo está muestra la página de inicio, 
	 * si está conectado muestra todos los Nimkus de los usuarios.
	 */
	public function get_index()
	{
		if (Auth::guest()){
			return View::make('home.index');
		} else {
			$nimkus = Nimku::with('user')->order_by('created_at','desc')->paginate(10) ;
			$count = Nimku::count() ;
			return View::make('home.critterfeed')
				-> with('count', $count)
				-> with('nimkus', $nimkus);
		}
	}

	/**
	 * post_index se encarga de procesar el formulario de registro de la página de inicio.
	 */
	public function post_index()
	{
		$new_user = array(
	        'name'		=> Input::get('name'),
	        'username'  => Input::get('nuevo_username'),
	        'password'  => Input::get('nuevo_password')
    	);
   
    	$rules = array(
	        'name'		=>	'required|min:3|max:255',
	        'username'  =>	'required|min:3|max:128|alpha_dash|unique:users',
	        'password'	=>	'required|min:3|max:128'
    	);
    
	    $validation = Validator::make($new_user, $rules);

	    if ($validation->fails())
	    {   
	        return Redirect::home()
	                ->with('user', Auth::user())
	                ->with_errors($validation)
	                ->with_input('except', array('nuevo_password'));
	    }
	    $new_user['password'] = Hash::make($new_user['password']);

	    $user = new User($new_user);
	    $user->save();

	    return Redirect::to_action('home@login')->with('success_message', true);
	}

	/**
	 *  get_login muestra el formulario de inicio de sesión.
	 */
	public function get_login()
	{
    	return View::make('home.login');
	}


	/**
	 * post_login procesa el formulario de inicio de sesión, si los datos ingresados concuerdan 
	 * con los de la base de datos.
	 */
	public function post_login()
	{
		
		$remember = Input::get('remember');
 		$credentials = array(
 			'username' => Input::get('username'), 
 			'password' => Input::get('password'),
 			'remember' => !empty($remember) ? $remember : null
 		);
 		
    	if(Auth::attempt($credentials)){
		 	return Redirect::to_action('user@index');
		}else{
			return Redirect::to_action('home@login')
							->with_input('only', array('username')) 
							->with('error_login', true);
        }
	}

	/**
	 * get_logout cierra la sesión del usuario y redirecciona al formulario de inicio de sesión
	 * con un mensaje de cierre de sesión.
	 */
	public function get_logout()
	{
		Auth::logout();
		return Redirect::to_action('home@login')->with('logout_message', true);
	}
}