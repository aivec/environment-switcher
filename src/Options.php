<?php

namespace Aivec\Plugins\EnvironmentSwitcher;

/**
 * Options read/write methods
 */
class Options
{
    const KEY = 'avc_environment';

    /**
     * Get normalized options array
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return array
     */
    public static function getOptions() {
        $opts = get_option(self::KEY, []);
        $opts['env'] = isset($opts['env']) ? $opts['env'] : 'production';

        return $opts;
    }
}
