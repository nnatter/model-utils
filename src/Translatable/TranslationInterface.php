<?php

declare(strict_types=1);

namespace HandcraftedInTheAlps\Util\Model\Translatable;

interface TranslationInterface
{
    public function getLocale(): string;
}
