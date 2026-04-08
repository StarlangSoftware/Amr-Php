<?php

namespace olcaytaner\Amr\Corpus;

class AmrConnection
{
    private AmrWord $from {
        get {
            return $this->from;
        }
    }
    private AmrWord $to {
        get {
            return $this->to;
        }
    }
    private string $with {
        get {
            return $this->with;
        }
    }

    public function __construct(AmrWord $from, AmrWord $to, String $with){
        $this->from = $from;
        $this->to = $to;
        $this->with = $with;
    }
}