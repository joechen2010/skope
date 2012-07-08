<?php 
// 加载上传类
// include('ieb_upload.inc');
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>无标题文档</title>
</head>

<body style="font-size:12px;">
<form action="" method="post" enctype="multipart/form-data" name="form1">
<input type="file" name="file">
<input type="submit" name="Submit" value="提交">
<input name="scan" type="hidden" id="up" value="true">
</form><b /><br/>

<?php
if (isset($_REQUEST['scan']))
{
    // 声明一个上传类
    $upfos = new ieb_upload('file', 'tmp');

    /**
     * ieb_upload( FormName, [Directroy, MaxSize])
     * 
     * 　 FormName: 文件域的名称，这个例子里用的是 file 。这个参数不能省略。
     * 　 Directroy: 保存上传文件的目录名称。此参数如果省略，文件将上传至该处理页目录中。
     * 　 MaxSize: 允许上传的文件的大小限制。默认值为 2097152 byte (即 2M)。
     */
    // 返回将要上传的文件名称
    echo '文件名称：'.$upfos->getName().'<br/>';
    // 返回文件后缀名
    echo '文件类型：'.$upfos->getExt().'<br/>';
    // 返回文件大小
    echo '文件大小：'.$upfos->getSize().'<br/>';

    /**
     * getSize( format )
     * 
     * 　 format: 返回文件大小的单位值。默认值为 B。
     * 　 B 为 byte
     * 　 M 为 MB
     * 　 例：getSize( 'B' );
     */
    // 随机生成的文件名
    echo '随机文件：'.$upfos->newName().'<br/>';

    /**
     * 建议使用随机生成的文件名，以避免上传重名的文件。
     * 例如： $upfos->upload ( $upfos->newName());
     */
    // 上传文件
    $upfos->upload();

    /**
     * upload( filename )
     * 
     * 　 filename: 上传至服务器后生成这个文件名。默认值为原来的文件名。
     */
    // 生成缩略图
    $upfos->thumb();

    /**
     * thumb( [key, width, height] )
     * 
     * 　 key: 生成缩略图的关键字。默认值为"sm_"。如果上传的文件名为 12345.jpg，缩略图的文件名就为 sm_12345.jpg。
     * 　 width: 缩略图的宽度。默认值为 150 。
     * 　 height: 缩略图的高度。默认值为 113。
     * 　 例：$upfos->thumb ( 'slt_', 200, 140);
     */
    // 返回生成的文件名
    echo '生成文件：'.$upfos->UpFile().'<br/>';
    // 返回文件的路径
    echo '文件路径：'.$upfos->filePath().'<br/>';
    // 返回缩略图的名称
    echo '缩略图片：'.$upfos->thumbMap().'<br/>';
    // 返回上传类版本信息
    echo '版本信息：'.$upfos->ieb_version().'<br/>';
}
?>
</body>
</html>
