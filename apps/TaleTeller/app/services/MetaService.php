<?php

require_once BASE_PATH . '/app/Repositories/MetaReader.php';
require_once BASE_PATH . '/app/Repositories/MetaWriter.php';

class MetaService
{
    private MetaReader $reader;
    private MetaWriter $writer;

    public function __construct()
    {
        $this->reader = new MetaReader();
        $this->writer = new MetaWriter();
    }

    public function create(array $data): int
    {
        if($this->reader->existsByTitle($data['title'])) { throw new RuntimeException('Title already exists...'); }
        return $this->writer->create($data);
    }
}
