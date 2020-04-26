<?php

namespace App\Model;


class Tag
{
    public const TYPE_EVENT = 'TRACK_EVENT';

    /** @var string */
    public $note;
    /** @var string */
    public $type;
    /** @var string */
    public $originalName;

    /** @var string */
    public $name;
    /** @var string */
    public $description;

    /** @var string */
    public $eventCategory;
    /** @var string */
    public $eventAction;
    /** @var string */
    public $eventLabel;

    public function __construct(\Google_Service_TagManager_Tag $tagData)
    {
        $this->originalName = $tagData->getName();
        $this->note = $tagData->getNotes();
        $this->name = $this->generateName();
        $this->description = $this->generateDescription();

        foreach ($tagData->getParameter() as $parameter) {
            /** @var \Google_Service_TagManager_Parameter $parameter */
            switch ($parameter->getKey()) {
                case 'trackType':
                    $this->type = $parameter->getValue();
                    break;
                case 'eventCategory':
                    $this->eventCategory = $parameter->getValue();
                    break;
                case 'eventAction':
                    $this->eventAction = $parameter->getValue();
                    break;
                case 'eventLabel':
                    $this->eventLabel = $parameter->getValue();
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * @return string
     */
    public function generateName()
    {
        if (!$this->note) {
            return $this->originalName;
        }

        $noteParts = explode("\n", $this->note);
        if (count($noteParts) < 2) {
            return $this->originalName;
        }

        if (!$noteParts[0]) {
            return $this->originalName;
        }

        return $noteParts[0];
    }

    /**
     * @return string
     */
    public function generateDescription()
    {
        if (!$this->note) {
            return '';
        }

        $noteParts = explode("\n", $this->note);
        if (count($noteParts) < 2) {
            $note = $this->note;
        } else {
            // Remove title
            unset($noteParts[0]);

            $note = implode("\n", $noteParts);
        }

        $note = trim($note);
        $note = nl2br($note);

        return $note;
    }
}
