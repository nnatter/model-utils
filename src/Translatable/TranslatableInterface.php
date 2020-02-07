<?php

declare(strict_types=1);

namespace HandcraftedInTheAlps\Util\Model\Translatable;

interface TranslatableInterface
{
    public function setCurrentLocale(string $currentLocale): void;

    public function getCurrentLocale(): ?string;
}
