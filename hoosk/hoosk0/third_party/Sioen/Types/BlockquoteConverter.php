<?php



class BlockquoteConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        // check if the quote contains a cite
        $cite = '';

        foreach ($node->childNodes as $child) {
            // if it contains a 'cite' node, we should add it in the cite property
            if ($child->nodeName == 'cite') {
                $html = $child->ownerDocument->saveXML($child);
                $html = preg_replace('/<(\/|)cite>/i', '', $html);
                $child->parentNode->removeChild($child);
                $cite = ' ' . $this->htmlToMarkdown($html);
            }
        }

        // we use the remaining html to create the remaining text
        $html = $node->ownerDocument->saveXML($node);
        $html = preg_replace('/<(\/|)blockquote>/i', '', $html);

        return array(
            'type' => 'quote',
            'data' => array(
                'text' => ' ' . $this->htmlToMarkdown($html),
                'cite' => $cite
            )
        );
    }

    public function toHtml(array $data)
    {
        $text = $data['text'];
        $html = '<blockquote>';
        $html .= Markdown::defaultTransform($text);

        // Add the cite if necessary
        if (isset($data['cite']) && !empty($data['cite'])) {
            // remove the indent thats added by Sir Trevor
            $cite = ltrim($data['cite'], '>');
            $html .= '<cite>' . Markdown::defaultTransform($cite) . '</cite>';
        }

        $html .= '</blockquote>';

        return $html;
    }
}
