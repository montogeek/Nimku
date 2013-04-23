<?php

class Create_Nimkus_Table {    

	public function up()
    {
		Schema::create('nimkus', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->text('nimku');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('nimkus');

    }

}