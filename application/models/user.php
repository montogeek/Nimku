<?php

// A user has many nimkus and has many and belongs to followers
class User extends Eloquent 
{
	public function nimkus(){
		return $this -> has_many('Nimku');
	}

	public function followers(){
		return $this -> has_many_and_belongs_to('Follower');
	}

}