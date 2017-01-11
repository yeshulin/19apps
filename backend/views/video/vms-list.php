<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/1
 * Time: 11:50
 */
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
if (!isset($data['video']))
{
    $data['video'] = [];
}
?>
<?php if ($type == 'list'): ?>
<div class="video-index">
    <style>
        .ok{  background-color: #CCC !important;}
    </style>
    <p>
        <?= Html::button('添加至视频库', ['class' => 'btn btn-success', 'id'=>'sync-vms']) ?>

    </p>
    <div class="goods-search">

        <?php $form = ActiveForm::begin([
            'method'=>'GET',
            'action'=>\yii\helpers\Url::to(['video/sync-vms-video', 'catalogId'=> Yii::$app->request->get('catalogId')])
        ]); ?>
            <div class="field-goodssearch-goods_name" style="float: left;with: 200px">
                <label class="control-label" >视频名称</label>
                <?= Html::textInput('VideoName',Yii::$app->request->get('VideoName', ''), ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodssearch-type " style="float: left;width: 241px;">
                <label class="control-label" for="goodssearch-type">时间范围：</label>
                <div class="input-daterange input-group">
                    <?= Html::textInput('startTime', Yii::$app->request->get('startTime', ''), ['class'=>'form-control', 'id'=>'create_at_start'])?>
                    <span class="input-group-addon">到</span>
                    <?= Html::textInput('endTime', Yii::$app->request->get('endTime', ''), ['class'=>'form-control', 'id'=>'create_at_end'])?>
                </div>

                <div class="help-block"></div>
            </div>

            <div class="form-group" style="padding-top: 22px; margin-left: 200px;">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div id="vms-list" class="grid-view">
        <div class="summary">
<!--            第<b>--><?//= ($data['pageNum']-1)*$data['pageSize']+1;?><!-----><?//= ($data['pageNum'])*$data['pageSize']?><!--</b>-->
<!--            条，共-->
<!--            <b>--><?//= $data['pageTotal']?><!--</b>条数据.</div>-->
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?= Html::checkboxList('', null, ['all'=>'全选'], ['id'=>'allCatalogId'])?></th>
                <th>VmsId</th>
                <th>视频名称</th>
                <th>添加时间</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($data['video'] as $k=> $v): ?>
                <tr imagePath="<?= $v['imagePath']?>" catalogId="<?= $v['catalogId']?>" programLength="<?= $v['programLength']?>" data-key="<?= $v['id']?>">
                    <td><?= Html::checkbox('catalogId', false)?></td>
                    <td><?= $v['id']?></td>
                    <td><?= $v['title']?></td>
                    <td><?= $v['publishedTime']?></td>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    <?php $this->beginBlock('date');?>
    var start = {
    elem: '#create_at_start',
    format: 'YYYY-MM-DD',
    max: laydate.now(-1), //最大日期

    <!--        istime: true,-->
    istoday: false,
    isclear: true,
    choose: function(datas){
    end.min = datas; //开始日选好后，重置结束日的最小日期
    end.start = datas //将结束日的初始值设定为开始日
    }
    };
    var end = {
    elem: '#create_at_end',
    format: 'YYYY-MM-DD',
    max: laydate.now(),
    <!--        istime: true,-->
    istoday: false,
    isclear: true,
    choose: function(datas){
    start.max = datas; //结束日选好后，重置开始日的最大日期
    }
    };
    laydate(start);
    laydate(end);
    <?php
    $this->endBlock();
    $this->registerJs($this->blocks['date'])
    ?>
    <script type="text/javascript">
        var trObj = $("#vms-list").find("tbody").find("tr");
        $("#allCatalogId").on("click", function(){
            var _checked = $(this).find("input")[0].checked;
            trObj.find('input[name="catalogId"]').each(function(){
                this.checked = _checked;
            })
        })
        $("#sync-vms").on("click",function(){

            if (trObj != 'undefined'){
                var _fData="";
                trObj.find('input[name="catalogId"]').each(function(k, v){
                    if (this.checked == true)
                    {
                        var thisT = $(this).parent().parent();
                        if (_fData != "") _fData += '|';
                        _fData += thisT.attr("data-key")+'--'+
                            thisT.find("td")[2].outerText+'--'+
                            thisT.find("td")[3].outerText+'--'+
                            thisT.attr("catalogId")+'--'+
                            thisT.attr("imagePath")+'--'+
                            thisT.attr("programLength");
                    }
                });
                if (_fData == "")
                {
                    parent.layer.msg('未选择视频');
                    return false;
                }
                $.post("<?= \yii\helpers\Url::to(['video/sync'])?>",{fData: _fData},function(d){
                    if (d == 200)
                    {
                        parent.layer.msg("同步成功");
                        setTimeout(function() {
                            parent.layer.closeAll()
                        }, 2000);
                    }else{
                        parent.layer.msg("同步失败");
                    }

                });
            }
        })
    </script>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
</div>
<?php else: ?>
<div style="    position: fixed;top: 0;bottom: 0; left: 0;right: 0;background-color: #F2F2F3;padding: 20px;">
    <div class="form-group field-video-status required">
        <label class="control-label" for="video-status">选择同步栏目</label>
        <?= Html::dropDownList('catalogId', '', $data, ['class'=>'form-control', 'id'=>'catalogPath'])?>

        <div class="help-block"></div>
    </div>
    <div class="form-group">
        <?= Html::button('确定', ['class' => 'btn btn-success', 'id'=>'sync-vms'])?>
    </div>
</div>
<script type="text/javascript">
    $("#sync-vms").on("click", function(){
        var _value = $("#catalogPath").val();
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.open({
            type: 2,
            title: 'ｖｍｓ视频同步',
            shadeClose: false,
            shade: 0.8,
            area: ['50% ', '60% '],
            content: '<?= \yii\helpers\Url::to(['sync-vms-video', 'catalogId'=>''])?>'+_value
        });
        parent.layer.close(index); //再执行关闭
    })
</script>
<?php endif; ?>
