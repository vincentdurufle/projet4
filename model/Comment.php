<?php

class Comment
{
    private $chapter_id;
    private $name;
    private $content;

    public function __construct($data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }

    public function setChapter_Id($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }


    public function setname($name)
    {

        $this->name = $name;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function chapter_id()
    {
        return $this->chapter_id;
    }

    public function name()
    {
        return $this->name;
    }
    public function content()
    {
        return $this->content;
    }
}
