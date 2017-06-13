<?php
/**
 * Created by http://www.kuaidi.com
 * User: kuaidi.com PHP team
 * Date: 2016-03-02
 * 物流信息查询接口SDK
 * QQ: 2885643506
 * Version 1.0
 */

class KuaidiAPI{
    
    private $_APPKEY = ''; 
    
    private $_APIURL = "http://highapi.kuaidi.com/openapi-querycountordernumber.html?";
    
    private $_show = 0;

    private $_muti = 0;

    private $_order = 'desc';
    
    /**
     * 您获得的快递网接口查询KEY。
     * @param string $key
     */
    public function KuaidiAPi($key){
        $this->_APPKEY = $key;
    }

    /**
     * 设置数据返回类型。0: 返回 json 字符串; 1:返回 xml 对象
     * @param number $show
     */
    public function setShow($show = 0){
        $this->_show = $show;
    }
    
    /**
     * 设置返回物流信息条目数, 0:返回多行完整的信息; 1:只返回一行信息
     * @param number $muti
     */
    public function setMuti($muti = 0){
        $this->_muti = $muti;
    }
    
    /**
     * 设置返回物流信息排序。desc:按时间由新到旧排列; asc:按时间由旧到新排列
     * @param string $order
     */
    public function setOrder($order = 'desc'){
        $this->_order = $order;
    }

    /**
     * 查询物流信息，传入单号，
     * @param 物流单号 $nu
     * @param 公司简码 $com 要查询的快递公司代码,不支持中文,具体请参考快递公司代码文档。
     * @throws Exception
     * @return array
     */
    public function query($nu, $com=''){
        if (function_exists('curl_init') == 1) {
            
            $url = $this->_APIURL;

            $dataArr = array(
                'id' => $this->_APPKEY,
                'com' => $com,
                'nu' => $nu,
                'show' => $this->_show,
                'muti' => $this->_muti,
                'order' => $this->_order
            );

            foreach ($dataArr as $key => $value) {
                $url .= $key . '=' . $value . "&";
            }

            // echo $url;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            $kuaidresult = curl_exec($curl);
            curl_close($curl);

            if($this->_show == 0){
                $result = json_decode($kuaidresult, true);
            }else{
                $result = $kuaidresult;
            }

            return $result;

        }else{
            throw new Exception("Please install curl plugin", 1); 
        }
    }

}
