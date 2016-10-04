var express = require("express");
var app = express();

app.set('port', process.env.PORT || 3000);

app.get('/', function(req, res)
	{
		res.send("Express!");
	});
app.listen(app.get('port'), function()
	{
		console.log('express started');
	});
