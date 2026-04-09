<?php

namespace olcaytaner\Amr\Corpus;

class AmrConnection
{
    private AmrWord $from;
    private AmrWord $to;
    private string $with;

    public function __construct(AmrWord $from, AmrWord $to, String $with){
        $this->from = $from;
        $this->to = $to;
        $this->with = $with;
    }

    public function getFrom(): AmrWord
    {
        return $this->from;
    }

    public function getTo(): AmrWord
    {
        return $this->to;
    }

    public function getWith(): string
    {
        return $this->with;
    }
}