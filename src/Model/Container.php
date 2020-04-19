<?php

namespace App\Model;


class Container
{
    /** @var string */
    public $id;

    /** @var string  */
    public $name;

    /** @var bool */
    public $selected;

    /**
     * Container constructor.
     *
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name, bool $selected)
    {
        $this->id = $id;
        $this->name = $name;
        $this->selected = $selected;
    }
}
