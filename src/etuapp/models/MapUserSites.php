<?php

namespace etuapp\models;

class MapUserSites extends \Illuminate\Database\Eloquent\Model
{

	protected $table = 'map_user_sites';
	protected $primaryKey = 'id';
  	protected $fillable = array('id','id_user', 'id_site','views');
	public $timestamps = false;
}