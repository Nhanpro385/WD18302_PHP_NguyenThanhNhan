<?php

namespace App\Models;
//Interface bản thiết kế cho method
interface CrudInterface {
  /**
   * @return array $record;
   */
public function getAll();

/**
 * 
 * @param int $id định danh tìm kiếm
 *@return  
 */

public function getOne(int $id);
/**/
public function create(array $data);
/*

xóa 1 dòng dữ liệu cho bảng
@param int $id định danh của dữ liệu
*/
public function deleteOne(int $id);

/**
 * 
 * @param array $data dữ liêuj mới
 * @param int $id định danh dữ liệu cần sửa
 */
public function updateOne(int $id,array $data);


}