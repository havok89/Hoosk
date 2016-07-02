<?php foreach ($page as $p){
echo "<li class='dd-item' data-href='".$p['pageURL']."' data-title='".$p['navTitle']."'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='fa fa-remove'></i></a><div class='dd-handle'>".$p['navTitle']."</div></li>";	
}?>