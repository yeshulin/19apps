<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Course;
use common\models\Member;
use common\models\CourseConfig;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程列表';
$this->params['breadcrumbs'][] = $this->title;
$parentCourseConfig = CourseConfig::dropDown('parent');
//$this->registerJsFile()
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('课程配置', ['/course/course-config/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('创建课程', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'course_id',
            'course_name',
            [
                'attribute' => 'brief',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::textarea('', $model->brief);
                },
            ],
//            'brief:ntext',
//            'description:ntext',
            [
                'attribute' => 'authorid',
                'value' => function ($model) {
                    return Member::findUsernameByUserid($model->authorid);
                },
            ],
            // 'thumb',
            // 'type',
            // 'userid',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Course::dropDown('type', $model->type);
                },
                "filter" => Course::dropDown('type'),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Course::dropDown('status', $model->status);
                },
                "filter" => Course::dropDown('status'),
            ],
             'create_at:datetime',
             'update_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {pinterest} {update} {delete}',
                'buttons' => [
                    'pinterest' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-pinterest-p"></span>', 'javascript:;', [
                            'title' => '首页推荐',
                            'aria-label' => '首页推荐',
                            'data-pjax' => '0',
                            'class'=> 'pinterest',
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function addCourseIndex(o)
    {
        var _index = null, _data_key = $(o).attr("data-key");
        $(o).parent().siblings(".field-goodssearch-type").find('input[name="CourseIndex[]"]').each(function() {
            if (this.checked == true)
            {
                _index = _index == null ? this.value : _index+','+this.value;
            }
        })
//        console.log(_index);
        $.get("<?= \yii\helpers\Url::to(['pinterest'])?>",{id: _data_key, configid: _index}, function(result){
            layer.closeAll();
            layer.msg('推荐成功');
        })
    }
    $(".pinterest").on("click", function(){
        var _data_key = $(this).parent().parent().attr("data-key"), Key;
        $.ajaxSetup({
            async : false
        });
        $.get("<?= \yii\helpers\Url::to(['pinterest'])?>",{id: _data_key}, function(result){
            Key = result;
        })
        Key = eval("("+Key+")");
        layer.open({
            type: 1,
            skin: 'layui-layer-demo', //样式类名
            closeBtn: false, //不显示关闭按钮
            shift: 2,
            shadeClose: true, //开启遮罩关闭
            title: '推荐到首页位置选择',
            content: '<div class="field-goodssearch-type has-success" style="padding:20px;with: 500px"> ' +
            <?php foreach (CourseConfig::getConfigIndexData() as $k=>$v):?>
                '<label class="checkbox-inline"><input type="checkbox" '+(Key[<?= $k?>] == undefined ? '' :'checked')+' name="CourseIndex[]" value="<?= $k?>"><?= $v['lab']?></label>' +
            <?php endforeach; ?>
            '<div class="help-block"></div> ' +
            '</div><div class="form-group" style="padding-left:20px;;"> ' +
            '<button type="submit" onclick="addCourseIndex(this)" data-key="'+_data_key+'" class="btn btn-primary">确定</button>' +
            '</div>'
        });
    })
</script>
