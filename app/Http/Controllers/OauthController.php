<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public $clientID;

    public $secret;

    public $response_type;

    public $redirect_uri;

    public $scope;

    public $state;

    public $oauthURI;

    public function __construct(){
        $this->clientID = "100017";
        $this->secret = "adminhappy";
        $this->response_type = "code";
        $this->state = "xyz";
        $this->scope = "everything";
        $this->redirect_uri = "http://127.0.0.1:8000/access";
        $this->oauthURI = "http://127.0.0.1:14000";
    }

    public function hpauthorize(){
        $oauthURL = $this->oauthURI."/authorize";
        $url = $oauthURL."?".\http_build_query($this->getAuthorizeParamsString());
        dd($url);
        $result = $this->curlGet($url);
        dd($result);
    }

    public function hpaccesToken(Request $request){
        $code = $request->get("code");
        $data["grant_type"] = "authorization_code";
        $data["client_id"] = $this->clientID;
        $data["client_secret"] = $this->secret;
        $data["state"] = "xyz";
        $data["redirect_uri"] = "http://127.0.0.1:8000/token";
        $data["code"] = $code;
        $oauthURL = $this->oauthURI."/token?".http_build_query($data);
        $result = $this->curlPost($oauthURL, $data);
        dd($result);
    }

    public function hpToekn(Request $request){

    }

    public function getAuthorizeParamsString(){
        $data = [
            "response_type" => $this->response_type,
            "client_id" => $this->clientID,
            "state" => $this->state,
            "scope" => $this->scope,
            "redirect_uri" => $this->redirect_uri,
        ];
        return $data;
    }

    function curlGet($url){
        $ch      = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result  = curl_exec($ch);
        $errorno = curl_errno($ch); //获取到错误信息
        curl_close($ch);

        if ($errorno)
            return json_encode(array('status'=>false,'msg'=>$errorno, 'code'=>400101));
        else
            return $result;
    }

    function curlPost($url, $data, $timeout=5, $method="POST"){
        $ch = curl_init();
        $header = ["Accept-Charset: utf-8"];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); //设置cURL允许执行的最长秒数
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        $errorno=curl_errno($ch);
        if ($errorno) {
            return json_encode(array('status'=>false,'msg'=>$errorno, 'code'=>400101));
        }else{
            return $tmpInfo;
        }
    }
}
