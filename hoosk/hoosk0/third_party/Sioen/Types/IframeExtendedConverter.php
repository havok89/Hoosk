<?php


class IframeExtendedConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

     
    }

    public function toHtml(array $data)
    {
			$height = $data['height'] * 1.3;
			if ($data['width'] > $height){
			$size = "embed-responsive-16by9";	
			} else {
			$size = "embed-responsive-4by3";	
			}
            $html = '<div class="embed-responsive '.$size.'"><iframe src="'.$data['src'].'" width="'.$data['width'].'" height="'.$data['height'].'" frameborder="0"></iframe></div>' . "\n";

            return $html;
	}
}
