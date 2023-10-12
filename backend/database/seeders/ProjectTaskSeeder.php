<?php

namespace Database\Seeders;

use App\Models\ProjectTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'project_id'    => 1,
                'title'         => 'This is first task of 01'
            ],
            [
                'project_id'    => 1,
                'title'         => 'This is second task of 01'
            ],
            [
                'project_id'    => 1,
                'title'         => 'This is third task of 01'
            ],
            [
                'project_id'    => 1,
                'title'         => 'This is fourth task'
            ],
            [
                'project_id'    => 1,
                'title'         => 'This is fifth task'
            ],
        ];


        foreach ($tasks as $task) {
            ProjectTask::create($task);
        }
    }
}
