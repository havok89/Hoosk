<?php



class ToJsonContext
{
    protected $converter = null;

    public function __construct($nodeName)
    {
        switch ($nodeName) {
            case 'p':
                $this->converter = new ParagraphConverter();
                break;
            case 'h2':
                $this->converter = new HeadingConverter();
                break;
            case 'ul':
                $this->converter = new ListConverter();
                break;
            case 'blockquote':
                $this->converter = new BlockquoteConverter();
                break;
            case 'iframe':
                $this->converter = new IframeConverter();
                break;
            case 'img':
                $this->converter = new ImageConverter();
                break;
            default:
                $this->converter = new BaseConverter();
                break;
        }
    }

    public function getData(\DOMElement $node)
    {
        return $this->converter->toJson($node);
    }
}
