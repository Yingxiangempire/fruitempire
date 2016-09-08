<?php class AdminUser extends CreateBase
{
    protected $table = "fe_administer";
    protected $connection = "yunku_boss";

    public function create(&$table)
    {
        $table->increments('id');
        $table->string("account", 30);
        $table->string("password", 30);
        $table->string("name", 30);
        $table->string("email", 30)->unique();
        $table->string("qq",30);
        $table->string("weixin", 30);
        $table->string("avatar", 30);
        $table->tinyInteger("state");
        $table->dateTime("created_at");
        $table->dateTime("updated_at");
        
    }
}