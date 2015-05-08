<?php


class AccordionConverter extends BaseConverter implements ConverterInterface
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
		
	   $html = "<div id='accordion' class='panel-group'>";
	   $i = 0;
       foreach ($data['panels'] as $panel) {
            $html .= "<div class='panel panel-default'><div class='panel-heading'>";
            $html .= "<h4 class='panel-title'><a data-toggle='collapse' data-parent='#accordion' href='#collapse".$i."'>".$panel['title']."</a></h4></div>";
            $html .= "<div id='collapse".$i."' class='panel-collapse collapse ";
			if ($i == 0){  $html .= "in"; } else { $html .= "out"; }
			$html .= "' role='tabpanel'><div class='panel-body'><p>".$panel['body']."</p></div>";
            $html .= "</div></div>";
			$i++;
        }
        $html .= "</div>";
        return $html;
    
    }
}
