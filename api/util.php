<?PHP 
        function log_action($msg) {
		$today = date("d.m.Y");
		$filename = "log/$today.txt";
		if (!file_exists($filename)) {
			chmod($filename, 0777);
		}
		$fd = fopen($filename, "a");
		$str = "[" . date("d/m/Y h:i:s", mktime()) . "] " . $msg;
		fwrite($fd, $str . PHP_EOL);
		fclose($fd);
		chmod($filename, 0644);
	}
	 
	 
	 function contains($string,$substring) {
	        $pos = strpos($string, $substring);
	 
	        if($pos === false) {
	                // string needle NOT found in haystack
	                return false;
	        }
	        else {
	                // string needle found in haystack
	                return true;
	        }
	 
	}
	
	function rad($d)
 {
    return $d * 3.1415926535898 / 180.0;
 }
  function GetDistance($lat1, $lng1, $lat2, $lng2)
  {
      $EARTH_RADIUS = 6378.137;
      $radLat1 = rad($lat1);
      //echo $radLat1;
      $radLat2 = rad($lat2);
      $a = $radLat1 - $radLat2;
      $b = rad($lng1) - rad($lng2);
      $s = 2 * asin(sqrt(pow(sin($a/2),2) +
      cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
      $s = $s *$EARTH_RADIUS;
      $s = round($s * 10000) / 10000;
      return $s;
}

// select * from user where dj1&gt;(230-1.5) and dj1&lt;(230+1.5) and  dw1&gt;(230-1.5) and dw1&lt;(230+1.5)


function upload($file,$dir,$name)
{
	//本函数只接受gif、jpg、png 格式的文件，不能上传其他格式的文件，如果要上传其他类型的文件请自行更改
	//可以限定图片的体积和尺寸，不合要求的不能上传
	//本函数能自动识别文件的类型，改为gif、jpg、png 扩展名的“假图片”不能上传
	//只要是上述类型图片，本函数能够自动把文件的扩展名改为正确的扩展名
	//file 的实参为提交表单中file 类型输入框的名称。例：<input name="upfile" type="file"> 中的 upfile 注意：前面无"$"号
	//dir 为上传路径，默认为当前路径
	//name 为要改成的目标文件名，当为空字符串表示不改名。
	$max_size=512000; //500 KB 
	$max_w = 800; //最大宽度800像素
	$max_h = 600; //最大高度600像素
	$min_w = 400; //最小宽度400像素
	$min_h = 300; //最小高度300像素
	if($dir) //如果路径不是以"/"结尾则加上"/"
	{    if(substr($dir,-1)!="/") 
		$dir=$dir."/"; 
	}
	if($name=="")
	$name=$_FILES["$file"][name];
	$len=strrpos($name,"."); //取得主文件名长度
	if(!$len)
	$len=strlen($name);
	$name=substr($name,0,$len); //取得主文件名
	//添加扩展名
	if($_FILES["$file"][type]=="image/gif")
	$name=$name.".gif";
	if($_FILES["$file"][type]=="image/pjpeg")
	$name=$name.".jpg";
	if($_FILES["$file"][type]=="image/x-png")
	$name=$name.".png";

	//检查上传过程中是否出现错误
	if($_FILES["$file"][error]) //当发生错误时
	{
		if(($_FILES["$file"][error]==1)||($_FILES["$file"][error]==2)) 
		$info="您上传的文件太大了，超过了允许的范围！";
		if($_FILES["$file"][error] ==3)
		$info="上传过程中发生错误！文件只有部分被上传。";
		if($_FILES["$file"][error] ==4)
		$info="没有文件被上传。</font>";
		if($_FILES["$file"][error] ==5)
		$info="上传文件大小为零。";
	}
	else //当上传成功时
	{
		if(($_FILES["$file"][type]=="image/gif")||($_FILES["$file"][type]=="image/pjpeg")||($_FILES["$file"][type]=="image/x-png")) //是合法的文件类型时
		{
			if($_FILES["$file"][size]<=$max_size) //检查文件大小
			{
				$size=GetImageSize($_FILES["$file"][tmp_name]);
				 if(($size[0]<=$max_w)&&($size[0]>=$min_w)&&($size[1]<=$max_h)&&($size[1]>=$min_h)) //检查图片的长宽
				{
					//复制文件到指定位置。
					copy($_FILES["$file"][tmp_name],$dir.$name); //复制文件，并改名
					if(file_exists($dir.$name))  //检查是否上传成功
					$info=$dir.$name."上传成功！";
					else
					$info="复制文件过程中出现错误！上传失败！";
				}
				else //图片尺寸不合适时
				{
					$info="图片尺寸不合适宽度".$min_w."-".$max_w."像素，高度".$min_h."-".$max_h."像素。";
				}    
			}
			else //文件超出限制时
			{
				$info="文件大小超过了限制，最大为".($max_size/1024)." KB"; 
			}
		}
		else //文件类型非法时
		{
		$info="文件类型非法！限制为gif、jpg、png图片";
		} 
	}
	return $info;
}



?>