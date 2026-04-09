<?php

namespace olcaytaner\Amr\Corpus;

use olcaytaner\Corpus\FileDescription;
use olcaytaner\Corpus\Sentence;
use olcaytaner\XmlParser\XmlDocument;

class AmrSentence extends Sentence
{
    private array $connections;
    private FileDescription $fileDescription;

    public function __construct(string $path, string $fileName){
        $this->fileDescription = new FileDescription($path, $fileName);
        $this->connections = [];
        $this->reload();
    }

    private function reload(): void{
        $doc = new XmlDocument($this->fileDescription->getFileName());
        $doc->parse();
        $rootNode = $doc->getFirstChild();
        $this->words = [];
        $objectNode = $rootNode->getFirstChild();
        while ($objectNode != null) {
            if ($objectNode->hasAttributes()){
                $objectName = $objectNode->getName();
                if ($objectName == "Word"){
                    $word = new AmrWord($objectNode->getAttributeValue("name"), new Point((int)$objectNode->getAttributeValue("positionX"), (int)$objectNode->getAttributeValue("positionY")));
                    $this->addWord($word);
                } else {
                    if ($objectName == "Connection"){
                        $from = $this->getWordWithName($objectNode->getAttributeValue("from"));
                        $to = $this->getWordWithName($objectNode->getAttributeValue("to"));
                        if ($objectNode->getAttributeValue("with") != ""){
                            $with = $objectNode->getAttributeValue("with");
                        } else {
                            $with = "";
                        }
                        if ($from != null && $to != null){
                            $this->addConnection($from, $to, $with);
                        }
                    }
                }
            }
            $objectNode = $objectNode->getNextSibling();
        }
    }

    public function getRawFileName(): string{
        return $this->fileDescription->getRawFileName();
    }

    public function getFileName(): string{
        return $this->fileDescription->getFileName();
    }

    public function getFolder(): string{
        return substr($this->fileDescription->getPath(), strrpos($this->fileDescription->getPath(), '/'));
    }

    private function getWordWithName(string $name): ?AmrWord{
        foreach ($this->words as $word){
            if ($word->getName() == $name){
                return $word;
            }
        }
        return null;
    }

    public function getConnection(int $index): AmrConnection{
        return $this->connections[$index];
    }

    public function connectionCount(): int{
        return count($this->connections);
    }

    public function getFileDescription(): FileDescription
    {
        return $this->fileDescription;
    }

    public function addConnection(AmrWord $from, AmrWord $to, string $with): void{
        $this->connections[] = new AmrConnection($from, $to, $with);
    }
}