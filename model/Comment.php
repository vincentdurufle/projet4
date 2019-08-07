<?php

/**
 * sets a Comment entity to be after loaded in manager
 * @param int
 * @param string
 * @return object
 */

class Comment
{
    private $chapter_id;
    private $name;
    private $content;
    private $img;

    public function __construct($data = [])
    {
        $this->hydrate($data);
    }
    /**
     * loop through all setters
     *
     * @param string 
     * @param int
     * @return void
     */

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
    /**
     * sets id
     *
     * @param int $chapter_id
     * @return void
     */
    public function setChapter_Id($chapter_id)
    {
        $this->chapter_id = $chapter_id;
    }
    /**
     *
     * @param string $name
     * @return void
     */
    public function setname($name)
    {

        $this->name = $name;
    }

    /**
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param string $img
     * @return void
     */
    public function setImg($img)
    {
        $this->img = $img;
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
    public function img()
    {
        return $this->img;
    }
}
