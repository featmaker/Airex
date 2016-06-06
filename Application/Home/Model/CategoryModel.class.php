<?php
namespace Home\Model;
use Think\Model;

/**
 * 分类控制器
 */

class CategoryModel extends Model {

	/**
	 * 获取所有分类
	 * @return [type] [description]
	 */
	public function getCategorys() {
		$cats = $this->getField('cat_name', true);
		return $cats;
	}

	public function addCategory(){

	}
}