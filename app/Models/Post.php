<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['title', 'content'];

    public function createPost($data)
    {
        return $this->create($data);
    }

    public function getList()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function getPostById($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    public function updatePost($data)
    {
        return $this->where($this->primaryKey, $data['id'])->update([
            'title' => $data['title'],
            'content' => $data['content']
        ]);
    }

    public function deletePost($id)
    {
        return $this->where($this->primaryKey, $id)->delete();
    }
}
