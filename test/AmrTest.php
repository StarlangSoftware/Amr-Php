<?php

use olcaytaner\Amr\Corpus\AmrCorpus;
use olcaytaner\Amr\Corpus\AmrSentence;
use PHPUnit\Framework\TestCase;

class AmrTest extends TestCase
{
    public function testAmr(){
        $wordCounts = [5, 5, 4, 4, 8, 6, 7, 6, 3, 7, 7];
        $connectionCounts = [5, 4, 3, 3, 7, 7, 6, 5, 2, 6, 6];
        $corpus = new AmrCorpus("../sentences");
        for ($i = 0; $i < 11; $i++){
            $sentence = $corpus->getSentence($i);
            echo $i;
            if ($sentence instanceof AmrSentence){
                $this->assertEquals($wordCounts[$i], $sentence->wordCount());
                $this->assertEquals($connectionCounts[$i], $sentence->connectionCount());
            }
        }
    }
}