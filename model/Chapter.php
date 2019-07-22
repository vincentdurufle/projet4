<?php

class Chapter
{
    private $id;
    private $title;
    private $content;
    private $date_creation;

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

    public function setId($id)
    {
        $this->id = (int) $id;
    }


    public function setTitle($title)
    {

        $this->title = $title;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }
    public function content()
    {
        return $this->content;
    }

    public function date_creation()
    {
        return $this->date_creation;
    }
}