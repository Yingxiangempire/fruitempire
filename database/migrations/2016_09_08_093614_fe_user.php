<?php class FeUser extends CreateBase
{
    protected $table = "fe_user";

    public function create(&$table)
    {
        $table->increments('id');
        $table->string("nick_name", 100);
        $table->string("unionID",100);
        $table->string("avatar", 150);
        $table->string("password", 100);
        $table->string("mobile",30);
        $table->tinyInteger("state");
        $table->integer("pID");
        $table->dateTime("created_at");
        $table->dateTime("updated_at");
        $table->index('pID');
    }
}