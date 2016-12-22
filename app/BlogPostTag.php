<?php

namespace App;

class BlogPostTag extends BaseModel {
    protected $fillable = array('post_id', 'tag_id');
}
