<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * Class User
     *
     * @package App\Model\Eloquent
     *
     * @property-read $id
     * @property-read $name
     * @property-read $email
     * @property-read $password
     */

    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
      'name',
      'email',
      'password',
      'created_at',
    ];

    public static function getByEmail(string $email)
    {
        return self::query()->where('email', '=', $email)->first();
    }

    public static function getById(int $id)
    {
        return self::query()->first()->find($id);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::query()
          ->limit($limit)
          ->offset($offset)
          ->orderBy('id', 'DESC')
          ->get();
    }


    public static function getPasswordHash(string $password)
    {
        return sha1('ghghhgg' . $password);
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }

}