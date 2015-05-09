<?php

class Hoosk_page_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }


	/*     * *************************** */
    /*     * ** Page Querys ************ */
    /*     * *************************** */
	function getSiteName() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('hoosk_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTitle'];			
			endforeach; 
		}
        return array();
    }
	
	function getTheme() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('hoosk_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTheme'];			
			endforeach; 
		}
        return array();
    }
	
    function getPage($pageURL) {
        // Get page
        $this->db->select("*");
        $this->db->join('hoosk_page_content', 'hoosk_page_content.pageID = hoosk_page_attributes.pageID');
        $this->db->join('hoosk_page_meta', 'hoosk_page_meta.pageID = hoosk_page_attributes.pageID');
		$this->db->where("pagePublished", 1);
		$this->db->where("pageURL", $pageURL);
        $query = $this->db->get('hoosk_page_attributes');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
	   	   				'pageID'    			=> $u['pageID'],
	   	   				'pageTitle' 			=> $u['pageTitle'],
						'pageKeywords' 			=> $u['pageKeywords'],
						'pageDescription' 		=> $u['pageDescription'],
	   	   				'pageContentHTML'   	=> $u['pageContentHTML'],
						'pageTemplate'    		=> $u['pageTemplate'],
						'enableJumbotron'   	=> $u['enableJumbotron'],
						'enableSlider'   		=> $u['enableSlider'],
						'jumbotronHTML'    		=> $u['jumbotronHTML'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array();
    }
	function getCategory($catSlug) {
        // Get category
        $this->db->select("*");
		$this->db->where("categorySlug", $catSlug);
        $query = $this->db->get('hoosk_post_category');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['categoryID'],
						'categoryID'    		=> $u['categoryID'],
	   	   				'pageTitle' 			=> $u['categoryTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['categoryDescription'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array();
    }
	
	function getArticle($postURL) {
        // Get article
        $this->db->select("*");
		$this->db->where("postURL", $postURL);
        $this->db->join('hoosk_post_category', 'hoosk_post_category.categoryID = hoosk_post.categoryID');
        $query = $this->db->get('hoosk_post');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['postID'],
						'postID'    			=> $u['postID'],
	   	   				'pageTitle' 			=> $u['postTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['postExcerpt'],
						'postContent' 			=> $u['postContentHTML'],
						'datePosted' 			=> $u['datePosted'],
						'categoryTitle' 		=> $u['categoryTitle'],
						'categorySlug' 			=> $u['categorySlug'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array();
    }
	
	
   function getSettings() {
        // Get settings
        $this->db->select("*");
		$this->db->where("siteID", 0);
        $query = $this->db->get('hoosk_settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
						'siteLogo'    			=> $u['siteLogo'],
						'siteTitle'    			=> $u['siteTitle'],
						'siteFooter'    		=> $u['siteFooter'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array();
    }

}

?>