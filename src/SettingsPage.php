<?php

namespace Aivec\Plugins\EnvironmentSwitcher;

/**
 * Settings page
 */
class SettingsPage
{
    const PAGE = 'avc_environment_switcher';

    /**
     * Registers hooks
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return void
     */
    public static function init() {
        add_action('admin_menu', [get_class(), 'registerSettingsPage']);
        add_action('admin_init', [get_class(), 'registerSetting']);
    }

    /**
     * Registers `avc_environment` option name
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return void
     */
    public static function registerSetting() {
        register_setting(self::PAGE, Options::KEY);
    }

    /**
     * Adds settings page
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return void
     */
    public static function registerSettingsPage() {
        add_options_page(
            'Aivec Environment Switcher',
            'Aivec Environment Switcher',
            'manage_options',
            self::PAGE,
            [get_class(), 'addSettingsPage']
        );
    }

    /**
     * Adds `Commercial Plugin/Theme Settings` page
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return void
     */
    public static function addSettingsPage() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        ?>
        <div class="wrap">
            <h1><?php _e('Environment Settings', 'avces'); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields(self::PAGE); ?>
                <table class="form-table" role="presentation">
                    <?php echo self::switchEnvironmentSection(); ?>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Adds radio select for working environment (development, staging, or production)
     *
     * @author Evan D Shaw <evandanielshaw@gmail.com>
     * @return void
     */
    public static function switchEnvironmentSection() {
        $opts = Options::getOptions();
        $envs = [
            'development' => __('Development', 'avces'),
            'staging' => __('Staging', 'avces'),
            'production' => __('Production', 'avces'),
        ];
        ?>
        <tr>
            <th scope="row"><?php _e('Working Environment', 'avces'); ?></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text">
                        <span><?php _e('Maximum Rating'); ?></span>
                    </legend>
                    <?php
                    foreach ($envs as $env => $label) {
                        $selected = $opts['env'] === $env ? 'checked="checked"' : '';
                        echo "\n\t"
                        ?>
                        <label>
                            <input
                                type="radio"
                                name="<?php echo Options::KEY; ?>[env]"
                                value="<?php echo esc_attr($env); ?>"
                                <?php echo $selected; ?>
                            />
                            <?php echo $label; ?>
                        </label>
                        <br />
                        <?php
                    }
                    ?>
                </fieldset>
            </td>
        </tr>
        <?php
    }
}
