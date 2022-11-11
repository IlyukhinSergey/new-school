<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

/**
 * Class Message
 *
 * @package App\Model\Eloquent
 *
 * @property-read \App\Model\Eloquent\User @author
 */
class Message extends Model
{

    protected $table = 'message';

    public $timestamps = false;

    protected $fillable = [
      'text',
      'user_id',
      'created_at',
      'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function deleteMessage(int $idMessage)
    {
        $image = self::query()
          ->where('id', '=', $idMessage)
          ->first();
        if ($image->image) {
            self::deleteFile($image->image);
        }
        return self::destroy($idMessage);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::with('user')
          ->limit($limit)
          ->offset($offset)
          ->orderBy('id', 'DESC')
          ->get();
    }

    static function getUserMessages(int $userId, $limit)
    {
        return self::query()
          ->where('user_id', '=', $userId)
          ->limit($limit)
          ->get();
    }

    /**
     * @return \App\Model\Eloquent\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param  \App\Model\Eloquent\User  $user
     */
    public function setUser(\App\Model\Eloquent\User $user): void
    {
        $this->user = $user;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->getFileName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    public static function deleteFile($file)
    {
        if (file_exists(getcwd() . '/images/' . $file)) {
            unlink(getcwd() . '/images/' . $file);
        }
    }

    private function getFileName()
    {
        return sha1(microtime() . mt_rand(1, 9999999)) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
          'id' => $this->id,
          'text' => $this->text,
          'created_at' => $this->createdAt,
          'user_id' => $this->userId,
          'image' => $this->image,
        ];
    }

}