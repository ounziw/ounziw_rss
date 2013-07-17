<?php
/**
 * Rss for NOVIUS OS
 *
 * @copyright  2013 Fumito MIZUNO
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://ounziw.com
 */

return array(
    'name'    => __('Display RSS'),
    'version' => '0.1',
    'provider' => array(
        'name' => 'Fumito MIZUNO',
    ),
    'namespace' => "OunziwRss",
    'permission' => array(
        ),
        'icons' => array(
            64 => 'static/apps/ounziw_rss/img/64/icon.png',
            32 => 'static/apps/ounziw_rss/img/32/icon.png',
            16 => 'static/apps/ounziw_rss/img/16/icon.png',
        ),
        // Enhancer configuration sample
        'enhancers' => array(
            'Rss' => array( // key must be defined
                'title' => __('Display RSS'),
                'desc'  => '',
                'enhancer' => 'ounziw_rss/front/main',
                'dialog' => array(
                    'contentUrl' => 'admin/ounziw_rss/enhancer/popup',
                    'width' => 600,
                    'height' => 600,
                    'ajax' => true,
                ),
            ),
        ),
    );
