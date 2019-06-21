self.addEventListener('message',function(e){
	var data=e.data;
	console.log(data);
	
	for(i=0;i<10000;i++)
			console.log(i);
	
	self.postMessage("Printing complete");
	
},false);