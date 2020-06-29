<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.css" integrity="sha256-jyWGtg7ocpUge8Zt/LotwFtPMWE23n7jgkHHw/Ejh+U=" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css?family=Inconsolata|Roboto:400,400i,500,500i,700,700i|Titillium+Web&display=swap" rel="stylesheet">

<style>
	.markdown-body {
		box-sizing: border-box;
		min-width: 200px;
		max-width: 980px;
		margin: 0 auto;
		padding: 45px;
		font-family: 'Roboto', sans-serif;
		}

	@media (max-width: 767px) {
		.markdown-body {
			padding: 15px;
		}
	}
</style>

<div class="markdown-body">

<?php 

	function listFolderFiles($dir){
	    $ffs = scandir($dir);
	    unset($ffs[array_search('.', $ffs, true)]);
	    unset($ffs[array_search('..', $ffs, true)]);
	    // prevent empty ordered elements
	    if (count($ffs) < 1)
	        return;

	    echo '<ul>';
	    foreach($ffs as $ff){
	    	$ext = strtolower(pathinfo($ff,PATHINFO_EXTENSION));
            if($ext && !in_array($ext,['md','jpg','png'])){
	    		continue;
	    	}
	        echo '<li>';
	        if(is_dir($dir.'/'.$ff)){
	        	echo $ff;
	        	listFolderFiles($dir.'/'.$ff);
	        }else{
	        	echo '<a href="?file='.$dir.'**'.$ff.'" >'.$ff.'</a>';
	        }
	        echo '</li>';
	    }
	    echo '</ul>';
	    
	}
    listFolderFiles('md');

    $image = FALSE;
	if(isset($_GET['file']) && $_GET['file']){
		$file = str_replace('**','/',$_GET['file']);
		$container = file_get_contents($file);

        $ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        if($ext && in_array($ext,['jpg','png'])){
            $image = $file;
        }

	}else{
		$container = file_get_contents('md/Service container/Service-container.md');
	}

    if($image){
        echo "<br><br><img src='/".$file."' >";
    }else{
    	require 'vendor/autoload.php';
	    $Parsedown = new Parsedown();
        echo $Parsedown->text($container);
    }

?>

</div>
