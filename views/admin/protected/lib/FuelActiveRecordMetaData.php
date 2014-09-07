<?php

class FuelActiveRecordMetaData extends CActiveRecordMetaData {
  /**
   * 
   * @param ContentAR $model
   */
  public function __construct($model) {
    parent::__construct($model);
    
    $fields = $model->getFields();
    
    $fieldAr = new FieldAR();
    $fieldColumns = $fieldAr->getMetaData()->columns;
    foreach ($fields as $field) {
      $column = $fieldColumns["field_content"];
      $column->name = $field;
      $column->rawName = $field;
      $this->columns[$field] = $column;
    }
  }
}

