function List(){
	this.listEnd = null;
	function createList(){
		return {previous:null,data:null,next:null};
	}
	
	this.add = function(count){
		if (this.listEnd == null){
			this.listEnd = createList();
			this.listEnd.next = this.listEnd;
			this.listEnd.previous = this.listEnd;
		}else{
			var temp = createList();
			temp.next = this.listEnd.next;
			temp.previous = this.listEnd;
			this.listEnd.next = temp;
			temp.next.previous = temp;
			this.listEnd = temp;
		}
		this.listEnd.data = $(count);
	}
	
}