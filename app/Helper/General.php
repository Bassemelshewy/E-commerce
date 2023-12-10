<?php

function upload_image($folder, $image){
    $image_name = time() . '.' . $image->getClientOriginalExtension();
    $image->move('uploads/'.$folder, $image_name);
    return $image_name;
}
