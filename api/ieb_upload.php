<?php
class ieb_upload
{
    var $FormName; //文件域名称
    var $Directroy; //上传至目录
    var $MaxSize; //最大上传大小
    var $CanUpload; //是否可以上传
    var $doUpFile; //上传的文件名
    var $sm_File; //缩略图名称
    var $Error; //错误参数
    
    function ieb_upload($formName = '', $dirPath = '', $maxSize = 2097152) // (1024*2)*1024=2097152 就是 2M
    {
        global $FormName, $Directroy, $MaxSize, $CanUpload, $Error, $doUpFile, $sm_File;
        // 初始化各种参数
        $FormName = $formName;
        $MaxSize = $maxSize;
        $CanUpload = true;
        $doUpFile = '';
        $sm_File = '';
        $Error = 0;

        if ($formName == '')
        {
            $CanUpload = false;
            $Error = 1;
            break;
        }

        if ($dirPath == '')
            $Directroy = $dirPath;
        else
            $Directroy = $dirPath.'/';
    }
    // 检查文件是否存在
    function scanFile()
    {
        global $FormName, $Error, $CanUpload;

        if ($CanUpload)
        {
            $scan = is_readable($_FILES[$FormName]['name']);

            if ($scan)
                $Error = 2;

            return $scan;
        }
    }
    // 获取文件大小
    function getSize($format = 'B')
    {
        global $FormName, $Error, $CanUpload;

        if ($CanUpload)
        {
            if ($_FILES[$FormName]['size'] == 0)
            {
                $Error = 3;
                $CanUpload = false;
            }

            switch ($format)
            {
                case 'B':
                    return $_FILES[$FormName]['size'];
                    break;

                case 'K':
                    return ($_FILES[$FormName]['size']) / (1024);
                    break;

                case 'M':
                    return ($_FILES[$FormName]['size']) / (1024 * 1024);
                    break;
            }
        }
    }
    // 获取文件类型
    function getExt()
    {
        global $FormName, $Error, $CanUpload;

        if ($CanUpload)
        {
            $ext = $_FILES[$FormName]['name'];
            $extStr = explode('.', $ext);
            $count = count($extStr)-1;
        }
        return $extStr[$count];
    }
    // 获取文件名称
    function getName()
    {
        global $FormName, $CanUpload;

        if ($CanUpload)
            return $_FILES[$FormName]['name'];
    }
    // 新建文件名
    function newName()
    {
        global $CanUpload, $FormName;

        if ($CanUpload)
        {
            $FullName = $_FILES[$FormName]['name'];
            $extStr = explode('.', $FullName);
            $count = count($extStr)-1;
            $ext = $extStr[$count];

            return date('YmdHis').rand(0, 9).'.'.$ext;
        }
    }
    // 上传文件
    function upload($fileName = '')
    {
        global $FormName, $Directroy, $CanUpload, $Error, $doUpFile;

        if ($CanUpload)
        {
            if ($_FILES[$FormName]['size'] == 0)
            {
                $Error = 3;
                $CanUpload = false;
                return $Error;
                break;
            }
        }

        if ($CanUpload)
        {
            if ($fileName == '')
                $fileName = $_FILES[$FormName]['name'];

            $doUpload = @copy($_FILES[$FormName]['tmp_name'], $Directroy.$fileName);

            if ($doUpload)
            {
                $doUpFile = $fileName;
                chmod($Directroy.$fileName, 0777);
                return true;
            }
            else
            {
                $Error = 4;
                return $Error;
            }
        }
    }
    // 创建图片缩略图
    function thumb($dscChar = '', $width = 150, $height = 113)
    {
        global $CanUpload, $Error, $Directroy, $doUpFile, $sm_File;

        if ($CanUpload && $doUpFile != '')
        {
            $srcFile = $doUpFile;

            if ($dscChar == '')
                $dscChar = 'sm_';

            $dscFile = $Directroy.$dscChar.$srcFile;
            $data = getimagesize($Directroy.$srcFile, &$info);

            switch ($data[2])
            {
                case 1:
                    $im = @imagecreatefromgif($Directroy.$srcFile);
                    break;

                case 2:
                    $im = @imagecreatefromjpeg($Directroy.$srcFile);
                    break;

                case 3:
                    $im = @imagecreatefrompng($Directroy.$srcFile);
                    break;
            }

            $srcW = imagesx($im);
            $srcH = imagesy($im);
            $ni = imagecreatetruecolor($width, $height);
            imagecopyresized($ni, $im, 0, 0, 0, 0, $width, $height, $srcW, $srcH);
            $cr = imagejpeg($ni, $dscFile);
            chmod($dscFile, 0777);

            if ($cr)
            {
                $sm_File = $dscFile;
                return true;
            }
            else
            {
                $Error = 5;
                return $Error;
            }
        }
    }
    // 显示错误参数
    function Err()
    {
        global $Error;
        return $Error;
    }
    // 上传后的文件名
    function UpFile()
    {
        global $doUpFile, $Error;
        if ($doUpFile != '')
            return $doUpFile;
        else
            $Error = 6;
    }
    // 上传文件的路径
    function filePath()
    {
        global $Directroy, $doUpFile, $Error;
        if ($doUpFile != '')
            return $Directroy.$doUpFile;
        else
            $Error = 6;
    }
    // 缩略图文件名称
    function thumbMap()
    {
        global $sm_File, $Error;
        if ($sm_File != '')
            return $sm_File;
        else
            $Error = 6;
    }
    // 显示版本信息
    function ieb_version()
    {
        return 'IEB_UPLOAD CLASS Ver 1.1';
    }
}

?>
