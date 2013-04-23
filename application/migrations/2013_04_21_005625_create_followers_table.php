<?php

class Create_Followers_Table {    

	public function up()
    {
		Schema::create('followers', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('following_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('followers');

    }

}