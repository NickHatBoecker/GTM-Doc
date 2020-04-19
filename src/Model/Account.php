<?php

namespace App\Model;


class Account
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $containers;

    /** @var bool */
    public $selected;

    /**
     * Account constructor.
     *
     * @param string $id
     * @param string $name
     * @param array $containers
     */
    public function __construct(string $id, string $name, bool $selected, array $containers = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->containers = $containers;
        $this->selected = $selected;
    }
}
