<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BasicTablesSeeder::class);

        $this->insertRealData();
    }

    function insertRealData()
    {
        $files = [
            [
                'file' => 'bar-data.csv',
                'name' => '適合下班後小酌的酒吧清單',
                'description' => '蒐集全台灣，最適合下班後小酌一杯的酒吧清單。'
            ],
            [
                'file' => 'web-agency-data.csv',
                'name' => '網站與手機APP接案公司清單',
                'description' => '收錄台灣專門接網站、手機APP類型案件的接案公司資訊。'
            ],
            [
                'file' => 'coffee-data.csv',
                'name' => '網路咖啡豆推薦清單',
                'description' => '整理了烘焙手法、特殊豆子、證照與得獎紀錄等等資訊。'
            ],
        ];

        foreach ($files as $file) {
            $content = File::get(storage_path($file['file']));

            $service = new App\ImportCsv($content, 1);

            $id = $service->handle();

            $topic = App\Topic::find($id);

            $topic->name = $file['name'];

            $topic->description = $file['description'];

            $topic->save();

            DB::table('topic_user')->insert([
                'topic_id' => $id,
                'user_id' => 1
            ]);
        }
    }
}
