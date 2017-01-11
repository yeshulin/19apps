<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/29
 * Time: 16:49
 */

namespace common\components;

use Yii;
use yii\httpclient\Client;

class Vms
{
    public $vmsPath;
    public $vmsToken;

    public $get = 0; // 数据获取方式  0 curl 1 file_get_contents

    public function __construct()
    {
        $this->vmsPath = Yii::$app->params['vms_path'];
        $this->vmsToken = Yii::$app->params['vms_token'];
    }

    /**
     * 获取ＶＭＳ视频信息列表
     * @param array $config
     * @return mixed|string
     */
    public function getVideoList($config = [
        'catalogStyle'=>0,
        'catalogPath'=>7,
        'getAllData'=>1
    ])
    {
        return $this->getVmsContent('getVideoList', 'json', $config);
    }

    /**
     * 获取ＶＭＳ音频信息列表
     * @param array $config
     * @return mixed|string
     */
    public function getAudioList($config = [
        'catalogStyle'=>0,
        'catalogPath'=>7,
        'getAllData'=>1
    ])
    {
        return $this->getVmsContent('getAudioList', 'json', $config);
    }

    /**
     * 获取ＶＭＳ栏目信息列表
     * @param array $config
     * @return mixed|string
     */
    public function getCatalogList($config = [
        'catalogStyle'=>0,
        'catalogPath'=>7,
        'getAllData'=>1,
    ])
    {
        $CatalogList = $this->getVmsContent('getCatalogList', 'json', $config);
        return $this->_VmsCatalog($CatalogList);
    }

    private function _VmsCatalog($CatalogList, $parent = 0)
    {
        static $result = [];
        foreach ($CatalogList as $k => $v)
        {
            if ($v['parentId'] == $parent) {
                $result[$v['catalogId']] = '├'.str_repeat('－', $v['treeLevel']*2) .$v['name'];
                $this->_VmsCatalog($CatalogList, $v['catalogId']);
            }
        }
        return $result;
    }

    /**
     * VMS音频播放
     * @param $vmsid
     * @return mixed
     */
    public function vmsAudioPlay($vmsid)
    {
        $data = $this->vmsAudioInfo($vmsid);
        return $vms_video = str_replace(array('<![CDATA[', ']]>'), '', $data['audio'][0]['playerCodeList'][0]['playerCode']);
    }

    /**
     * 获取VMS音频信息
     * @param $vmsid
     * @return mixed|string
     */
    public function vmsAudioInfo($vmsid)
    {
        return $this->getVmsContent('getAudioById', 'json', ['audioId'=>$vmsid]);
    }


    /**
     * VMS视频播放
     * @param $vmsid
     * @return mixed
     */
    public function vmsVideoPlay($vmsid)
    {
        $data = $this->vmsVideoInfo($vmsid);
        return $vms_video = str_replace(array('<![CDATA[', ']]>'), '', $data['video'][0]['playerCodeList'][0]['playerCode']);
    }

    /**
     * 获取VMS视频信息
     * @param $vmsid
     * @return mixed|string
     */
    public function vmsVideoInfo($vmsid)
    {
        return $this->getVmsContent('getVideoById', 'json', ['videoId'=>$vmsid]);
    }

    /**
     * 获取VMS内容
     * @param string $method
     * @param string $dataType
     * @param array $config
     * @return mixed|string
     */
    protected function getVmsContent($method = 'getVideoList', $dataType = 'json', $config = [])
    {
        if ($this->get == 1)
        {
            $url = $this->vmsPath.'?method='.$method.'&partnerToken='.$this->vmsToken.'&dataType='.$dataType;
            if (!empty($config))
            {
                foreach ($config as $k => $v)
                {
                    $url = $url."&$k=".urlencode( $v );
                }
            }
            $data = file_get_contents($url);
            if ($dataType == 'json')
            {
                $data = json_decode($data, true);
            }
        }
        else {
            $sconfig = [
                'method'=>$method,
                'partnerToken'=>$this->vmsToken,
                'dataType'=>$dataType,
            ];
            if (!empty($config))
            {
                $sconfig = array_merge($sconfig, $config);
            }
            $data = $this->curl($this->vmsPath, $sconfig);
        }

        return $data;
    }

    /**
     * 模拟POST请求
     * @param $url
     * @return mixed
     */
    protected function curl($url, $config = [])
    {
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl( $url )
            ->setData($config)
            ->send();
        if ($response->isOk) {
            return $response->data;
        }
        return [];
//        $ch = curl_init();//初始化curl
//        curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
//        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
//        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
//        curl_setopt($ch, CURLOPT_POSTFIELDS);
//        $data = curl_exec($ch);//运行curl
//        curl_close($ch);
//        return $data;
    }
}