<?php



interface ConverterInterface
{
    public function toJson(\DOMElement $node);
    public function toHtml(array $data);
}
