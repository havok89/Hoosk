<?php


/**
 * Class Converter
 *
 * A Sir Trevor to HTML conversion helper for PHP
 *
 * @version 1.1.0
 * @author Wouter Sioen <wouter@woutersioen.be>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class Converter
{
    /**
     * Converts the outputted json from Sir Trevor to html
     *
     * @param  string $json
     * @return string
     */
    public function toHtml($json)
    {
        // convert the json to an associative array
        $input = json_decode($json, true);
        $html = '';

        // loop trough the data blocks
        foreach ($input['data'] as $block) {
            $toHtmlContext = new ToHtmlContext($block['type']);
            $html .= $toHtmlContext->getHtml($block['data']);
        }

        return $html;
    }

    /**
     * Converts html to the json Sir Trevor requires
     *
     * @param  string $html
     * @return string The json string
     */
    public function toJson($html)
    {
        // Strip white space between tags to prevent creation of empty #text nodes
        $html = preg_replace('~>\s+<~', '><', $html);
        $document = new \DOMDocument();

        // Load UTF-8 HTML hack (from http://bit.ly/pVDyCt)
        $document->loadHTML('<?xml encoding="UTF-8">' . $html);
        $document->encoding = 'UTF-8';

        // fetch the body of the document. All html is stored in there
        $body = $document->getElementsByTagName("body")->item(0);

        $data = array();

        // loop trough the child nodes and convert them
        if ($body) {
            foreach ($body->childNodes as $node) {
                $toJsonContext = new ToJsonContext($node->nodeName);
                $data[] = $toJsonContext->getData($node);
            }
        }

        return json_encode(array('data' => $data));
    }
}
