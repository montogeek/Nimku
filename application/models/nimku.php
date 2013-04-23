<?php

// A nimku belongs to a user
class Nimku extends Eloquent 
{
	public function user(){
		return $this -> belongs_to('User');
	}
}