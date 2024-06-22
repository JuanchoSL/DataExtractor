<?php

declare(strict_types=1);

namespace JuanchoSL\DataTransfer\Repositories;
use JuanchoSL\Exceptions\PreconditionRequiredException;

class YamlDataTransfer extends ArrayDataTransfer
{

    public function __construct(string $yaml)
    {
        if(!function_exists('yaml_parse')){
            throw new PreconditionRequiredException("YAML extension is not installed in order to process yaml data");
        }
        if (is_string($yaml)) {
            if (is_file($yaml) && file_exists($yaml)) {
                $yaml = file_get_contents($yaml);
            }
        }
        $ndocs = 0;
        $yml = yaml_parse($yaml, 0, $ndocs/*, array('!date' => 'cb_yaml_date')*/);
        parent::__construct($yml);
    }

    protected function cb_yaml_date($value, $tag, $flags)
    {
        return new \DateTime($value);
    }
}