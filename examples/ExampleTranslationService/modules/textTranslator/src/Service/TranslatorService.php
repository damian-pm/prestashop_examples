<?php

namespace Modules\textTranslator\Service;

use Symfony\Component\Translation\TranslatorInterface;

class TranslatorService {
    /** @var TranslatorInterface */
    private $translator;

    /**
     * @param string $customMessage
     */
    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * @return string
     */
    public function getTranslate($customMessage) {
        return $this->translator->trans(
            $customMessage,
            array(),
            'Admin.Text'
        );
    }
}