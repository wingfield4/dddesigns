<?php

namespace App;

use Google\Cloud\Storage\StorageClient;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    public $BASE_IMAGE_PATH = 'https://storage.googleapis.com/dddesigns/';

    public function fullPathSignedURL()
    {
        $user = Auth::user();

        if($user->isAdmin())
        {
            $storage = new StorageClient();
            $bucket = $storage->bucket('dddesigns-private');
            $object = $bucket->object($this->full_path);
            $url = $object->signedUrl(
                # This URL is valid for 15 minutes
                new \DateTime('15 min'),
                [
                    'version' => 'v4',
                ]
            );
            return $url;
        }
        return null;
    }

    public function fullPathURL()
    {
        return $this->BASE_IMAGE_PATH . $this->full_path;
    }
}
