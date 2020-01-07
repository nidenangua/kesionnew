<?php
// +----------------------------------------------------------------------
// | 科汛教育微门户
// +----------------------------------------------------------------------
// | Copyright (C) 2017-2019 kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------


namespace Kesion\Model\App;
use Kesion\Model;
class FileModel extends Model
{
    public $error;
    public $wxid;
    public $cache;

    public function __construct()
    {
       $this->wxid = $GLOBALS['_DoM']['wxid'];
       $this->cache = new \Core\Cache();
    }

    /**通过文件ID同步删除oss
     * @param $fileid int 文件ID
     */
    public function delByFileId($fileid)
    {
        $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
        $tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
        $files         = M($tablename);
        $baiduname     = $files->getOne('baiduname','where id='.$fileid.' limit 1');
        $res = $files->delete('id='.$fileid);
        if ($res){
            $aliOss               = new \Core\Upload(array(),'Oss',array());
            $Data001['function']  = 'deleteObject';
            $Data001['baiduname'] = $baiduname;
            $aliOss->aliOss($Data001);
        }
    }

    
}