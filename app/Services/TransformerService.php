<?php
  namespace App\Services;

  abstract class TransFormerService{
    public function transformCollection($items, $options = null){
      $data = [];

      foreach($items as $item){
        $payload = $this->transform($item, $options);
        if($payload){
          $data[] = $payload;
        }
      }
      return $data;
    }

    public abstract function transform($item);
  }