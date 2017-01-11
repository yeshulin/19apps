<?php

use yii\helpers\Html;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $routes [] */

$this->title = '权限管理';
$this->params['breadcrumbs'][] = $this->title;

$opts = Json::htmlEncode([
    'routes' => $Routes
]);

$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>

<h1><?= Html::encode($this->title) ?></h1>


<div class="row">
    <div class="col-sm-11">
        <div class="input-group">
            <input id="inp-route" type="text" class="form-control"
                   placeholder="New route(s)">
            <span class="input-group-btn">
                <?= Html::a('添加权限'.$animateIcon, ['create'], [
                    'class' => 'btn btn-success',
                    'id' => 'btn-new',
                ]) ?>
            </span>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<div class="row">
    <div class="col-sm-5">
        <div class="input-group">
            <input class="form-control search" data-target="avaliable"
                   placeholder="搜索可添加路由">
            <span class="input-group-btn">
                <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['refresh'], [
                    'class' => 'btn btn-default',
                    'id' => 'btn-refresh'
                ]) ?>
            </span>
        </div>
        <select multiple size="20" class="form-control list" data-target="avaliable"></select>
    </div>
    <div class="col-sm-1">
        <br><br>
        <?= Html::a('&gt;&gt;'.$animateIcon , ['assign'], [
            'class' => 'btn btn-success btn-assign',
            'data-target' => 'avaliable',
            'title' => 'Assign'
        ]) ?><br><br>
        <?= Html::a('&lt;&lt;'.$animateIcon , ['remove'], [
            'class' => 'btn btn-danger btn-assign',
            'data-target' => 'assigned',
            'title' => 'Remove'
        ]) ?>
    </div>
    <div class="col-sm-5">
        <input class="form-control search" data-target="assigned"
               placeholder="搜索已有路由">
        <select multiple size="20" class="form-control list" data-target="assigned"></select>
    </div>
</div>

<?php $this->beginBlock('opts');?>
var _opts = <?= "{$opts}";?>;
var csrfToken = $('meta[name="csrf-token"]').attr("content");
$('i.glyphicon-refresh-animate').hide();
function updateRoutes(r) {
_opts.routes.avaliable = r.avaliable;
_opts.routes.assigned = r.assigned;
search('avaliable');
search('assigned');
}

$('#btn-new').click(function () {
var $this = $(this);
var route = $('#inp-route').val().trim();
if (route != '') {
$this.children('i.glyphicon-refresh-animate').show();

$.post($this.attr('href'), {route: route}, function (r) {
$('#inp-route').val('').focus();
updateRoutes(r);
}).always(function () {
$this.children('i.glyphicon-refresh-animate').hide();
});
}
return false;
});

$('.btn-assign').click(function () {
var $this = $(this);
var target = $this.data('target');
var routes = $('select.list[data-target="' + target + '"]').val();

if (routes && routes.length) {
$this.children('i.glyphicon-refresh-animate').show();

$.post($this.attr('href'), {routes: routes.join('||'), _csrf:csrfToken}, function (r) {
updateRoutes(r);
}).always(function () {
$this.children('i.glyphicon-refresh-animate').hide();
});
}
return false;
});

$('#btn-refresh').click(function () {
var $icon = $(this).children('span.glyphicon');
$icon.addClass('glyphicon-refresh-animate');
$.post($(this).attr('href'), function (r) {
updateRoutes(r);
}).always(function () {
$icon.removeClass('glyphicon-refresh-animate');
});
return false;
});

$('.search[data-target]').keyup(function () {
search($(this).data('target'));
});

function search(target) {
var $list = $('select.list[data-target="' + target + '"]');
$list.html('');
var q = $('.search[data-target="' + target + '"]').val();
$.each(_opts.routes[target], function () {
var r = this;
if (r.indexOf(q) >= 0) {
$('<option>').text(r).val(r).appendTo($list);
    }
    });
    }

    // initial
    search('avaliable');
    search('assigned');


<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['opts']);
?>
