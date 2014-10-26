function search(){
			if(event.keyCode==13){
				document.location.href = '/rockon40100/search.php?item='+document.getElementById('searchbox').value;
			}
		}