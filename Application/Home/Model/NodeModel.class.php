<?php 
namespace Home\Model;
use Think\Model;
use Home\Model\PublicModel;
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
		$nodes =$this->field('node_name')->order('hits desc')->limit(10)->select();
		return $nodes;
	}

	/**
	 * 获取全部节点
	 * @return [type] [description]
	 */
	public function getAllNodes(){
		$nodes = $this->field('id,node_name')->select();
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
			if (!nodeValidate($catName)) {
				return false;
			}
			$nodes = $this->field('node_name')
			              ->join('airex_category as c on c.id = pid')
			              ->where(array('cat_name' => $catName))
			              ->select();
			return $nodes;
		}
	}

	/**
	 * 获取节信息
	 * @param  [type] $node [description]
	 * @return [type]       [description]
	 */
	public function getNodeInfo($node){
		$data = $this->field('desc,logo_path,topic_num')
					 ->where(array('node_name'=>$node))
					 ->select()[0];
		return $data;
	}
}