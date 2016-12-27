<?php 

	 function wordlimit($string, $length = 40, $ellipsis = "...")
	{
		$string = strip_tags($string, '<div>');
		$string = strip_tags($string, '<p>');
		$words = explode(' ', $string);
		if (count($words) > $length)
			return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
		else
			return $string.$ellipsis;
	}
	 
	//Get the navigation bar
	function hooskNav($slug)
	{
		$CI =& get_instance();
		$CI->db->where('navSlug', $slug);
		$query=$CI->db->get('hoosk_navigation');
		foreach($query->result_array() as $n):
			$totSegments = $CI->uri->total_segments();
			if(!is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments);
			} else if(is_numeric($CI->uri->segment($totSegments))){
			$current = "/".$CI->uri->segment($totSegments-1);
			}
			if ($current == "/") {$current = BASE_URL;};
			$nav = str_replace('<li><a href="'.$current.'">', '<li class="active"><a href="'.$current.'">', $n['navHTML']);
			echo $nav;
		endforeach;

	}
	
	function getFeedPosts()
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$query=$CI->db->get('hoosk_post');
		return $query->result_array();
	}
	//Get the Latest 5 news posts
	function getLatestNewsSidebar()
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit(5, 0);
		$query=$CI->db->get('hoosk_post');
		$posts = '<ul class="list-group">';
		foreach($query->result_array() as $c):
			$posts .= '<li class="list-group-item"><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></li>';
		endforeach;
		$posts .= "</ul>";
		echo $posts;
	}
	
	//Get the Latest news for the main column
	function getLatestNews($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit($limit, $offset);
		$query=$CI->db->get('hoosk_post');
		$posts = '';
		foreach($query->result_array() as $c):
			$date = new DateTime($c['datePosted']);
			$posts .= '<div class="row">';
			if ($c['postImage'] != "") {
			$posts .= '<div class="col-md-3"><a href="/article/'.$c['postURL'].'"><img class="img-responsive" src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a></div>';
			$posts .= '<div class="col-md-9"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';
			} else {
			$posts .= '<div class="col-md-12"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';			}
			$posts .= '</div>';
			$posts .= "</div><hr />";
		endforeach;
		echo $posts;
	}
	
		//Get the categories
	function getCategories()
	{
		$CI =& get_instance();
		$CI->db->order_by("categoryTitle", "asc");
		$query=$CI->db->get('hoosk_post_category');
		$categories = '<ul class="list-group">';
		foreach($query->result_array() as $c):
			$CI->db->where('categoryID', $c['categoryID']);
			$CI->db->from('hoosk_post');
			$query = $CI->db->get();
			$totPosts = $query->num_rows();
			if ($totPosts > 0){
			$categories .= '<li class="list-group-item"><a href="/category/'.$c['categorySlug'].'"><span class="badge">'.$totPosts.'</span>'.$c['categoryTitle'].'</a></li>';
			}
		endforeach;
		$categories .= "</ul>";
		echo $categories;
	}
	
		//Get the total posts
	function countPosts($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->from('hoosk_post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		echo "Showing posts ".$offset." - ".$showing." of ".$totPosts;
	}
	
	function countCategoryPosts($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->from('hoosk_post');
		$CI->db->where('categoryID', $categoryID);
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		echo "Showing posts ".$offset." - ".$showing." of ".$totPosts;
	}
	function getPrevBtnCategory($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('hoosk_post');
		$query = $CI->db->get();
		$CI->db->where('categoryID', $categoryID);
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}

		$prevNum = $offset-$limit;
		if ($prevNum < 0){ $prevNum = 0; }
		if ($prevNum < $offset){
		echo '<a href="'.BASE_URL.$pagURL.'/'.$prevNum.'" class="btn btn-success float-left">Previous</a>';
		}
	}
	
	function getNextBtnCategory($categoryID, $limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('hoosk_post');
		$CI->db->where('categoryID', $categoryID);
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		$nextNum = $offset+$limit;
		if ($nextNum > $totPosts){
		} elseif ($nextNum <= $totPosts){ 
		$nextNum--;
		echo '<a href="'.BASE_URL.$pagURL.'/'.$nextNum.'" class="btn btn-success float-right">Next</a>';}
	}
	
	function getPrevBtn($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('hoosk_post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}

		$prevNum = $offset-$limit;
		if ($prevNum < 0){ $prevNum = 0; }
		if ($prevNum < $offset){
		echo '<a href="'.BASE_URL.$pagURL.'/'.$prevNum.'" class="btn btn-success float-left">Previous</a>';
		}
	}
	
	function getNextBtn($limit=10,$offset=0)
	{
		$CI =& get_instance();
		$totSegments = $CI->uri->total_segments();
		$i=1;
		$pagURL = "";
		while ($i <= $totSegments) {
			if(!is_numeric($CI->uri->segment($i))){
			$pagURL .= "/".$CI->uri->segment($i);
			}
			$i++;
		}
		$CI->db->from('hoosk_post');
		$query = $CI->db->get();
		$totPosts = $query->num_rows();
		$showing = $offset+$limit;
		if ($showing > $totPosts){
		$showing = $totPosts;
		}
		$offset++;
		$nextNum = $offset+$limit;
		if ($nextNum > $totPosts){
		} elseif ($nextNum <= $totPosts){ 
		$nextNum--;
		echo '<a href="'.BASE_URL.$pagURL.'/'.$nextNum.'" class="btn btn-success float-right">Next</a>';}
	}
	
	//Get the Latest news for the main column
	function getCategoryNews($categoryID,$limit=10,$offset=0)
	{
		$CI =& get_instance();
		$CI->db->order_by("unixStamp", "desc");
		$CI->db->limit($limit, $offset);
		$CI->db->where('categoryID', $categoryID);
		$query=$CI->db->get('hoosk_post');
		$posts = '';
		foreach($query->result_array() as $c):
			$date = new DateTime($c['datePosted']);
			$posts .= '<div class="row">';
			if ($c['postImage'] != "") {
			$posts .= '<div class="col-md-3"><a href="/article/'.$c['postURL'].'"><img class="img-responsive" src="'.BASE_URL.'/images/'.$c['postImage'].'" alt="'.$c['postTitle'].'"/></a></div>';
			$posts .= '<div class="col-md-9"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';
			} else {
			$posts .= '<div class="col-md-12"><h3><a href="/article/'.$c['postURL'].'">'.$c['postTitle'].'</a></h3>';
			$posts .= '<p class="meta">'.date_format($date, 'd/m/Y').'</p>';
			$posts .= '<p>'.$c['postExcerpt'].'</p>';
			$posts .= '<p><a class="btn btn-primary" href="/article/'.$c['postURL'].'">Read More</a></p>';			}
			$posts .= '</div>';
			$posts .= "</div><hr />";
		endforeach;
		echo $posts;
	}
	
	
		//Get the carousel
	function getCarousel($id)
	{
		$CI =& get_instance();
		$CI->db->order_by("slideOrder", "asc");
		$CI->db->where("pageID", $id);
		$query=$CI->db->get('hoosk_banner');
		$carousel = '<ol class="carousel-indicators">'."\r\n";
		$s = 0;
		foreach($query->result_array() as $c):
			if ($s == 0){
				$carousel .= '<li data-target="#carousel" data-slide-to="'.$s.'" class="active"></li>'."\r\n";
			} else {
				$carousel .= '<li data-target="#carousel" data-slide-to="'.$s.'"></li>'."\r\n";
			}
			$s++;
		endforeach;
		$s = 0;
		$carousel .= '</ol><div class="carousel-inner" role="listbox">'."\r\n";
		foreach($query->result_array() as $c):
			if ($s == 0){
			  $carousel .= '<div class="item active">'."\r\n";
			  if ($c['slideLink'] != "") {
			  	$carousel .= '<a target="_blank" href="'.$c['slideLink'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/".$c['slideImage'].'" alt="'.$c['slideAlt'].'">'."\r\n";
			  if ($c['slideLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
			  $carousel .= '</div>'."\r\n";
			} else {
			  $carousel .= '<div class="item">'."\r\n";
			  if ($c['slideLink'] != "") {
			  	$carousel .= '<a target="_blank" href="'.$c['slideLink'].'">'."\r\n";
			  }
			  $carousel .= '<img src="'.BASE_URL."/uploads/".$c['slideImage'].'" alt="'.$c['slideAlt'].'">'."\r\n";
			  if ($c['slideLink'] != "") {
			 	$carousel .= '</a>'."\r\n";
			  }
			  $carousel .= '</div>'."\r\n";
			}
			$s++;
		endforeach;
		$carousel .= "</div>"."\r\n";
		echo $carousel;
	}

	//Get social
	function getSocial()
	{
		$CI =& get_instance();
		$CI->db->where("socialEnabled", 1);
		$query=$CI->db->get('hoosk_social');
		$social = '';
		foreach($query->result_array() as $c):
			$social .= '<a href="'.$c['socialLink'].'" target="_blank"><span class="socicon socicon-'.$c['socialName'].'"></span></a>';
		endforeach;
		echo $social;
	}

?>