<?php
/**
 * Created by PhpStorm.
 * User: ptr.nov
 * Date: 10/08/15
 * Time: 19:44
 */
namespace common\components;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\Component;
use Yii\base\Model;
use yii\data\ArrayDataProvider;

/** 
  * Components Template
  * @author ptrnov  <ptr.nov@gmail.com>
  * @since 1.1
*/
class Template extends Component{	
	
	/**
	 * TEMPLATE 1
	 * Example1 	: Yii::$app->getTemplate->Template('default')['LifeMenuHeader'];
	 * Author		: Piter Novian [ptr.nov@gmail.com].	Example usage
	*/	 
	public function Template($pilih){
		if (!Yii::$app->user->isGuest){
			$ary='';
			if ($pilih=='default'){
				//$ary['Navbar-Left']='background:-webkit-gradient(linear, 10% 100%, 10% 21%, from(#0436FA), to(#579AEF))';
				$ary['Navbar-Left']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Header']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Content']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Content-Item']='background-color: rgba(34, 118, 124, 1)';			
			}elseif($pilih=='template1'){
				//TEMPLATE1 = MERAH MAROON
				$ary['Navbar-Left']='background-color:rgba(212, 44, 44, 0.9)';
				$ary['LifeMenu-Header']='background-color:rgba(212, 44, 44, 0.9)';
				$ary['LifeMenu-Content']='background-color:rgba(212, 44, 44, 0.9)';		
				$ary['LifeMenu-Content-Item']='background-color:rgba(149, 41, 40, 1)';				
			}elseif($pilih=='template2'){
				//TEMPLATE2 = BIRU MUDA
				$ary['Navbar-Left']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Header']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Content']='background-color:rgba(26, 168, 191, 1)';
				$ary['LifeMenu-Content-Item']='background-color:rgba(34, 118, 124, 1)';
				
			}else{
				$ary['Navbar-Left']='background-color:#654321';
				$ary['LifeMenu-Header']='background-color:#1AA8BF';
				$ary['LifeMenu-Content']='background-color:rgba(212, 44, 44, 0.9)';
				$ary['LifeMenu-Content-Item']='background-color: rgba(90, 141, 185, 1)';
			}			
			return $ary;
		}		 
	}
	
	
}