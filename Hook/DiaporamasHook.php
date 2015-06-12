<?php
/**
 * Created by PhpStorm.
 * User: ducher
 * Date: 12/06/15
 * Time: 15:58
 */

namespace Diaporamas\Hook;

use Diaporamas\Diaporamas;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Translation\Translator;
use Thelia\Tools\URL;

class DiaporamasHook extends BaseHook
{
    public function onMainTopMenuTools(HookRenderBlockEvent $event)
    {
        $event->add(array(
            'url' => URL::getInstance()->absoluteUrl('/admin/module/Diaporamas/diaporama'),
            'title' => Translator::getInstance()->trans('diaporama.menu_title', array(), Diaporamas::BO_MESSAGE_DOMAIN)
        ));
    }
}
