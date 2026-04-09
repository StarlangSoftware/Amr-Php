<?php

namespace olcaytaner\Amr\Corpus;

use olcaytaner\Dictionary\Dictionary\Word;

class AmrWord extends Word
{
    protected Point $position;

    public function __construct(string $name, Point $position)
    {
        parent::__construct($name);
        $this->position = $position;
    }

    public function getPosition(): Point{
        return $this->position;
    }
}