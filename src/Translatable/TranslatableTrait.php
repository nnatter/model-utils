<?php

declare(strict_types=1);

namespace HandcraftedInTheAlps\Util\Model\Translatable;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sulu\Bundle\DirectoryBundle\Common\Translatable\Exception\LocaleNotSetException;
use Sulu\Bundle\DirectoryBundle\Common\Translatable\Exception\TranslationNotFoundException;

trait TranslatableTrait
{
    /**
     * @var Collection<TranslationInterface>
     */
    protected $translations;

    /**
     * @var ?string
     */
    protected $currentLocale;

    /**
     * @param TranslationInterface[] $translations
     */
    public function initializeTranslatableTrait(array $translations): void
    {
        $this->translations = new ArrayCollection();

        foreach ($translations as $translation) {
            $this->addTranslation($translation);
        }
    }

    public function setCurrentLocale(?string $currentLocale): void
    {
        $this->currentLocale = $currentLocale;
    }

    public function getCurrentLocale(): ?string
    {
        return $this->currentLocale;
    }

    protected function getInternalTranslation(
        ?string $locale = null,
        bool $createIfNotExist = false
    ): TranslationInterface {
        $locale = $locale ?: $this->currentLocale;
        if (!$locale) {
            throw new LocaleNotSetException();
        }

        if ($this->hasTranslation($locale)) {
            return $this->translations->get($locale);
        }

        if ($createIfNotExist) {
            $translation = $this->createTranslation($locale);
            $this->addTranslation($translation);

            return $translation;
        }

        throw new TranslationNotFoundException();
    }

    protected function hasTranslation(?string $locale = null): bool
    {
        $locale = $locale ?: $this->currentLocale;
        if (!$locale) {
            throw new LocaleNotSetException();
        }

        return $this->translations->containsKey($locale);
    }

    protected function addTranslation(TranslationInterface $translation): void
    {
        $this->translations->set($translation->getLocale(), $translation);
    }

    abstract protected function createTranslation(string $locale): TranslationInterface;
}
