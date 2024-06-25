<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ColorGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'colors:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a set of colors from config/colors.php to use in tailwind config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contents = 'export default '.json_encode(config('colors'));
        $file = File::put(base_path('.generated_colors.js'), $contents);
        $this->info('Colors successfully generated from [config/colors.php] to [generated_colors.js]');
    }
}
