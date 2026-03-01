var host = location.host;
var server = "";
if (host == 'localhost'){
  server = host+'/'+pasta;
}else{
  server = host;
}

var larg = screen.width;
if (larg <= 960){
	window.location.href="https://"+server+"/mobile";
}