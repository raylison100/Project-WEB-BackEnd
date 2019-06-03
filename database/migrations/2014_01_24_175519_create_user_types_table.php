<?php

use App\Models\UserType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserTypesTable.
 */
class CreateUserTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_types', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name',50);
            $table->timestamps();
		});

        $this->seed();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_types');
	}


    public function seed()
    {
        $types = [
            [
                'name'  => 'ADMIN',
            ],
            [
                'name'  => 'COMMON',
            ]
        ];

        foreach ($types as $type) {
           UserType::create($type);
        }
    }
}
