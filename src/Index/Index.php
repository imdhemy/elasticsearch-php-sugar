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
 */
abstract class Index implements EsIndex
{
    /**
     * Index name
     *
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Index settings
     *
     * @var IndexSettings|null
     */
    protected ?IndexSettings $settings = null;

    /**
     * Index mappings
     *
     * @var IndexMappings|null
     */
    protected ?IndexMappings $mappings = null;

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
        if (null !== $this->name) {
            return $this->name;
        }

        $attributes = $this->getReflection()->getAttributes(IndexName::class);

        if (isset($attributes[0])) {
            $this->name = $attributes[0]->newInstance()->name;
        }

        return $this->name ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * @param string|null $name
     *
     * @return Index
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

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
     * Gets index mappings
     *
     * @return IndexMappings
     */
    public function getMappings(): IndexMappings
    {
        if (null !== $this->mappings) {
            return $this->mappings;
        }

        $attributes = $this->getReflection()->getAttributes(IndexMappings::class);

        if (isset($attributes[0])) {
            $this->mappings = $attributes[0]->newInstance();
        }

        return $this->mappings ?? new IndexMappings();
    }

    /**
     * Sets index mappings
     *
     * @param IndexMappings|array $mappings
     *
     * @return $this
     */
    public function setMappings(IndexMappings|array $mappings): self
    {
        $mappings = is_array($mappings) ? new IndexMappings($mappings) : $mappings;
        $this->mappings = $mappings;

        return $this;
    }
}
