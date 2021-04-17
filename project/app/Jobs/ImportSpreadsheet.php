<?php

namespace App\Jobs;

use App\Imports\StaysImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportSpreadsheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path;
    private $disk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path, $disk = 'local')
    {
        $this->path = $path;
        $this->disk = $disk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new StaysImport, $this->path);
        Storage::disk($this->disk)->delete($this->path);
    }
}
