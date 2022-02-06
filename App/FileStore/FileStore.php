<?php

namespace app\FileStore;

use Iterator;
use SplFileObject;


class FileStore implements Iterator
{

    protected int $index = 0;

    private $file;

    public function __construct(string $filename)
    {
        $this->file = new SplFileObject($filename);
    }

    public function current()
    {
        $this->generator();
        return null;
    }

    function generator()
    {
        while (!$this->file->eof()) {
            yield $this->file->fgets();
        }
    }

    public function next()
    {
        $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->lines[$this->index]);
    }

    public function rewind()
    {
        $this->index = 0;
    }
}