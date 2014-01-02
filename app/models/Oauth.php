<?php

class Oauth extends Eloquent
{
    protected $guarded = array();
    public function user_id(){
        return $this->belongsTo('Users','id');
    }   

}
