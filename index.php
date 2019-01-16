<?php
function binarySearch($filename, $needle){
  //создаем объект класса SplFileObject
    $file=new SplFileObject($filename);
    $file->seek(PHP_INT_MAX);
    //определяем колличесвто строк
    $last_item=$file->key() + 1;
    $first_item=0;
    //начинаем бинарный поиск
    while($first_item < $last_item){

         $middle=$first_item+floor((($last_item-$first_item)/2));
         //переводим файловый указатель на середину
         $file->seek($middle);
         //получаем текущую строку
         $current=$file->current();
         //разбиваем строку
         $current_item=explode("\t",$current);

          if($needle===$current_item[0]){

              return $current_item[1];

          }elseif (strnatcmp($needle,$current_item[0])===-1){

              $last_item=$middle;
          }else{

              $first_item=$middle+1;
          }
    }

    $file->seek($last_item);
    $current=$file->current();
    $current_item=explode("\t",$current);

    if($current_item===$needle){
         return $current_item[1];
    }else{
         return "undef";
    }

}

echo binarySearch("file.txt","key5");

