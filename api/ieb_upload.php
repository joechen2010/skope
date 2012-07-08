<?php
class ieb_upload
{
    var $FormName; //�ļ�������
    var $Directroy; //�ϴ���Ŀ¼
    var $MaxSize; //����ϴ���С
    var $CanUpload; //�Ƿ�����ϴ�
    var $doUpFile; //�ϴ����ļ���
    var $sm_File; //����ͼ����
    var $Error; //�������
    
    function ieb_upload($formName = '', $dirPath = '', $maxSize = 2097152) // (1024*2)*1024=2097152 ���� 2M
    {
        global $FormName, $Directroy, $MaxSize, $CanUpload, $Error, $doUpFile, $sm_File;
        // ��ʼ�����ֲ���
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
    // ����ļ��Ƿ����
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
    // ��ȡ�ļ���С
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
    // ��ȡ�ļ�����
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
    // ��ȡ�ļ�����
    function getName()
    {
        global $FormName, $CanUpload;

        if ($CanUpload)
            return $_FILES[$FormName]['name'];
    }
    // �½��ļ���
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
    // �ϴ��ļ�
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
    // ����ͼƬ����ͼ
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
    // ��ʾ�������
    function Err()
    {
        global $Error;
        return $Error;
    }
    // �ϴ�����ļ���
    function UpFile()
    {
        global $doUpFile, $Error;
        if ($doUpFile != '')
            return $doUpFile;
        else
            $Error = 6;
    }
    // �ϴ��ļ���·��
    function filePath()
    {
        global $Directroy, $doUpFile, $Error;
        if ($doUpFile != '')
            return $Directroy.$doUpFile;
        else
            $Error = 6;
    }
    // ����ͼ�ļ�����
    function thumbMap()
    {
        global $sm_File, $Error;
        if ($sm_File != '')
            return $sm_File;
        else
            $Error = 6;
    }
    // ��ʾ�汾��Ϣ
    function ieb_version()
    {
        return 'IEB_UPLOAD CLASS Ver 1.1';
    }
}

?>
