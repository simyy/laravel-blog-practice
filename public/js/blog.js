function nextPage(page) {
	url = "index/articles?page="+page;
	$.getJSON(url, function(data){
		var d = data;
		console.log(d.contents);
		if (d.contents == null)
			console.log('123');
		document.getElementById("article").innerHTML = tmpl("tmpl-article", d);
	});
}