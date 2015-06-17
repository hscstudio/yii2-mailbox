<?php
namespace hscstudio\mailbox;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of Bootstrap
 *
 * @author Hafid Mukhlasin
 */
class Bootstrap implements \yii\base\BootstrapInterface
{	
    public function init()
    {
        parent::init();
    }

    /**
     * 
     * @param \yii\web\Application $app
     */
    public function bootstrap($app)
    {	
		$mailbox = ArrayHelper::merge(
			$app->getModules()['mailbox'],
			[
				'class' => 'hscstudio\mailbox\Module',		
			]
		);
		
		$app->setModule(
			'mailbox', $mailbox
		);

		if (!empty($app->getModules()['mailbox']['view'])){
			$view = $app->getView();
			$pathMap=[];		
			$pathMap['@hscstudio/mailbox/views/default'] = $app->getModules()['mailbox']['view'];		
			if (!empty($pathMap)) {
				$view->theme = Yii::createObject([
					'class' => 'yii\base\Theme',
					'pathMap' => $pathMap
				]);
			}
		}		
    }
}
