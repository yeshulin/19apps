<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Goods;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div style="clear: both"></div>
    <p>
<!--        --><?//= Html::a('创建组合商品', ['create-merge'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('创建商品', ['class' => 'btn btn-success', 'id' => 'create_goods']) ?>
        <?= Html::a('回收站', ['recycled'], ['class' => 'btn btn-success navbar-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goods_id',
            'goods_name',
//            'keywords',
//            'goods_thumb',
            'price',
             'money',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Goods::dropDown('type', $model->type);
                },
            ],
            // 'association_id',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Goods::dropDown('status', $model->status);
                },
            ],
             'create_at:datetime',
             'update_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <script>

        function addGoodsByType(o)
        {
            var goodsType = $(o).parent().siblings(".field-goodssearch-type").find("select").val();
            window.location.href = "<?= \yii\helpers\Url::to(['create',])?>"+"&type="+goodsType;
        }

        $("#create_goods").on("click", function()
        {
            //自定页
            layer.open({
                type: 1,
                skin: 'layui-layer-demo', //样式类名
                closeBtn: false, //不显示关闭按钮
                shift: 2,
                shadeClose: true, //开启遮罩关闭
                title: '选择添加的商品类型',
                content: '<div class="field-goodssearch-type has-success" style="padding:20px;with: 500px"> ' +
                '<select class="form-control" name="Goods[type]"> ' +
                '<option value="<?= $searchModel::TYPE_PXCC?>">培训课程</option> ' +
//                '<option value="<?//= $searchModel::TYPE_ZYRZ?>//">职业认证</option> ' +
                '<option value="<?= $searchModel::TYPE_MERGE?>">组合商品</option> ' +
                '</select> ' +
                '<div class="help-block"></div> ' +
                '</div><div class="form-group" style="padding-left:20px;;"> ' +
                '<button type="submit" onclick="addGoodsByType(this)" class="btn btn-primary">确定</button>' +
                '</div>'
            });
        })



        //自定页
//        parent.layer.open({
//            type: 1,
//            skin: 'layui-layer-demo', //样式类名
//            closeBtn: false, //不显示关闭按钮
//            shift: 2,
//            shadeClose: true, //开启遮罩关闭
//            content: ' <?//= str_replace("\r\n","",Html::dropDownList('', null, Goods::dropDown('type')))?>//'
//        });
//        console.log('');
    </script>
</div>
