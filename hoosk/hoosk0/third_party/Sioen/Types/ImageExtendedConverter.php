<?php

class ImageExtendedConverter implements ConverterInterface
{
    /**
     * The options we use for html to markdown
     *
     * @var array
     */

    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        return array(
            'type' => 'text',
            'data' => array( 
                'text' => ' ' . $this->htmlToMarkdown($html)
            )
        );
    }

    public function toHtml(array $data)
    {
		if (($data['source'] == "") || ($data['source'] == "http://")){
        return '<img class="img-responsive" src="' . $data['file']['url'] . '" alt="' . $data['caption'] . '" />' . "\n";
		} else {
        return '<a href="' . $data['source'] . '" target="_blank"><img class="img-responsive" src="' . $data['file']['url'] . '" alt="' . $data['caption'] . '" /></a>' . "\n";
		}
    }
}
