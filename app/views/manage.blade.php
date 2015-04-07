@extends('layouts.base')

@section('content')
<div class="am-panel am-panel-default">
  <div class="am-panel-hd">
    <h3 class="am-panel-title">文章管理</h3>
  </div>
  <div class="am-panel-bd" id="title-list">
    <table class="am-table">
        <thead>
            <tr>
                <th>标题</th>
                <th>时间</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($contents as $content) 
            <tr>
                <td>{{ $content["title"] }}</td>
                <td>{{ $content["time"] }}</td>
                <td>
                  <div class="am-dropdown" data-am-dropdown="">
                    <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle=""><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                    <ul class="am-dropdown-content">
                      <li><a href="#">1. 编辑</a></li>
                      <li><a href="#">2. 下载</a></li>
                      <li><a href="#">3. 删除</a></li>
                    </ul>
                  </div>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
    @if ($next != 0)
        <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextTitles(2)">点击翻页O(∩_∩)O~</button>
    @else
        <button type="button" class="am-btn am-btn-success am-radius am-disabled am-btn-block">╮(╯_╰)╭没有更多了</button>
    @endif
  </div>
</div>
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
<script type="text/x-tmpl" id="tmpl-title"> 
  <div class="am-panel-bd">
    <table class="am-table">
        <thead>
            <tr>
                <th>标题</th>
                <th>时间</th>
                <th>管理</th>
            </tr>
        </thead>
        <tbody>
        [% for (var i=0;i<o.contents.length;i++) { %]
          <tr>
              <td>[%=o.contents[i].title%]</td>
              <td>[%=o.contents[i].time%]</td>
              <td>
                <div class="am-dropdown" data-am-dropdown="">
                  <button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle=""><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
                  <ul class="am-dropdown-content">
                    <li><a href="#">1. 编辑</a></li>
                    <li><a href="#">2. 下载</a></li>
                    <li><a href="#">3. 删除</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        [% } %]
        </tbody>
    </table>
    [%if (o.next != 0) {%]
        <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextTitles([%=o.next%])">点击翻页O(∩_∩)O~</button>
        [%if (o.next != 2) {%]
            <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextTitles([%=o.next-2%])">返回前页O(∩_∩)O~</button>
        [% } %]
    [% }else{ %]
        <button type="button" class="am-btn am-btn-success am-radius am-disabled am-btn-block" onclick="nextTitles(1)">╮(╯_╰)╭没有更多了</button>
        <button type="button" class="am-btn am-btn-success am-radius am-btn-block" onclick="nextTitles(1)">返回首页O(∩_∩)O~</button>
    [% } %]
  </div>
</script>
@stop
