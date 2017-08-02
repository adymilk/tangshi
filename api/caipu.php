<?php 

header('Content-type:text/html;charset=utf-8');
 
 
//配置您申请的appkey
$appkey = "36f3118cdb14ca80818496ea7025fb62";
 
 
 
 
//************1.菜谱大全************
$url = "http://apis.juhe.cn/cook/query.php";
$params = array(
      "menu" => "五花肉",//需要查询的菜谱名
      "key" => $appkey,//应用APPKEY(应用详细页查询)
      "dtype" => "",//返回数据的格式,xml或json，默认json
      "pn" => "",//数据返回起始下标
      "rn" => "10",//数据返回条数，最大30
      "albums" => "",//albums字段类型，1字符串，默认数组
);
$paramstring = http_build_query($params);
$content = juhecurl($url,$paramstring);
$result = json_decode($content,true);

//**************************************************
 
 
 
 
/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
 
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
  }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>新华字典</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src='../js/bootstrap.min.js'></script>
  <script type="text/javascript" src='../js/index.js'></script>
 </head>
 <body>
  <div class="container">
<div style="text-align: center;" id="logo">
  <a href="./index.php"><img></a>
</div>
  <h2 align="center">新华字典</h2>

      <form action="" method="get" style="text-align: center;">
      <div id="s">
        <input id="s_ipt" type="text" name="text" class="form-control btn-lg" placeholder="关键词（诗名/作者/古诗句）" style="display: inline; width: 70%;padding: 23px 5px; font-size: 1em" value="<?php echo $user_text; ?>">
        <input id="s_btn" type="submit" name="submit" value="搜索" class="btn btn-primary btn-lg" style="font-size: 1.4em"><br/>
      </div>
          

          <p id="sm-btn">
          <button type="button" class="btn btn-default" data-toggle='modal' data-target='#layer'>发布诗词</button><button class="btn btn-default">贡献翻译</button>
          </p>
      </form>
      <div class="col-sm-12" id="zidian">
      <?php 
        if (isset($_GET['submit'])&&!empty($_GET['submit'])) {
          if($result){
    if($result['error_code']=='0'){
      echo "<h2>菜品介绍</h2>";
      $data = $result['result']['data'][0];
      foreach ($data as $key => $value) {
              echo "<p>$data[$key]</p>";
      }
      echo "<h3>做法步骤</h3>";
          // print_r($data);
      $data = $result['result']['data'][0]['steps'];
      var_dump(count($data));
      $l = count($data);
      for ($i=0; $i < $l; $i++) { 
      $data = $result['result']['data'][0]['steps'][$i]['step'];
      echo "<p><b>$data</b></p>";
      $data = $result['result']['data'][0]['steps'][$i]['img'];
        echo "<img src='$data'>";
      
      }
          // print_r($data);
      
    }else{
        echo $result['error_code'].":".$result['reason'];
    }
}else{
    echo "请求失败";
}
      }
       ?>
       </div>
  </div>
 </body>
 </html>


