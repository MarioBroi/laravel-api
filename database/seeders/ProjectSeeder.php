<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->words(2, true);
            $project->slug = Str::of($project->title)->slug('-');
            /* $project->type_id = $faker->numberBetween(1, 3); */
            $project->project_link = $faker->url();
            $project->project_github = $faker->url();
            $project->description = $faker->text(20);
            $project->project_img = $faker->imageUrl(600, 300, 'Project', true, $project->title, true, 'jpg');
            $project->save();
        }
    }
}
