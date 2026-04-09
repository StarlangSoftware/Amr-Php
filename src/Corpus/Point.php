<?php

namespace olcaytaner\Amr\Corpus;

class Point
{
    private int $x {
        get {
            return $this->x;
        }
        set {
            $this->x = $value;
        }
    }
    private int $y {
        get {
            return $this->y;
        }
        set {
            $this->y = $value;
        }
    }

    public function __construct(int $x, int $y){
        $this->x = $x;
        $this->y = $y;
    }

}