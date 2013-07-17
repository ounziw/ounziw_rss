<?php
/**
 * Rss for NOVIUS OS
 *
 * @copyright  2013 Fumito MIZUNO
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://ounziw.com
 */

namespace OunziwRss;

class Controller_Admin_Enhancer extends \Nos\Controller_Admin_Enhancer
{

    public function action_save(array $args = null)
    {
        if (empty($args)) {
            $args = $_POST;
        }
        $args['rssurl'] = filter_var($args['rssurl'], FILTER_VALIDATE_URL);
        $args['num_of_posts'] = filter_var($args['num_of_posts'], FILTER_VALIDATE_INT);

        parent::action_save($args);
    }
}
