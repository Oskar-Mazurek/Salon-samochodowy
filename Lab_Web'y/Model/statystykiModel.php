<?php
 class Model{
    public $fileName;
    public $content;    

    public function getRecord()
    {
        $file=@fopen($this->fileName, "r");
        $length=filesize($this->fileName);
        $this->content=fread($file, $length);
        fclose($file);
    }
    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }
    function getFileName()
    {
        return $this->fileName;
    }
    public function getContent() {
        return $this->content;
    }
    public function checkFilename(){
        if(empty($this->fileName)){
            return false;
        }
        else{
            return true;
        }
    }
 }
?>