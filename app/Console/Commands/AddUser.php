<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '通过命令台的方式添加用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info('要添加一个用户请输入以下信息');
        $name = $this->ask('请输入所添加用户的用户名?');
        $email = $this->ask('请输入想要添加用户的邮箱？');
        $password = $this->secret('请添加用户密码?');

        if ($this->confirm('你确定要继续操作吗? [y|N]')) {
            User::create(['name'=>$name,'email'=>$email,'password'=>bcrypt($password)]);
            $this->info('用户名为'.$name.'邮箱为'.$email.'已经添加成功');
        }
    }
}
