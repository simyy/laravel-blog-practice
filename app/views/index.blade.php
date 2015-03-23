@extends('layouts.base') 

@section('content')
@if ($contents == NULL)
<article class="blog-main">
  <h3 class="am-article-title blog-title">
    <a href="#">Google fonts 的字體（display 篇）</a>
  </h3>
  <h4 class="am-article-meta blog-meta">by <a href="">open</a> posted on 2014/06/17 under <a href="#">字体</a></h4>

  <div class="am-g blog-content">
    <div class="col-lg-7">
      <p><!-- 本demo来自 http://blog.justfont.com/ -->你自信滿滿的跟客戶進行第一次 demo。秀出你精心設計的內容時，你原本期許客戶冷不防地掉下感動的眼淚。</p>

      <p>因為那實在是太高級了。</p>

      <p>除了各項基本架構幾乎完美無缺之外，內文是高貴的，有著一些距離感的，典雅的襯線字體。不是 Times New
        Roman，而是很少有人見過的，你精心挑選過的字體，凸顯你品味的高超。而且它並沒有花上你與業主一毛錢，或許這也非常重要。</p>
    </div>
    <div class="col-lg-5">
      <p><img src="http://f.cl.ly/items/451O3X0g47320D203D1B/不夠活潑.jpg"></p>
    </div>
  </div>
  <div class="am-g">
    <div class="col-sm-12">
          <p>看著自己的作品，你的喜悅之情溢於言表，差點就要說出我要感謝我的父母之類的得獎感言。但在你對面的客戶先是一點表情也沒有，又瞬間轉為陰沉，抿了抿嘴角冷冷的說……</p>

      <p>「我要一種比較跳的感覺懂嗎？」</p>
    </div>
  </div>
</article>
<hr class="am-article-divider blog-hr"/>
@else
    @foreach ($contents as $content)
        <article class="blog-main">
          <h3 class="am-article-title blog-title">
            <a href="#">{{ $content["title"] }}</a>
            @for ($i = 0, $color=Array("primary","secondary","success","warning","danger"); $i < count($content["tag"]); $i++)
                <a style="color:white;" class="am-badge am-badge-{{$color[$i%5]}} am-round">{{$content["tag"][$i]}}</a> 
            @endfor
          </h3>
          <h4 class="am-article-meta blog-meta"></a> posted on {{ $content["time"] }} by <a href="">{{ $content["author"] }}</a></h4>
          <div class="am-g blog-content">
            <div class="col-sm-12">
              <p>{{ $content["content"]}} ...<a href="">阅读全文</a></p>
            </div>
          </div>
        </article>
        <hr class="am-article-divider blog-hr"/>
    @endforeach
        @if ($next != 0)
            <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextPage(2)">点击翻页O(∩_∩)O~</button>
        @else
            <button type="button" class="am-btn am-btn-success am-radius am-disabled am-btn-block">╮(╯_╰)╭没有更多了</button>
        @endif
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
    <li><a href="#">{{ $item }}</a></li>
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
