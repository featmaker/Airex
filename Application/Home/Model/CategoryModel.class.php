<?php 
namespace Home\Model;
use Think\Model;

/**
* 分类控制器
*/
class CategoryModel extends Model
{
	//获取全部分类
	public function allCategorys(){
		$cats = $this->getField('cat_name',true);
		return $cats;
	}

	//更加分类查找节点
	public function getNodeByCatName($catName = null){
		if ($catName == null) {
			$catId = $this->getField('id');
			$nodes = M('node')->where(array('pid'=>$catId))->getField('node_name',true);
			return $nodes;
		}else{
			$nodes = $this->getField('node_name',true)
						  ->join('airex_category as c on c.id = airex_node.pid')
						  ->where(array('cat_name'=>$catName));
			return $nodes;
		}
	}

	public function allNodes(){
		
	}
}