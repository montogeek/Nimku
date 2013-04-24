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
}