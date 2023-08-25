<?php

namespace JulienMru\BackpackDropzoneField\app\Console\Commands;

use Illuminate\Console\Command;
use Backpack\CRUD\app\Console\Commands\Install as BaseInstall;

class Install extends BaseInstall
{
    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'julienmru:backpackdropzonefield:install
                                {--timeout=300 : How many seconds to allow each process to run.}
                                {--debug : Show process output or not. Useful for debugging. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish assets for Dropzone field';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->progressBar = $this->output->createProgressBar(2);
        $this->progressBar->start();
        $this->info(' JulienMru\BackpackDropzoneField installation started. Please wait...');
        $this->progressBar->advance();

        $this->line(' Publishing assets');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'JulienMru\BackpackDropzoneField\DropzoneFieldServiceProvider',
            '--tag' => 'public',
        ]);

        $this->line(' Publishing views');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'JulienMru\BackpackDropzoneField\DropzoneFieldServiceProvider',
            '--tag' => 'views',
        ]);

        $this->progressBar->finish();
        $this->info(" JulienMru\BackpackDropzoneField successfully installed.");
    }
}
