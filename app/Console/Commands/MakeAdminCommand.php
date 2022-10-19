<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Hash;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command create a new admin';

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
     * Retrieves the entered email and password and creates a new user with this information.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Qual o seu email?');

        $password = $this->secret('Qual a sua senha?');

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ])->assignRole('admin');

        $this->info('Administrador criado com sucesso!');

        $this->newLine();

        return 0;
    }
}
