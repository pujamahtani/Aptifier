self.addEventListener('message',function(e){
	var data=e.data;
	switch(data.cmd){
		case 'avg':
			var result="worker thread 1";
			self.postMessage(result);
			break;
		default:
			self.postMessage('Invalid Commmand');
	}
},false);