<?php

namespace olcaytaner\Amr\Corpus;

use olcaytaner\Corpus\Corpus;

class AmrCorpus extends Corpus
{
    /**
     * A constructor of {@link AmrCorpus} class which reads all {@link AmrSentence} files with the file
     * name satisfying the given pattern inside the given folder. For each file inside that folder, the constructor
     * creates an AmrSentence and puts in inside the list sentences.
     * @param string|null $folder Folder where all sentences reside.
     * @param string|null $pattern File pattern such as "." ".train" ".test".
     */
    public function __construct(?string $folder = null, ?string $pattern = null){
        parent::__construct();
        if ($pattern == null) {
            foreach (glob($folder . '/*.*') as $file) {
                $sentence = new AmrSentence($folder, substr($file, strrpos($file, '/') + 1));
                $this->sentences[] = $sentence;
            }
        } else {
            foreach (glob($folder . '/' . $pattern) as $file) {
                $sentence = new AmrSentence($folder, substr($file, strrpos($file, '/') + 1));
                $this->sentences[] = $sentence;
            }
        }

    }
}