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
use Thelia\Core\Event\Hook\HookRenderEvent;
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

    public function onMainContentBottom(HookRenderEvent $event)
    {
        //$event->add($this->render('diaporama-load.html'));
    }

    public function onMainJsInit(HookRenderEvent $event)
    {
        $event->add($this->render('diaporama-load.html'));
    }

    public function onProductBottom(HookRenderEvent $event)
    {
        $this->renderJs($event, 'product');
    }

    public function onCategoryBottom(HookRenderEvent $event)
    {
        $this->renderJs($event, 'category');
    }

    public function onFolderBottom(HookRenderEvent $event)
    {
        $this->renderJs($event, 'folder');
    }

    public function onContentBottom(HookRenderEvent $event)
    {
        $this->renderJs($event, 'content');
    }

    public function onBrandBottom(HookRenderEvent $event)
    {
        $this->renderJs($event, 'brand');
    }

    protected function renderJs(HookRenderEvent $event, $entity)
    {
        $event->add("<script>var diaporama_entity_selector = '{$this->selectors[$entity]}';</script>");
    }

    protected $selectors = array(
        'product' => 'div#description',
        'category' => 'div.description',
        'folder' => 'div.folder-description',
        'content' => 'div.description',
        'brand' => 'div.description',
    );
}
