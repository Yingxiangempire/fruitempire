<?php class FeUser extends CreateBase
{
    protected $table = "fe_user";
    protected $connection = "yunku_boss";

    public function create(&$table)
    {
        $table->increments('id');
        $table->string("nick_name", 30);
        $table->smallInteger("unionID");
        $table->string("avatar", 30);
        $table->string("password", 30);
        $table->integer("mobile");
        $table->tinyInteger("state");
        $table->integer("pID");
        $table->dateTime("created_at");
        $table->dateTime("updated_at");
        $table->index('pID');
    }
}