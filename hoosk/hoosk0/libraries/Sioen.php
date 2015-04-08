<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sioen {
   
   public function __construct()
    {
        require_once APPPATH.'third_party/Michelf/Markdown.inc.php';
        require_once APPPATH.'third_party/Sioen/Converter.php';
        require_once APPPATH.'third_party/Sioen/ToHtmlContext.php';
        require_once APPPATH.'third_party/Sioen/ToJsonContext.php';
		require_once APPPATH.'third_party/Sioen/Types/ConverterInterface.php';
        require_once APPPATH.'third_party/Sioen/Types/BaseConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/BlockquoteConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/HeadingConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/IframeConverter.php';
		require_once APPPATH.'third_party/Sioen/Types/ImageConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/ListConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/ParagraphConverter.php';
		require_once APPPATH.'third_party/Sioen/Types/ColumnsConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/ButtonConverter.php';
        require_once APPPATH.'third_party/Sioen/Types/AccordionConverter.php';
		require_once APPPATH.'third_party/Sioen/Types/ImageExtendedConverter.php';
		require_once APPPATH.'third_party/Sioen/Types/IframeExtendedConverter.php';
    }
  
}
