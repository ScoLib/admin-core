<?php

namespace Sco\Admin\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scoadmin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Sco Admin Package.';

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
        if ($this->checkInstalled()) {
            //return;
        }


        $this->line('');
        $this->info('***********************');
        $this->info('  Welcome to Sco Admin  ');
        $this->info('***********************');
        $this->line('');

        $this->migrate();

        $this->info("Successfully installed Sco Admin! Enjoy :)");
        $this->line('');
        $this->info("You can now login from yourdomain.com/admin !!");

    }

    private function checkInstalled()
    {
        if (config('app.key') !== false && config('app.key') !== '') {
            $this->info('You have already installed Sco Admin!');
            return true;
        }
        return false;
    }

    private function migrate()
    {
        $this->info('Running database migrations');
        $this->line('');
        $this->call('migrate', ['--force' => true]);
        $this->line('');

        $this->info('Seeding database');
        $this->line('');
        $this->call('db:seed', ['--force' => true, '--class' => \AdminTableSeeder::class]);
        $this->line('');
    }
}
