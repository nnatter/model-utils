<?php

declare(strict_types=1);

namespace HandcraftedInTheAlps\Util\Model\Translatable;

trait TranslationTrait
{
    /**
     * @var string
     */
    protected $locale;

    public function initializeTranslationTrait(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }
}
