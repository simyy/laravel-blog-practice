@extends('layouts.base') 

@section('content')
<article class="am-article">
  <div class="am-article-hd">
    <h1 class="am-article-title">{{ $content["title"] }}</h1>
    @for ($i = 0, $color=Array("primary","secondary","success","warning","danger"); $i < count($content["tag"]); $i++)
        <a style="color:white;" class="am-badge am-badge-{{$color[$i%5]}} am-round">{{$content["tag"][$i]}}</a> 
    @endfor
    <h4 class="am-article-meta"></a> posted on {{ $content["time"] }} by <a href="">{{ $content["author"] }}</a></h4>
  </div>

  <div class="am-article-bd">
    <p>{{ $content["content"] }}</p>
  </div>
</article>
<hr class="am-article-divider blog-hr"/>
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
<script type="text/x-tmpl" id="tmpl-comment"> 
</script>
@stop
