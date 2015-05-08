<?php

class ToHtmlContext {

    protected $converter = null;

    public function __construct($type) {
        switch ($type) {
            case 'heading':
                $this->converter = new HeadingConverter();
                break;
            case 'columns':
                $this->converter = new ColumnsConverter();
                break;
			 case 'button':
                $this->converter = new ButtonConverter();
                break;
			case 'accordion':
                $this->converter = new AccordionConverter();
            break;
            case 'list':
                $this->converter = new ListConverter();
                break;
            case 'quote':
                $this->converter = new BlockquoteConverter();
                break;
            case 'video':
                $this->converter = new IframeConverter();
                break;
			case 'iframe':
                $this->converter = new IframeExtendedConverter();
                break;
            case 'image':
                $this->converter = new ImageConverter();
                break;
			case 'image_extended':
                $this->converter = new ImageExtendedConverter();
                break;
            default:
                $this->converter = new BaseConverter();
                break;
        }
    }

    public function getHtml(array $data) {
        return $this->converter->toHtml($data);
    }

}
