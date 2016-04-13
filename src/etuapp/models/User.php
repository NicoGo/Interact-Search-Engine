<?php

namespace etuapp\models;

class User extends \Illuminate\Database\Eloquent\Model
{

	protected $table = 'user';
	protected $primaryKey = 'id';
  	protected $fillable = array('id','login', 'pass');
	public $timestamps = false;
}