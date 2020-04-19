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
    public $eventCategory;
    /** @var string */
    public $eventAction;
    /** @var string */
    public $eventLabel;

    public function __construct(\Google_Service_TagManager_Tag $tagData)
    {
        $this->originalName = $tagData->getName();
        $this->note = $tagData->getNotes();

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
    public function getName()
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
    public function getDescription()
    {
        if (!$this->note) {
            return '';
        }

        $noteParts = explode("\n", $this->note);
        if (count($noteParts) < 2) {
            return $this->note;
        }

        // Remove title
        unset($noteParts[0]);

        return implode("\n", $noteParts);
    }
}
