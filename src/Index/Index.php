<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Index;

use Illuminate\Support\Str;
use Imdhemy\EsSugar\Attributes\IndexMappings;
use Imdhemy\EsSugar\Attributes\IndexName;
use Imdhemy\EsSugar\Attributes\IndexSettings;
use ReflectionClass;

/**
 * Elasticsearch base index class
 *
 * @property string $index;
 */
abstract class Index implements EsIndex
{
    /**
     * @var string|null
     */
    protected ?string $index = null;

    /**
     * @var IndexSettings|null
     */
    protected ?IndexSettings $settings = null;

    /**
     * @var ReflectionClass|null
     */
    private ?ReflectionClass $reflection = null;

    /**
     * Gets the index name
     *
     * @return string
     */
    public function getName(): string
    {
        if (null !== $this->index) {
            return $this->index;
        }

        $attributes = $this->getReflection()->getAttributes(IndexName::class);

        if (isset($attributes[0])) {
            $this->index = $attributes[0]->newInstance()->name;
        }

        return $this->index ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * Gets index settings
     *
     * @return IndexSettings
     */
    public function getSettings(): IndexSettings
    {
        if (null !== $this->settings) {
            return $this->settings;
        }

        $attributes = $this->getReflection()->getAttributes(IndexSettings::class);

        if (isset($attributes[0])) {
            $this->settings = $attributes[0]->newInstance();
        }

        return $this->settings ?? new IndexSettings();
    }

    /**
     * Gets index mappings
     *
     * @return IndexMappings
     */
    public function getMappings(): IndexMappings
    {
        return new IndexMappings();
    }

    /**
     * @param string|null $index
     *
     * @return Index
     */
    public function setIndex(?string $index): self
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Sets index settings
     *
     * @param IndexSettings|array $settings
     *
     * @return $this
     */
    public function setSettings(IndexSettings|array $settings): self
    {
        $settings = is_array($settings) ? new IndexSettings($settings) : $settings;
        $this->settings = $settings;

        return $this;
    }

    /**
     * Gets the reflection class
     *
     * @return ReflectionClass
     */
    private function getReflection(): ReflectionClass
    {
        if (null === $this->reflection) {
            $this->reflection = new ReflectionClass($this);
        }

        return $this->reflection;
    }
}
