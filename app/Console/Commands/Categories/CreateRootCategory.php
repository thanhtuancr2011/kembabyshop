<?php

namespace App\Console\Commands\Categories;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use App\Models\CategoryModel;

class CreateRootCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cmd:create_root_category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create root category';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start...');
        $data = [
            'name' => 'Danh mục gốc',
            'parent_id' => 0,
            'sort_order' => 0,
            'keywords' => 'danh_muc_goc',
            'description' => 'Danh mục gốc',
            'alias' => 'danh_muc_goc'
        ];

        $category = CategoryModel::create($data);

        $this->info('Success...');
    }
}
