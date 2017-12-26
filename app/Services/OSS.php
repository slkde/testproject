<?php
namespace App\Services;
use JohnLui\AliyunOSS\AliyunOSS;
class OSS  
{
    private $ossClient;
    private static $bucketName;
    public function __construct($isInternal = false)
    {
        $serverAddress = $isInternal ? config('alioss.ossServerInternal') : config('alioss.ossServer');
        $this->ossClient = AliyunOSS::boot(
            $serverAddress,
            config('alioss.AccessKeyId'),
            config('alioss.AccessKeySecret')
        );
    }
    public static function upload($ossKey, $filePath)
    {
        $oss = new OSS(false); // �ϴ��ļ�ʹ����������������
        $oss->ossClient->setBucket(config('alioss.BucketName'));
        $res = $oss->ossClient->uploadFile($ossKey, $filePath);
        return $res;
    }
    /**
     * ֱ�Ӱѱ��������ϴ���oss
     * @param $osskey
     * @param $content
     */
    public static function uploadContent($osskey, $content)
    {
        $oss = new OSS(false); // �ϴ��ļ�ʹ����������������
        $oss->ossClient->setBucket(config('alioss.BucketName'));
        $oss->ossClient->uploadContent($osskey, $content);
    }
    /**
     * ɾ���洢��oss�е��ļ�
     *
     * @param string $ossKey �洢��key���ļ�·�����ļ�����
     * @return
     */
    public static function deleteObject($ossKey)
    {
        $oss = new OSS(false); // �ϴ��ļ�ʹ����������������
        return $oss->ossClient->deleteObject(config('alioss.BucketName'), $ossKey);
    }
    /**
     * ���ƴ洢�ڰ�����OSS�е�Object
     *
     * @param string $sourceBuckt ���Ƶ�ԴBucket
     * @param string $sourceKey - ���Ƶĵ�ԴObject��Key
     * @param string $destBucket - ���Ƶ�Ŀ��Bucket
     * @param string $destKey - ���Ƶ�Ŀ��Object��Key
     * @return Models\CopyObjectResult
     */
    public function copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        $oss = new OSS(true); // �ϴ��ļ�ʹ����������������
        return $oss->ossClient->copyObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
    }
    /**
     * �ƶ��洢�ڰ�����OSS�е�Object
     *
     * @param string $sourceBuckt ���Ƶ�ԴBucket
     * @param string $sourceKey - ���Ƶĵ�ԴObject��Key
     * @param string $destBucket - ���Ƶ�Ŀ��Bucket
     * @param string $destKey - ���Ƶ�Ŀ��Object��Key
     * @return Models\CopyObjectResult
     */
    public function moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey)
    {
        $oss = new OSS(true); // �ϴ��ļ�ʹ����������������
        return $oss->ossClient->moveObject($sourceBuckt, $sourceKey, $destBucket, $destKey);
    }
    public static function getUrl($ossKey)
    {
        $oss = new OSS();
        $oss->ossClient->setBucket(config('alioss.BucketName'));
        return $oss->ossClient->getUrl($ossKey, new \DateTime("+1 day"));
    }
    public static function createBucket($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->createBucket($bucketName);
    }
    public static function getAllObjectKey($bucketName)
    {
        $oss = new OSS();
        return $oss->ossClient->getAllObjectKey($bucketName);
    }
    /**
     * ��ȡָ��Object��Ԫ��Ϣ
     *
     * @param  string $bucketName ԴBucket����
     * @param  string $key �洢��key���ļ�·�����ļ�����
     * @return object Ԫ��Ϣ
     */
    public static function getObjectMeta($bucketName, $osskey)
    {
        $oss = new OSS();
        return $oss->ossClient->getObjectMeta($bucketName, $osskey);
    }
}