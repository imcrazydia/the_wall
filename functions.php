<?php

function addTagsToImage($tags, $image_id, $pdo){

}

function seperateTags($tags_str){
  $tags = explode(',', $tags_str);
  $tags = array_map(function($value){
    return trim(strtolower($value));
  }, $tags);
  return $tags;
}

 ?>
