<?php
class Api_Controller extends Base_Controller{
	public $restful = true;

	public function get_nimkus(){

		//Traer todos los nimkus
		$all = Nimku::with('user')->order_by('created_at','desc')->get();

		//Variable que se exportará en JSON
		$nimkus = array();

		//Recorremos todos los nimkus para extraer solo los datos que nos importan
		foreach($all as $nimku){

			//Almacenando los datos necesarios en el arreglo a exportar
			$nimkus[] = array(

				//Nombre de usuario del autor del nimku
				'username' => $nimku->user->username,

				//Nombre completo del autor del nimku
				'name' => $nimku->user->name,

				//Contenido del nimku
				'nimku' => $nimku->nimku,

				//Fecha de publicación del nimku
				'created_at' => $nimku->created_at
			);
		}

		//Mostrar el JSON
		return Response::json($nimkus);
	}

	public function get_users(){

		//Traer todos los usuarios
		$all = User::order_by('created_at', 'asc')->get();

		//Variable que se exportará en JSON
		$users = array();

		//Recorremos todos los usuarios para extraer solo los datos que nos importan
		foreach($all as $user){

			// Obtenemos el ID del usuario conectado.
			$all_nimkus = Nimku::where('user_id','=',$user->id);

			// Contamos el número de Nimkus
			$count = $all_nimkus->count();

			//Almacenando los datos necesarios en el arreglo a exportar
			$users[] = array(

				//Nombre de usuario
				'username' => $user->username,

				//Nombre completo
				'name' => $user->name,

				//Fecha de creación del usuario
				'created_at' => $user->created_at,

				//Cantidad de seguidores
				'followers' => Follower::where('following_id','=',$user->id)->count(),

				//Cantidad de nimkus publicados
				'nimkus' => $count
			);
		}

		//Mostrar el JSON
		return Response::json($users);
	}

	//Traer los Nimkus de un user
	public function get_nimkusbyuser($username)
	{
		//Traer el Id del user solicitado
		$user_id = User::where_username($username)->only('id');

		//Traer todos los Nimkus del user solicitado y lo ordena de manera desc
		$user_nimkus = Nimku::where('user_id','=',$user_id);
		$desc_user_nimkus = $user_nimkus->order_by('created_at','desc')->get();

		//Contamos cuantos Nimkus tiene el user
		$count = $user_nimkus->count();

		//Variable que se exportará en JSON
		$nimku = array();
		//Recorremos todos los nimkus para extraer solo los datos que nos importan
		foreach($desc_user_nimkus as $user_nimku){
			//Almacenando los datos necesarios en el arreglo a exportar
			$nimku[] = array(
				'nimku' => $user_nimku->nimku,
				'created_at' => $user_nimku->created_at,
				'nimkus' => $count
			);
		}
		//Mostrar el JSON
		return Response::json($nimku);
	}

	//Buscar usuarios por su name o por el username
	public function get_usersbyname($name)
	{
		$result = User::where('name', 'LIKE', '%' . $name . '%')
            ->or_where('username', 'LIKE', '%' . $name . '%')
            ->get();
        
        //Variable que se exportará en JSON
		$user = array();
        foreach($result as $user_result){
	    	//Cuantos followers tiene el usuario
	        $followers = Follower::where('following_id','=',$user_result->id)->count();

	        //A cuantos sigue
	        $following = Follower::where('user_id','=',$user_result->id)->count();

			//Almacenando los datos necesarios en el arreglo a exportar
			$user[] = array(
				'name' => $user_result->name,
				'username' => $user_result->username,
				'followers' => $followers,
				'following' => $following
			);
		}
		//Mostrar el JSON
		return Response::json($user);
	}

	//Buscar Nimkus por ninku
	public function get_nimkusbytext($text)
	{
		$nimkus = nimku::where('nimku', 'LIKE', '%' . $text . '%')
			->order_by('created_at','desc')
			->get();
		
		//Variable que se exportará en JSON
		$nimku = array();
		//Recorremos todos los nimkus para extraer solo los datos que nos importan
		foreach($nimkus as $one_ninku){
			//Almacenando los datos necesarios en el arreglo a exportar
			$nimku[] = array(
				'username' => $one_ninku->user->username,
				'nimku' => $one_ninku->nimku,
				'created_at' => $one_ninku->created_at
			);
		}
		//Mostrar el JSON
		return Response::json($nimku);
	}

}