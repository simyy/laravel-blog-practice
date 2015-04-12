@extends('layouts.base')

@section('content')
<div class="am-form-group">
  <label for="title">标题</label>
  <input type="text" class="am-form-field am-round" id="title" placeholder="请输入标题" value={{ $title }}>
</div>
<div class="am-form-group">
  <label for="content">正文</label>
  <textarea id='content' name="area2" style="height:500px;width: 100%;" placeholder="Search W3School">{{ $content }}</textarea>
</div>
<input id="id" style="display:none;" value="{{ $id }}">

<button style="float:right;" class="am-btn am-btn-primary" id="doc-confirm-toggle">完成编辑</button>
<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">Laravel Blog</div>
    <div class="am-modal-bd">
      你，确定要提交吗？
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
    </div>
  </div>
</div>

<button style="float:right;" class="am-btn am-btn-warning " data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 400, height: 225}">设置标签</button>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">标签
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
      <div class="am-form-group" id="tags">
        @foreach ($tags as $tag)
        <label class="am-checkbox-inline">
          <input type="checkbox" name="mtag" value="{{$tag->name}}"> {{$tag->name}}
        </label>
        @endforeach
      </div>
      <div>
        <div id="selftag" class="am-input-group" style="padding-left:30%">
            <input type="text" id="newtag">
            <a class="am-icon-plus-square-o" onclick="addtag()"></a>
        </div>
      </div>
    </div>
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
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<script type="text/javascript">
$(function() {
  $('#doc-confirm-toggle').on('click', function() {
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function() {
            var id = document.getElementById("id").value;
            var title = document.getElementById("title").value;
            var content = document.getElementsByClassName("nicEdit-main")[0].innerHTML;
            var tags = document.getElementsByName("mtag");
            var tag="";
            for (var i=0;i<tags.length;i++) {
                if (tags[i].checked == true) {
                    tag = tag + tags[i].value+";"
                }
            }
            if (tag.length != 0)
                tag = tag.substring(0, tag.length-1);
            if (title.length == 0) {
                alert("标题为空, 不允许提交");
                return;
            }
            if (content.length == 0) {
                alert("内容为空，不允许提交"); 
                return;
            }
            $.ajax({
                url: 'edit',
                type: 'POST',
                data: {"id":id, "title":title, "content":content, "tag":tag},
                success: function(msg) {
                    msg = JSON.parse(msg);
                    if (msg.status == 200)
                        window.location.href = "article/?id="+msg.id;
                    else 
                        alert(msg.message);
                }
            });
        },
        onCancel: function() {
          //alert('继续编辑吧！！');
        }
      });
    });
});

</script>
<script>
function addtag() {
    var tag = document.getElementById("newtag").value;
    if(tag.length == 0) {
        alert('不允许为空');
    }
    else {
        html = '<label class="am-checkbox-inline"><input type="checkbox" name="mtag" value="'+tag+'"> '+tag+'</label>';
        $('#tags').append(html);
        document.getElementById("newtag").value="";
    }
}
</script>
@stop
