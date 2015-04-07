function html_decode(str)   
{   
  var s = "";   
  if (str.length == 0) return "";   
  s = str.replace(/&gt;/g, "&");   
  s = s.replace(/&lt;/g, "<");   
  s = s.replace(/&gt;/g, ">");   
  s = s.replace(/&nbsp;/g, " ");   
  s = s.replace(/&#39;/g, "\'");   
  s = s.replace(/&quot;/g, "\"");   
  s = s.replace(/<br>/g, "\n");   
  s = s.replace(/&/g, ">");
  return s;   
}

function nextPage(page) {
	url = "index/articles?page="+page;
	$.getJSON(url, function(data){
		var d = data;
		console.log(d.contents);
		if (d.contents == null)
			console.log('123');
        var h = tmpl("tmpl-article", d);
        var decode = html_decode(h);
		document.getElementById("article").innerHTML = decode;
	});
}

function nextTitles(page) {
    url = "manage/next?page=" + page;
    $.getJSON(url, function(data){
        var d = data;
        console.log(d.contents);
        var h = tmpl("tmpl-title", d);
		document.getElementById("title-list").innerHTML = h;
    });
}
