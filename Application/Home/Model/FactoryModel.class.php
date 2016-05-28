<?php 
namespace Home\Model;

/**
* 工厂模型
*/
class FactoryModel
{
	private static $indexModel;		//Index模型
	private static $userModel;		//User模型
	private static $topicModel;		//Topic模型
	private static $categoryModel;

	static function createIndexModel(){
		if (!self::$indexModel) {
			self::$indexModel = new \Home\Model\IndexModel();
		}
		return self::$indexModel;
	}

	static function createUserModel(){
		if (!self::$userModel) {
			self::$userModel = new \Home\Model\UserModel();
		}
		return self::$userModel;
	}

	static function createTopicModel(){
		if (!self::$topicModel) {
			self::$topicModel = new \Home\Model\TopicModel();
		}
		return self::$topicModel;
	}

	static function createCategoryModel(){
		if (!self::$categoryModel) {
			self::$categoryModel = new \Home\Model\CategoryModel();
		}
		return self::$categoryModel;
	}
}
