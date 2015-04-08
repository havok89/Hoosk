<?php


class ButtonConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        return array(
            'type' => 'image',
            'data' => array(
                'file' => array(
                    'url' => $node->getAttribute('src')
                )
            )
        );
    }

    public function toHtml(array $data)
    {
		// echo "<pre>";
      // print_r($data);
       //die();
        return '<a href="' . $data['url'] . '" class="' . $data['style'] . ' ' . $data['size'] . '">' . $data['html'] . '</a>' . "\n";
    }
}
