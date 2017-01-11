<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/27
 * Time: 10:04
 */

namespace backend\controllers\attached;

use backend\models\Video;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use common\components\Vms;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    public function actionJson()
    {
        //文件保存路径
        $save_path = Yii::$app->params['upload_path'];
        $save_url = Yii::$app->params['web_upload_path'];
        $ext_arr = Yii::$app->params['upload_exts'];
        $file_max_size = Yii::$app->params['upload_file_size'];

        //最大文件大小
        $max_size = $file_max_size * 1024 * 1024;

        $file = UploadedFile::getInstanceByName('imgFile');
//        $file = new UploadedFile();

//PHP上传失败
        if (!empty($file->error)) {
            switch($file->error){
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            return Yii::$app->response->data = ['error' => 1, 'message' => $error];
        }

//有上传文件时
        if (empty($file) === false) {
            //原文件名
            $file_name = $file->name;
            //服务器上临时文件名
            $tmp_name = $file->tempName;
            //文件大小
            $file_size = $file->size;
            //检查文件名
            if (!$file_name) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "请选择文件。"];
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传目录不存在。"];
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传目录没有写权限。"];
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传失败。"];
            }
            //检查文件大小
            if ($file_size > $max_size) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传文件大小超过限制。"];
            }
            //检查目录名
            $dir_name = Yii::$app->request->get('dir', 'image');
            if (empty($ext_arr[$dir_name])) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "目录名不正确。"];
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传文件扩展名是不允许的扩展名。\n只允许\" . implode(\",\", $ext_arr[$dir_name]) . \"格式。。"];
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path)) {
                mkdir($save_path);
            }
            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                return Yii::$app->response->data = ['error' => 1, 'message' => "上传文件失败。"];
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            header('Content-type: text/html; charset=UTF-8');
            $json = new Services_JSON();
            echo $json->encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    public function actionUpload(){

        $root_path = Yii::$app->params['upload_path'];
        $root_url = Yii::$app->params['web_upload_path'];
        $ext_arr = Yii::$app->params['upload_exts']['image'];
//目录名
        $dir_name = Yii::$app->request->get('dir', '');
        if (!in_array($dir_name, array(
            '',
            'image',
            'flash',
            'media',
            'file',
            'vmsVideo',
            'vmsAudio',
            'getVms',
        ))) {
            echo "Invalid Directory name.";
            exit;
        }
        if ($dir_name == 'vmsVideo')
        {
            $Video = (new Video())
                ->find()->where(['status'=>Video::STATUS_DEFAULT])
                ->orderBy([
                    'order' => SORT_DESC,
                    'create_at' => SORT_DESC,
                    'videoid' => SORT_DESC,
                ])
                ->limit(10)
                ->asArray(true)->all();
            echo Json::encode($Video);
            exit;
        }

        if ($dir_name == 'vmsAudio')
        {
            echo 123123;
            exit;
        }

        if ($dir_name == 'getVms')
        {
            $vmsid = Yii::$app->request->get('vmsid', null);
            if (is_null($vmsid) || empty($vmsid))
            {
                echo "not exists vmsid";
            } else {
                $Vms = new Vms();
                $type = Yii::$app->request->get('type', 'video');
                if ($type == 'audio'){
                    echo Json::encode(['play'=>$Vms->vmsAudioPlay($vmsid)]);
                } else {
                    echo Json::encode(['play'=>$Vms->vmsVideoPlay($vmsid)]);
                }
            }
            exit;
        }


        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                mkdir($root_path);
            }
        }

//根据path参数，设置各路径和URL
        $_path = Yii::$app->request->get('path', '');
        if (empty($_path)) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_path;
            $current_url = $root_url . $_path;
            $current_dir_path = $_path;
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
//echo realpath($root_path);
//排序形式，name or size or type
        $_order = Yii::$app->request->get('order', 'name');
        $order = strtolower($_order);

//不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            return Yii::$app->response->data =  'Access is not allowed.';
        }
//最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            return Yii::$app->response->data =   'Parameter is not valid.';
        }
//目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            return Yii::$app->response->data =   'Directory does not exist.';
        }

//遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

        //排序
        usort($file_list, function($a, $b) use($order){
            global $order;
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        });

        $result = array();
//相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
//相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
//当前目录的URL
        $result['current_url'] = $current_url;
//文件数
        $result['total_count'] = count($file_list);
//文件列表数组
        $result['file_list'] = $file_list;
//        var_dump($result);
        Yii::$app->response->data = $result;
    }
}