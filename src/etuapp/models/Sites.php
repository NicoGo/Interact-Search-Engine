<?php

namespace etuapp\models;

class Sites extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'sites';
	protected $primaryKey = 'id';
  	protected $fillable = array('id','name', 'server_name','url_dev','url_prod','views_all');
	public $timestamps = false;
}