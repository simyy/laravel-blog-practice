@extends('layouts.base') 

@section('content')
@if ($contents != NULL)
    <ul class="am-list">
    @foreach ($contents as $content)
          <li>
            <a href="article?id={{ $content["id"] }}">{{ $content["title"] }}</a>
          </li>
    @endforeach
@else
    <h1 class="am-article-title">别闹了,这啥都没有</h1>
@endif
</ul>
@if ($next != 0)
    <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextPage(2)">点击翻页O(∩_∩)O~</button>
@else
    <button type="button" class="am-btn am-btn-success am-radius am-disabled am-btn-block">╮(╯_╰)╭没有更多了</button>
@endif

@stop

@section('about')
<section class="am-panel am-panel-default">
  <div class="am-panel-hd">关于</div>
    <div class="am-panel-bd">
    <p>{{ $about }}</p><a class="am-btn am-btn-success am-btn-sm" href="#">查看更多 →</a>
  </div>
</section>
@stop

@section('catalog')
<section class="am-panel am-panel-default">
  <div class="am-panel-hd">文章目录</div>
  <ul class="am-list blog-list">
  @foreach ($catalog as $item)
    <li><a href="article?id={{ $item->id }}">{{ $item->title }}</a></li>
  @endforeach
  </ul>
</section>
@stop

@section('script')
<script src="js/tmpl.min.js"></script>
<script src="js/blog.js"></script>
<script type="text/x-tmpl" id="tmpl-article"> 
[% for (var i=0;i<o.contents.length;i++) { %]
  <article class="blog-main">
    <h3 class="am-article-title blog-title">
      <a href="#">[%=o.contents[i].title%]</a>
      [% for (var j = 0, color=Array("primary","secondary","success","warning","danger"); j < o.contents[i].tag.length; j++) { %]
        <a style="color:white;" class="am-badge am-badge-[%=color[j%5]%] am-round">[%=o.contents[i].tag[j]%]</a> 
      [% } %] 
    </h3>
  </h3>
  <h4 class="am-article-meta blog-meta"></a> posted on [%=o.contents[i].time%] by <a href="">[%=o.contents[i].author%]</a></h4>
  <div class="am-g blog-content">
    <div class="col-sm-12">
      <p>[%=o.contents[i].content%] ...<a href="">阅读全文</a></p>
    </div>
  </div>
</article>
<hr class="am-article-divider blog-hr"/>
[% } %]
[% if (o.next != 0) { %]
    <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextPage([%=o.next%])">点击翻页O(∩_∩)O~</button>
    [%if (o.next != 2) {%] 
        <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextPage([%=o.next-1%])">返回前页O(∩_∩)O~</button>
    [% } %]
[% } else { %]
    <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextPage(1)">╮(╯_╰)╭没有更多了,返回首页吧</button>
[% } %]
</script>
@stop
