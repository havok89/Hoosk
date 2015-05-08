<?php


class IframeConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        // youtube or vimeo
        if (preg_match('~//www.youtube.com/embed/([^/\?]+).*\"~si', $html, $matches)) {
            return array(
                'type' => 'video',
                'data' => array(
                    'source' => 'youtube',
                    'remote_id' => $matches[1]
                )
            );
        } elseif (preg_match('~//player.vimeo.com/video/([^/\?]+).*\?~si', $html, $matches)) {
            return array(
                'type' => 'video',
                'data' => array(
                    'source' => 'vimeo',
                    'remote_id' => $matches[1]
                )
            );
        }
    }

    public function toHtml(array $data)
    {
		
        // youtube video's
        $source = $data['source'];
        $remoteId = $data['remote_id'];
	
        if ($source == 'youtube') {
            $html = '<div class="embed-responsive embed-responsive-16by9"><iframe src="//www.youtube.com/embed/' . $remoteId . '?rel=0" ';
            $html .= 'frameborder="0" allowfullscreen></iframe></div>' . "\n";

            return $html;
        }

        // vimeo videos
        if ($source == 'vimeo') {
            $html = '<div class="embed-responsive embed-responsive-16by9"><iframe src="//player.vimeo.com/video/' . $remoteId;
            $html .= '?title=0&amp;byline=0" frameborder="0"></iframe></div>' . "\n";

            return $html;
        }
		//dailymotion
		 if ($source == 'dailymotion') {
            $html = '<div class="embed-responsive embed-responsive-16by9"><iframe src="//www.dailymotion.com/embed/video/' . $remoteId . '" ';
            $html .= 'frameborder="0" allowfullscreen></iframe></div>' . "\n";

            return $html;
        }

        // vine
        if ($source == 'vine') {
            $html = '<div class="embed-responsive embed-responsive-16by9"><iframe src="/vine.co/v/' . $remoteId;
            $html .= '/embed/simple" frameborder="0"></iframe><script async src="http://platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>' . "\n";

            return $html;
        }
        // fallback
        return '';
    }
}
