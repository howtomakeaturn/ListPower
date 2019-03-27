<?php

namespace App;

use League\Csv\Reader;
use Ramsey\Uuid\Uuid;

class ImportCsv
{
    protected $text;

    protected $userId;

    protected $header;

    protected $records;

    protected $topic;

    function __construct($text, $userId)
    {
        $this->text = $text;

        $this->userId = $userId;
    }

    function handle()
    {
        $this->parse();

        $this->createTopic();

        $this->createEntities();

        return $this->topic->id;
    }

    protected function parse()
    {
        $csv = Reader::createFromString($this->text);

        $csv->setHeaderOffset(0);

        $this->header = $csv->getHeader();

        $this->records = $csv->getRecords();
    }

    protected function createTopic()
    {
        $topic = new Topic();

        $topic->name = 'New List ' . date('Y-m-d');

        $topic->description = '';

        $topic->save();

        $infoSection = new InfoSection();

        $infoSection->meta_key = Uuid::uuid4()->toString();

        $infoSection->meta_label = '基本資訊';

        $infoSection->topic_id = $topic->id;

        $infoSection->save();

        $columnKeys = [];

        foreach ($this->header as $key => $value) {
            if ($key === 0) continue;

            $infoColumn = new InfoColumn();

            $infoColumn->meta_key = Uuid::uuid4()->toString();

            $infoColumn->meta_type = 'string';

            $infoColumn->meta_label = $value;

            $infoColumn->weight = $key;

            $infoColumn->info_section_id = $infoSection->id;

            $infoColumn->save();

            $columnKeys[] = $infoColumn->meta_key;
        }

        $this->topic = $topic;
    }

    protected function createEntities()
    {
        $columns = $this->topic->infoSections->first()->sortedInfoColumns();

        foreach ($this->records as $record) {
            $inited = false;

            $index = 0;

            $entity = new Entity();

            $entity->topic_id = $this->topic->id;

            $entity->user_id = $this->userId;

            foreach ($record as $key => $value) {
                if (!$inited) {
                    $entity->name = $value;

                    $entity->save();

                    $inited = true;

                    continue;
                }

                if ($value) {
                    $field = new InfoField();

                    $field->entity_id = $entity->id;

                    $field->meta_key = $columns->slice($index, 1)->first()->meta_key;

                    $field->meta_value = ($value);

                    $field->save();
                }

                $index += 1;
            }
        }
    }
}
