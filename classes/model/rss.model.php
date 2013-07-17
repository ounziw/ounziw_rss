<?php
namespace OunziwRss;




class Model_Rss extends \Fuel\Core\Model {

    protected static $rssdata;
    protected static $rssversion;


    protected static function get_rss_from_url($rssurl) {
        if (filter_var($rssurl, FILTER_VALIDATE_URL)) {
            static::$rssdata = simplexml_load_file($rssurl, null, LIBXML_NOCDATA);
        } else {
            throw Exception('invalid URL');
        }
    }

    protected static function get_rssversion() {
        if (static::$rssdata->channel->item[0]) {
            static::$rssversion = 2;
        } else if ($this->rssdata->item[0]) {
            static::$rssversion = 1;
        } else {
            throw Exception('invalid RSS');
        }
    }

    static function find($enhancer_args) {
        static::get_rss_from_url($enhancer_args['rssurl']);
        static::get_rssversion();

        if (static::$rssversion == 2) {
            $rssitem = static::$rssdata->channel;
        } else {
            $rssitem = static::$rssdata;
        }
        $config = \Config::load('ounziw_rss::model/front', true);

        $outdata = array();
        $number = min($enhancer_args['num_of_posts'], $rssitem->item->count());
        for ($i=0; $i<$number; $i++){
            $link = filter_var($rssitem->item[$i]->link, FILTER_VALIDATE_URL);
            $title = $rssitem->item[$i]->title;
            $excerpt = mb_strimwidth($rssitem->item[$i]->description,0,$config['excerpt_width'],$config['end_excerpt'],\Fuel::$encoding);

            if (static::$rssversion === 2) {
                $date_input = $rssitem->item[$i]->pubDate;
                $dateclass = \DateTime::createFromFormat(\DateTime::RSS, $date_input);
            } else {
                $date_input = $rssitem->item[$i]->children('http://purl.org/dc/elements/1.1/')->date;
                $dateclass = \DateTime::createFromFormat(\DateTime::W3C, $date_input);
            }    
            $datedata = $dateclass->format($config['date_format']);

            if ($link) {
                $outdata[] = array(
                    'link'    => $link,
                    'title'   => $title,
                    'excerpt' => $excerpt,
                    'date'    => $datedata,
                );
            }
        }
        return $outdata;
    }

}
