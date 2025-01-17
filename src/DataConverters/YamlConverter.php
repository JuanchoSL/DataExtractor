<?php

declare(strict_types=1);

namespace JuanchoSL\DataTransfer\DataConverters;

use JuanchoSL\Exceptions\PreconditionRequiredException;

class YamlConverter extends ArrayConverter
{

    public function getData(): mixed
    {
        if (!function_exists('yaml_emit')) {
            throw new PreconditionRequiredException("YAML extension is not installed in order to process yaml data");
        }
        return trim(yaml_emit(parent::getData(), YAML_UTF8_ENCODING), "-\r\n.");
    }

    public function __tostring(): string
    {
        return $this->getData();
    }
}