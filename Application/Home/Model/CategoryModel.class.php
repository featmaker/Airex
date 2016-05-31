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

	/**
	 * 根据分类名获取节点
	 * @param  [type] $catName [description]
	 * @return [type]          [description]
	 */
	public function getNodeByCatName($catName = '') {
		if ($catName == '') {
			$catId = $this->getField('id');
			$nodes = M('node')->where(array('pid' => $catId))
							  ->field('node_name')
							  ->select();
			return $nodes;
		}else {
			$nodes = $this->field('node_name')
			              ->join('airex_node as n on n.pid = airex_category.id')
			              ->where(array('cat_name' => $catName))
			              ->select();
			return $nodes;
		}
	}

	/**
	 * 根据分类获取相应主题
	 * @param  [type] $cat [description]
	 * @return [type]      [description]
	 */
	public function getTopicsByCat($catName = ''){
		if ($catName == '') {
			$catName = '技术';
		}
		$topics =$this->where(array('cat_name'=>$catName))
							   ->join('left join airex_topic as t on t.category_id = airex_category.id')
							   ->join('left join airex_user as u on u.id = t.uid')
							   ->join('left join airex_node as n on n.id = t.node_id')
							   ->field('publish_time,title,imgpath,comments,user_name,n.node_name,t.id as tid')
							   ->select();

		return $topics;
	}
}