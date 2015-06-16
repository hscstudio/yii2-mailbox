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
		$mailbox = ArrayHelper::remove($app->getModules()['mailbox'],'mailbox',[
			'class' => 'hscstudio\mailbox\Module',
		]);
		$app->setModule(
			'mailbox', $mailbox
		);
    }
}
