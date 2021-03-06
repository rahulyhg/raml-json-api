<?php

namespace rjapi\helpers;


use rjapi\types\ConfigInterface;
use rjapi\types\ModelsInterface;
use rjapi\types\ModulesInterface;
use rjapi\types\PhpInterface;

class ConfigHelper
{
    private static $availableQueryParams = [
        ModelsInterface::PARAM_PAGE => ModelsInterface::DEFAULT_PAGE,
        ModelsInterface::PARAM_LIMIT => ModelsInterface::DEFAULT_LIMIT,
        ModelsInterface::PARAM_SORT => ModelsInterface::DEFAULT_SORT,
    ];

    public static function getConfigKey(): string
    {
        $conf = config();
        $arr = $conf[ModulesInterface::KEY_MODULE][ModulesInterface::KEY_MODULES];

        return end($arr);
    }

    public static function getModuleName(): string
    {
        return config(self::getConfigKey() . PhpInterface::DOT . ModulesInterface::KEY_NAME);
    }

    public static function getQueryParam(string $param)
    {
        if (array_key_exists($param, self::$availableQueryParams)) {
            $params = config(self::getConfigKey() . PhpInterface::DOT . ConfigInterface::QUERY_PARAMS);

            return empty($params[$param]) ? self::$availableQueryParams[$param] : $params[$param];
        }

        return null;
    }

    public static function getNestedParam(string $entity, string $param, bool $lower = false)
    {
        if (true === $lower) {
            $param = strtolower($param);
        }
        $params = config(self::getConfigKey() . PhpInterface::DOT . $entity);

        return empty($params[$param]) ? null : $params[$param];
    }
}