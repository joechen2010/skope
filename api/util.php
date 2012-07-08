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
	//������ֻ����gif��jpg��png ��ʽ���ļ��������ϴ�������ʽ���ļ������Ҫ�ϴ��������͵��ļ������и���
	//�����޶�ͼƬ������ͳߴ磬����Ҫ��Ĳ����ϴ�
	//���������Զ�ʶ���ļ������ͣ���Ϊgif��jpg��png ��չ���ġ���ͼƬ�������ϴ�
	//ֻҪ����������ͼƬ���������ܹ��Զ����ļ�����չ����Ϊ��ȷ����չ��
	//file ��ʵ��Ϊ�ύ����file �������������ơ�����<input name="upfile" type="file"> �е� upfile ע�⣺ǰ����"$"��
	//dir Ϊ�ϴ�·����Ĭ��Ϊ��ǰ·��
	//name ΪҪ�ĳɵ�Ŀ���ļ�������Ϊ���ַ�����ʾ��������
	$max_size=512000; //500 KB 
	$max_w = 800; //�����800����
	$max_h = 600; //���߶�600����
	$min_w = 400; //��С���400����
	$min_h = 300; //��С�߶�300����
	if($dir) //���·��������"/"��β�����"/"
	{    if(substr($dir,-1)!="/") 
		$dir=$dir."/"; 
	}
	if($name=="")
	$name=$_FILES["$file"][name];
	$len=strrpos($name,"."); //ȡ�����ļ�������
	if(!$len)
	$len=strlen($name);
	$name=substr($name,0,$len); //ȡ�����ļ���
	//�����չ��
	if($_FILES["$file"][type]=="image/gif")
	$name=$name.".gif";
	if($_FILES["$file"][type]=="image/pjpeg")
	$name=$name.".jpg";
	if($_FILES["$file"][type]=="image/x-png")
	$name=$name.".png";

	//����ϴ��������Ƿ���ִ���
	if($_FILES["$file"][error]) //����������ʱ
	{
		if(($_FILES["$file"][error]==1)||($_FILES["$file"][error]==2)) 
		$info="���ϴ����ļ�̫���ˣ�����������ķ�Χ��";
		if($_FILES["$file"][error] ==3)
		$info="�ϴ������з��������ļ�ֻ�в��ֱ��ϴ���";
		if($_FILES["$file"][error] ==4)
		$info="û���ļ����ϴ���</font>";
		if($_FILES["$file"][error] ==5)
		$info="�ϴ��ļ���СΪ�㡣";
	}
	else //���ϴ��ɹ�ʱ
	{
		if(($_FILES["$file"][type]=="image/gif")||($_FILES["$file"][type]=="image/pjpeg")||($_FILES["$file"][type]=="image/x-png")) //�ǺϷ����ļ�����ʱ
		{
			if($_FILES["$file"][size]<=$max_size) //����ļ���С
			{
				$size=GetImageSize($_FILES["$file"][tmp_name]);
				 if(($size[0]<=$max_w)&&($size[0]>=$min_w)&&($size[1]<=$max_h)&&($size[1]>=$min_h)) //���ͼƬ�ĳ���
				{
					//�����ļ���ָ��λ�á�
					copy($_FILES["$file"][tmp_name],$dir.$name); //�����ļ���������
					if(file_exists($dir.$name))  //����Ƿ��ϴ��ɹ�
					$info=$dir.$name."�ϴ��ɹ���";
					else
					$info="�����ļ������г��ִ����ϴ�ʧ�ܣ�";
				}
				else //ͼƬ�ߴ粻����ʱ
				{
					$info="ͼƬ�ߴ粻���ʿ��".$min_w."-".$max_w."���أ��߶�".$min_h."-".$max_h."���ء�";
				}    
			}
			else //�ļ���������ʱ
			{
				$info="�ļ���С���������ƣ����Ϊ".($max_size/1024)." KB"; 
			}
		}
		else //�ļ����ͷǷ�ʱ
		{
		$info="�ļ����ͷǷ�������Ϊgif��jpg��pngͼƬ";
		} 
	}
	return $info;
}



?>