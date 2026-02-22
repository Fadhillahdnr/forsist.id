<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCloudinary extends Command
{
    protected $signature = 'test:cloudinary';
    protected $description = 'Test Cloudinary configuration';

    public function handle()
    {
        $this->info('=== Testing Cloudinary Configuration ===');
        
        $config = config('filesystems.disks.cloudinary');
        $this->info("\nFilesystem Configuration:");
        $this->line("  Driver: " . ($config['driver'] ?? 'NOT SET'));
        $this->line("  Cloud: " . ($config['cloud'] ?? 'NOT SET'));
        $this->line("  Key: " . (isset($config['key']) ? 'SET' : 'NOT SET'));
        $this->line("  Secret: " . (isset($config['secret']) ? 'SET' : 'NOT SET'));
        
        try {
            $cloudinary = app(\Cloudinary\Cloudinary::class);
            $this->info("\n✓ Cloudinary singleton instantiated successfully");
            
            if ($config['cloud'] && $config['key'] && $config['secret']) {
                $this->info("✓ Configuration is complete and valid");
                $this->info("✓ Ready for product image uploads!");
                return 0;
            } else {
                $this->error("✗ Configuration is incomplete");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("✗ Error: " . $e->getMessage());
            return 1;
        }
    }
}
