<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BasicTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function createReviewColumn($topicId)
    {
        $faker = Faker\Factory::create();

        $id = DB::table('review_columns')->insertGetId([
            'topic_id' => $topicId,
            'meta_key' => Ramsey\Uuid\Uuid::uuid4()->toString(),
            'meta_label' => $faker->word,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    function createInfoSectionsAndColumns($topicId)
    {
        $faker = Faker\Factory::create();

        foreach ([1,2] as $int) {
            $id = DB::table('info_sections')->insertGetId([
                'topic_id' => $topicId,
                'meta_key' => Ramsey\Uuid\Uuid::uuid4()->toString(),
                'meta_label' => $faker->words($nb = 3, $asText = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach ([1,2,3] as $int2) {
                DB::table('info_columns')->insertGetId([
                    'info_section_id' => $id,
                    'meta_key' => Ramsey\Uuid\Uuid::uuid4()->toString(),
                    'meta_type' => 'string',
                    'meta_label' => $faker->word,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            DB::table('info_columns')->insertGetId([
                'info_section_id' => $id,
                'meta_key' => Ramsey\Uuid\Uuid::uuid4()->toString(),
                'meta_type' => 'city',
                'meta_label' => $faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    function createReviewFields($entityId)
    {
        $entityRow = DB::table('entities')->where('id', $entityId)->first();

        $topicRow = DB::table('topics')->where('id', $entityRow->topic_id)->first();

        $columns = DB::table('review_columns')->where('topic_id', $topicRow->id)->get();

        foreach ($columns as $column) {
            DB::table('review_fields')->insert([
                'entity_id' => $entityId,
                'meta_key' => $column->meta_key,
                'meta_value' => rand(1, 5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    function createInfoFields($entityId)
    {
        $entityRow = DB::table('entities')->where('id', $entityId)->first();

        $topicRow = DB::table('topics')->where('id', $entityRow->topic_id)->first();

        $sections = DB::table('info_sections')->where('topic_id', $topicRow->id)->get();

        $columns = DB::table('info_columns')->whereIn('info_section_id', $sections->pluck('id')->all())->get();

        $faker = Faker\Factory::create();

        foreach ($columns as $column) {
            if ($column->meta_type === 'string') {
                $value = $faker->sentence;
            } else if ($column->meta_type === 'city') {
                $value = config('city')[array_rand(config('city'))];
            }

            DB::table('info_fields')->insert([
                'entity_id' => $entityId,
                'meta_key' => $column->meta_key,
                'meta_value' => ($value),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    function createReviewCells($reviewId)
    {
        $reviewRow = DB::table('reviews')->where('id', $reviewId)->first();

        $entityRow = DB::table('entities')->where('id', $reviewRow->entity_id)->first();

        $topicRow = DB::table('topics')->where('id', $entityRow->topic_id)->first();

        $columns = DB::table('review_columns')->where('topic_id', $topicRow->id)->get();

        foreach ($columns as $column) {
            DB::table('review_cells')->insert([
                'review_id' => $reviewId,
                'meta_key' => $column->meta_key,
                'meta_value' => rand(1, 5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    function createPhotos($entityId)
    {
        $entityRow = DB::table('entities')->where('id', $entityId)->first();

        DB::table('photos')->insert([
            'entity_id' => $entityId,
            'user_id' => 1,
            'url' => 'https://source.unsplash.com/random',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    function createEditingCells($editingId)
    {
        $editingRow = DB::table('editings')->where('id', $editingId)->first();

        $entityRow = DB::table('entities')->where('id', $editingRow->entity_id)->first();

        $topicRow = DB::table('topics')->where('id', $entityRow->topic_id)->first();

        $sections = DB::table('info_sections')->where('topic_id', $topicRow->id)->get();

        $columns = DB::table('info_columns')->whereIn('info_section_id', $sections->pluck('id')->all())->get();

        $faker = Faker\Factory::create();

        foreach ($columns as $column) {
            if ($column->meta_type === 'string') {
                $value = $faker->sentence;
            } else if ($column->meta_type === 'city') {
                $value = config('city')[array_rand(config('city'))];
            }

            DB::table('editing_cells')->insert([
                'editing_id' => $editingId,
                'meta_key' => $column->meta_key,
                'meta_value' => ($value),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    function createTags($entityId)
    {
        $entityRow = DB::table('entities')->where('id', $entityId)->first();

        $topicRow = DB::table('topics')->where('id', $entityRow->topic_id)->first();

        $faker = Faker\Factory::create();

        $loop = rand(0,5);

        for ($i=0; $i < $loop; $i++) {
            $id = DB::table('tags')->insertGetId([
                'topic_id' => $topicRow->id,
                'name' => $faker->word,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('entity_tag')->insertGetId([
                'entity_id' => $entityRow->id,
                'tag_id' => $id,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            'name' => '尤阿川',
            'email' => 'howtomakeaturn@hotmail.com',
            'password' => '',
            'github' => '',
            'avatar' => 'https://avatars2.githubusercontent.com/u/1255050?v=4'
        ]);

        for ($i=0; $i < 4; $i++) {
            $id = DB::table('topics')->insertGetId([
                'name' => $faker->name,
                'description' => $faker->sentences(2, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $this->createReviewColumn($id);
            $this->createReviewColumn($id);
            $this->createReviewColumn($id);
            $this->createReviewColumn($id);

            $this->createInfoSectionsAndColumns($id);

            DB::table('topic_user')->insert([
                'topic_id' => $id,
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            for ($j=0; $j < 8; $j++) {
                $entityId = DB::table('entities')->insertGetId([
                    'name' => $faker->name,
                    'topic_id' => $id,
                    'user_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $this->createTags($entityId);

                $this->createReviewFields($entityId);

                $this->createInfoFields($entityId);

                for ($k=0; $k < 5; $k++) {
                    DB::table('comments')->insertGetId([
                        'entity_id' => $entityId,
                        'user_id' => 1,
                        'content' => $faker->paragraph,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    $reviewId = DB::table('reviews')->insertGetId([
                        'entity_id' => $entityId,
                        'user_id' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    $this->createReviewCells($reviewId);

                    $editingId = DB::table('editings')->insertGetId([
                        'entity_id' => $entityId,
                        'user_id' => 1,
                        'name' => md5(rand()),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    $this->createEditingCells($editingId);

                    $this->createPhotos($entityId);
                }
            }
        }

    }
}
