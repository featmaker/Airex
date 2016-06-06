<?php 
namespace Home\Model;
use Think\Model;
/**
* 节点模型
*/
class NodeModel extends Model
{
	/**
	 * 获取最热节点
	 * @return [type] [description]
	 */
	public function getHotNodes(){
		$nodes = M('node')->field('node_name')->order('hits desc')->limit(10)->select();
		return $nodes;
	}

	/**
	 * 根据分类名获取节点
	 * @param  [type] $catName [description]
	 * @return [type]          [description]
	 */
	public function getNodeByCatName($catName = '') {
		if ($catName == '') {
			$catId = $this->getField('id');
			$nodes = $this->where(array('pid' => $catId))
							  ->field('node_name')
							  ->select();
			return $nodes;
		}else {
			$nodes = $this->field('node_name')
			              ->join('airex_category as c on c.id = pid')
			              ->where(array('cat_name' => $catName))
			              ->select();
			return $nodes;
		}
	}
}