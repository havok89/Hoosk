<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * This class is written based entirely on the work found below
 * www.techbytes.co.in/blogs/2006/01/15/consuming-rss-with-php-the-simple-way/
 * All credit should be given to the original author
 *
 * Example:

$this->load->library('rssparser');
$this->rssparser->set_feed_url('http://example.com/feed');
$this->rssparser->set_cache_life(30);
$rss = $this->rssparser->getFeed(6);  // Get six items from the feed

// Using a callback function to parse addictional XML fields

$this->load->library('rssparser', array($this, 'parseFile')); // parseFile method of current class

function parseFile($data, $item)
{
$data['summary'] = (string)$item->summary;
return $data;
}
 */

class RSSParser
{
    public $feed_uri         = null; // Feed URI
    public $data             = false; // Associative array containing all the feed items
    public $channel_data     = array(); // Store RSS Channel Data in an array
    public $feed_unavailable = null; // Boolean variable which indicates whether an RSS feed was unavailable
    public $cache_life       = 0; // Cache lifetime
    public $cache_dir        = './hoosk/hoosk0/cache/'; // Cache directory
    public $write_cache_flag = false; // Flag to write to cache
    public $callback         = false; // Callback to read custom data

    public function __construct($callback = false)
    {
        if ($callback) {
            $this->callback = $callback;
        }
    }

    // --------------------------------------------------------------------
    public function get_http_response_code($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }

    public function parse()
    {
        // Are we caching?
        if ($this->cache_life != 0) {
            $filename = $this->cache_dir . 'rss_Parse_' . md5($this->feed_uri);

            // Is there a cache file ?
            if (file_exists($filename)) {
                // Has it expired?
                $timedif = (time() - filemtime($filename));

                if ($timedif < ($this->cache_life * 60)) {
                    $rawFeed = file_get_contents($filename);
                } else {
                    // So raise the falg
                    $this->write_cache_flag = true;
                }
            } else {
                // Raise the flag to write the cache
                $this->write_cache_flag = true;
            }
        }

        // Reset
        $this->data         = array();
        $this->channel_data = array();

        // Parse the document
        if (!isset($rawFeed)) {
            if ($this->get_http_response_code($this->feed_uri) != "200") {
                return false;
            } else {
                $rawFeed = file_get_contents($this->feed_uri);
            }
        }

        $xml = new SimpleXmlElement($rawFeed, 0, false);

        if ($xml->channel) {
            // Assign the channel data
            $this->channel_data['title']       = $xml->channel->title;
            $this->channel_data['description'] = $xml->channel->description;

            // Build the item array
            foreach ($xml->channel->item as $item) {
                $data                = array();
                $data['title']       = (string) $item->title;
                $data['description'] = (string) $item->description;
                $data['pubDate']     = (string) $item->pubDate;
                $data['link']        = (string) $item->link;
                $dc                  = $item->children('http://purl.org/dc/elements/1.1/');
                $data['author']      = (string) $dc->creator;

                if ($this->callback) {
                    $data = call_user_func($this->callback, $data, $item);
                }

                $this->data[] = $data;
            }
        } else {
            // Assign the channel data
            $this->channel_data['title']       = $xml->title;
            $this->channel_data['description'] = $xml->subtitle;

            // Build the item array
            foreach ($xml->entry as $item) {
                $data                = array();
                $data['id']          = (string) $item->id;
                $data['title']       = (string) $item->title;
                $data['description'] = (string) $item->content;
                $data['pubDate']     = (string) $item->published;
                $data['link']        = (string) $item->link['href'];
                $dc                  = $item->children('http://purl.org/dc/elements/1.1/');
                $data['author']      = (string) $dc->creator;

                if ($this->callback) {
                    $data = call_user_func($this->callback, $data, $item);
                }

                $this->data[] = $data;
            }
        }

        // Do we need to write the cache file?
        if ($this->write_cache_flag) {
            if (!$fp = @fopen($filename, 'wb')) {
                echo "RSSParser error";
                log_message('error', "Unable to write cache file: " . $filename);
                return;
            }

            flock($fp, LOCK_EX);
            fwrite($fp, $rawFeed);
            flock($fp, LOCK_UN);
            fclose($fp);
        }

        return true;
    }

    // --------------------------------------------------------------------

    public function set_cache_life($period = null)
    {
        $this->cache_life = $period;
        return $this;
    }

    // --------------------------------------------------------------------

    public function set_feed_url($url = null)
    {
        $this->feed_uri = $url;
        return $this;
    }

    // --------------------------------------------------------------------

    /* Return the feeds one at a time: when there are no more feeds return false
     * @param No of items to return from the feed
     * @return Associative array of items
     */
    public function getFeed($num)
    {
        $this->parse();

        $c      = 0;
        $return = array();

        foreach ($this->data as $item) {
            $return[] = $item;
            $c++;

            if ($c == $num) {
                break;
            }
        }
        return $return;
    }

    // --------------------------------------------------------------------

    /* Return channel data for the feed */
    public function &getChannelData()
    {
        $flag = false;

        if (!empty($this->channel_data)) {
            return $this->channel_data;
        } else {
            return $flag;
        }
    }

    // --------------------------------------------------------------------

    /* Were we unable to retreive the feeds ?  */
    public function errorInResponse()
    {
        return $this->feed_unavailable;
    }

    // --------------------------------------------------------------------

    /* Initialize the feed data */
    public function clear()
    {
        $this->feed_uri     = null;
        $this->data         = false;
        $this->channel_data = array();
        $this->cache_life   = 0;
        $this->callback     = false;

        return $this;
    }
}

/* End of file RSSParser.php */
/* Location: ./application/libraries/RSSParser.php */
