<?php

// modules/yourmodule/src/YourService.php
namespace Modules\Car\Service;

use Symfony\Component\Translation\TranslatorInterface;

class YourService {

    /** @var string */
    private $customMessage;

    /**
     * @param string $customMessage
     */
    public function __construct(
        $customMessage
    ) {
        $this->customMessage = $customMessage;
    }

    /**
     * @return string
     */
    public function getTranslatedCustomMessage() {
        return 'CosTlumaczone';
    }
}