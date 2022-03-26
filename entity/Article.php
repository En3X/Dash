<?php
class Article
{
    public $id,$title,$dis;
    function __construct($id,$title,$dis){
        $this->id=$id;
        $this->title=$title;
        $this->dis=$dis;
    }
}

?>