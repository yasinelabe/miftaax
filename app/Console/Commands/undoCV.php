<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class undoCV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cv:undo {modal} {--table_name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Undo Controller and View for a given model';

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle()
    {
        $modal = $this->argument('modal');
        $table_name = $this->option('table_name') ? $this->option('table_name') : strtolower($modal) .'s';

        $this->deleteDirectory(resource_path('views/' . $table_name));
        $this->deleteDirectory(app_path('Http/Controllers/' . $modal . 'Controller.php'));
      
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }
}
