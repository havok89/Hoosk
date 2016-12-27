<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

/**
 * Feed generator class for ci-feed library.
 *
 * @author Roumen Damianoff <roumen@dawebs.com>
 * @version 1.3.3
 * @link http://roumen.it/projects/ci-feed
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */

class Feed
{

    protected $items = array();
    public $title = 'My feed title';
    public $description = 'My feed description';
    public $link;
    public $logo;
    public $icon;
    public $pubdate;
    public $lang;
    public $charset = 'utf-8';
    public $ctype = null;
    protected $shortening = false;
    protected $shorteningLimit = 150;
    protected $dateFormat = 'datetime';
    protected $namespaces = array();
    protected $customView = null;


    /**
     * Add new item to $items array
     *
     * @param string $title
     * @param string $author
     * @param string $link
     * @param string $pubdate
     * @param string $description
     * @param string $content
     * @param array $enclosure (optional)
     *
     * @return void
     */
    public function add($title, $link, $pubdate, $description, $content='', $enclosure = array())
    {

        if ($this->shortening)
        {
            $description = mb_substr($description, 0, $this->shorteningLimit, 'UTF-8');
        }

        $this->items[] = array(
            'title' => $title,
            'link' => $link,
            'pubdate' => $pubdate,
            'description' => $description,
            'content' => $content,
            'enclosure' => $enclosure
        );
    }


    /**
     * Add new item to $items array
     *
     * @param array $a
     *
     * @return void
     */
    public function addArray(array $a)
    {

        if ($this->shortening)
        {
            $a['description'] = mb_substr($a['description'], 0, $this->shorteningLimit, 'UTF-8');
        }

        $this->items[] = $a;
    }


    /**
     * Returns aggregated feed with all items from $items array
     *
     * @param string $format (options: 'atom', 'rss')
     * @param carbon|datetime|integer $cache (0 - turns off the cache)
     * @param string $key
     *
     * @return view
     */
    public function render($format = null, $cache = null, $key = null)
    {

        $CI =& get_instance();

        if ($format == null && $this->customView == null) $format = "atom";
        if ($this->customView == null) $this->customView = $format;
        if ($cache != null) $this->caching = $cache;
        if ($key != null) $this->cacheKey = $key;

        if ($this->ctype == null)
        {
            ($format == 'rss') ? $this->ctype = 'application/rss+xml' : $this->ctype = 'application/atom+xml';
        }

        if (empty($this->lang)) $this->lang = $CI->config->item('language');
        if (empty($this->link)) $this->link = $CI->config->item('base_url');
        if (empty($this->pubdate)) $this->pubdate = date('D, d M Y H:i:s O');

        foreach($this->items as $k => $v)
        {
            $this->items[$k]['title'] = html_entity_decode(strip_tags($this->items[$k]['title']));
            $this->items[$k]['pubdate'] = $this->formatDate($this->items[$k]['pubdate'], $format);
        }

        $channel = array(
            'title'=>html_entity_decode(strip_tags($this->title)),
            'description'=>$this->description,
            'logo' => $this->logo,
            'icon' => $this->icon,
            'link'=>$this->link,
            'pubdate'=>$this->formatDate($this->pubdate, $format),
            'lang'=>$this->lang
        );

        $viewData = array(
            'items'         => $this->items,
            'channel'       => $channel,
            'namespaces'    => $this->getNamespaces(),
            'ctype'         => $this->ctype,
            'charset'       => $this->charset
        );

        $CI->load->view('feed/'.$this->customView, $viewData);

     }


    /**
      * Create link
      *
      * @param string $url
      * @param string $format
      *
      * @return string
      */
     public function link($url, $format='atom')
     {

        if ($this->ctype == null)
        {
            ($format == 'rss') ? $type = 'application/rss+xml' : $type = 'application/atom+xml';
        }
        else
        {
            $type = $this->ctype;
        }

        return '<link rel="alternate" type="'.$type.'" href="'.$url.'" />';
     }


    /**
     * Set Custom view if you don't like the ones that come built in with the package
     *
     * @param string $name
     *
     * @return void
     */
    public function setView($name=null)
    {
        $this->customView = $name;
    }


    /**
     * Set maximum characters lenght for text shortening
     *
     * @param integer $l
     *
     * @return void
     */
    public function setTextLimit($l=150)
    {
        $this->shorteningLimit = $l;
    }


    /**
     * Turn on/off text shortening for item content
     *
     * @param boolean $b
     *
     * @return void
     */
    public function setShortening($b=false)
    {
        $this->shortening = $b;
    }


    /**
     * Format datetime string, timestamp integer or carbon object in valid feed format
     *
     * @param string/integer $date
     *
     * @return string
     */
    protected function formatDate($date, $format="atom")
    {
        if ($format == "atom")
        {
            switch ($this->dateFormat)
            {
                case "carbon":
                    $date = date('c', strtotime($date->toDateTimeString()));
                    break;
                case "timestamp":
                    $date = date('c', $date);
                    break;
                case "datetime":
                    $date = date('c', strtotime($date));
                    break;
            }
        }
        else
        {
            switch ($this->dateFormat)
            {
                case "carbon":
                    $date = date('D, d M Y H:i:s O', strtotime($date->toDateTimeString()));
                    break;
                case "timestamp":
                    $date = date('D, d M Y H:i:s O', $date);
                    break;
                case "datetime":
                    $date = date('D, d M Y H:i:s O', strtotime($date));
                    break;
            }
        }


        return $date;
    }


    /**
     * Add namespace
     *
     * @param string $n
     *
     * @return void
     */
    public function addNamespace($n)
    {
        $this->namespaces[] = $n;
    }


    /**
     * Get all namespaces
     *
     * @param string $n
     *
     * @return void
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }


    /**
     * Setter for dateFormat
     *
     * @param string $format
     *
     * @return void
     */
    public function setDateFormat($format="datetime")
    {
        $this->dateFormat = $format;
    }


}