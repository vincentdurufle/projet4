<?php


/**
 * Sets a chapter entity to be loaded in Manager
 */

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
   * @param int $id
   * @return void
   */
    public function setId($id)
    {
        $this->id = (int) $id;
    }


    /**
   *
   * @param string $title
   * @return void
   */
    public function setTitle($title)
    {

        $this->title = $title;
    }

    /**
   *
   * @param string $content
   * @return void
   */

    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
   *
   * @param string $date_creation
   * @return void
   */
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
