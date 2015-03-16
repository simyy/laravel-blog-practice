@extends('layouts.base')

@section('content')
<div class="am-form-group">
  <label for="title">标题</label>
  <input type="text" class="am-form-field am-round" id="title" placeholder="输入文章标题">
</div>
<div class="am-form-group">
  <label for="content">正文</label>
  <textarea id='content' name="area2" style="height:500px;width: 100%;">请输入文章正文</textarea>
</div>

<button style="float:right;" class="am-btn am-btn-primary" id="doc-confirm-toggle">完成编辑</button>
<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">Amaze UI</div>
    <div class="am-modal-bd">
      你，确定要删除这条记录吗？
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
    <div class="am-modal-hd">Modal 标题
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
      <div class="am-form-group">
        <label class="am-checkbox-inline">
          <input type="checkbox" value="option1"> 选我
        </label>
        <label class="am-checkbox-inline">
          <input type="checkbox" value="option2"> 同时可以选我
        </label>
        <label class="am-checkbox-inline">
          <input type="checkbox" value="option3"> 还可以选我
        </label>
      </div>
    </div>
  </div>
</div>

@stop

@section('script')
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<script type="text/javascript">
$(function() {
  $('#doc-modal-list').find('.am-icon-close').add('#doc-confirm-toggle').
    on('click', function() {
      $('#my-confirm').modal({
        relatedTarget: this,
        onConfirm: function(options) {
          var $link = $(this.relatedTarget).prev('a');
          var msg = $link.length ? '你要删除的链接 ID 为 ' + $link.data('id') :
            '确定了，但不知道要整哪样';
          alert(msg);
        },
        onCancel: function() {
          alert('算求，不弄了');
        }
      });
    });
});
</script>
@stop
