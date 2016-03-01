<?php
	require_once "/home3/deamon/public_html/lib.php";
	page();

	$base_dir = getUserPerm("access");
	if($base_dir == ''){
		$base_dir = "../media/$_SESSION[person]";
	}else if($base_dir == ".*"){
		$base_dir = "";
	}
?>

<style>
	#browser{
		width:calc(100% - 2em);
		min-height: 500px;
		border-width: 1em;
		border-color: black;
		border-style: double;
		background-color: rgb(245, 245, 220);
	}

	.file{
		background:red;
	}
	.folder{
		background:yellow;
	}
	.dir{
		display:inline-block;
		width: 10ch;
		height: 10ch;
		margin: 1.2em;
		vertical-align: top;
		overflow-wrap: break-word;
		text-decoration: none;
		color: inherit;
		cursor: pointer;
	}
</style>

<div id='browser'></div>
<div id='browsercontrols'><div id='back'>Back</div><div id='Move'></div><div id='Delete'></div></div>

<script>
	var basedir = '<?php echo $base_dir;?>';
	var canvas = $('#browser');
	var bback = $('#back');
	var bmove = $('#Move');
	var bdelete = $('#Delete');

	var myhistory = Array();
	var current = "";
	var next = basedir;
	var request;

	function fetchdir(dir,remember){
		next = dir;
		request = $.get( "//deamon.info/api/files/", { where: dir },function(data){updatebrowser(data,remember);} );
	}
	
	function updatebrowser (data,remember){
		if(request.status == 200){
			if(remember != false){
				myhistory.push(current);
			}
			current = next;
			next = "";
			canvas.empty();
			var action;
			JSON.parse(request.responseText).forEach(function(dat){
				if(dat['folder']){
					type = 'folder';
					action = '';
					var div = ("<div class='dir folder' onclick='fetchdir("+'"'+current+"/"+dat['name']+'"'+")'>"+dat['name']+"</div>");
				}else{
					var div = ("<a class='dir file' href='//deamon.info/edit/?url="+current+"/"+dat['name']+"' target='_blank'>"+dat['name']+"</a>");
				}
				canvas.append(div);
			})
		}else if(request.status >= 300 && request.status < 400){
			error("Redirection Error");
		}else if(request.status >= 500 && request.status < 600){
			error("Server Error");
		}else if(request.status == 402 || request.status == 403){
			error("Access Denied!");
		}else if(request.status >= 400 && request.status < 500){
			error("Client Error");
		}else{
			error("Unknown Error?");
		}
		console.log("loaded: "+request.status);
	}
	
	function error(desc){
		alert(desc+request.status);
	}
	
	function goback(){
		fetchdir(myhistory.pop(),false);
	}
	
	bback[0].onclick = goback;
	fetchdir(basedir);
</script>