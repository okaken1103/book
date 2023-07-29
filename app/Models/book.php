<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        // 'image' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'page' => 'required',
        'satisfaction' => 'required',
        'genre' => 'required',
        'shortstory' => 'required',
        'quote' => 'required',
        );

    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
}