<?php

namespace Aivec\Plugins\EnvironmentSwitcher;

/**
 * Utility methods
 */
class Utils
{
    const OPTION_KEY = 'avc_environment';
    const ENV_KEY = 'AVC_NODE_ENV';
    const ENVS = ['development', 'staging', 'production'];

    /**
     * Returns current environment setting
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return string
     */
    public static function getEnv() {
        $opts = get_option(self::OPTION_KEY, []);
        if (!empty($opts) && !empty($opts['env']) && in_array($opts['env'], self::ENVS, true)) {
            return $opts['env'];
        }

        if (isset($_ENV[self::ENV_KEY]) && in_array($_ENV[self::ENV_KEY], self::ENVS, true)) {
            return $_ENV[self::ENV_KEY];
        }

        return 'production';
    }
}
