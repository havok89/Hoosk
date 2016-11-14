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
      if ($data['is_block']==1){
        $block=" btn-block";
      } else {
        $block = "";
      }
      return '<a href="' . $data['url'] . '" class="btn ' . $data['style'] . ' ' . $data['size'] . $block .'">' . $data['html'] . '</a>' . "\n";
    }
}
