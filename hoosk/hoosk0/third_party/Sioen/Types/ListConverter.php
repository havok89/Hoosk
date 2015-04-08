<?php


class ListConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        $markdown = $this->htmlToMarkdown($node->ownerDocument->saveXML($node));

        // we need a space in the beginning of each line
        $markdown = ' ' . str_replace("\n", "\n ", $markdown);

        return array(
            'type' => 'list',
            'data' => array(
                'text' => $markdown,
            )
        );
    }
}
