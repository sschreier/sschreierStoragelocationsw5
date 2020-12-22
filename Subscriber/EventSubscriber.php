<?php
  namespace sschreierStoragelocationsw5\Subscriber;

  use Enlight\Event\SubscriberInterface;
  use Psr\Container\ContainerInterface;

  class EventSubscriber implements SubscriberInterface {
    private $pluginDirectory;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct($pluginName, $pluginDirectory, ContainerInterface $container){
      $this->pluginDirectory = $pluginDirectory;
      $this->container = $container;
    }

    public static function getSubscribedEvents(){
      return [
        'Enlight_Controller_Dispatcher_ControllerPath_Backend_Faqtabelement' => 'controllerPathBackendFaqtabelement',
        'Enlight_Controller_Action_PostDispatch_Backend' => 'postDispatchBackend',
        'Enlight_Controller_Action_PostDispatch_Backend_Order' => 'postDispatchBackendOrder',
        'Shopware_Controllers_Backend_Order::getListAction::after' => 'afterBackendOrdergetListAction',
        'Shopware_Components_Document::assignValues::after' => 'afterDocumentAssignValues',
        'Theme_Inheritance_Template_Directories_Collected' => 'collectedTemplateDirectories'
      ];
    }

    public function controllerPathBackendFaqtabelement(){
      return $this->pluginDirectory . '/Controllers/Backend/Storagelocation.php';
    }

    public function postDispatchBackend(\Enlight_Controller_ActionEventArgs $args){
      $view = $args->get('subject')->View();

      $view->addTemplateDir($this->pluginDirectory . '/Resources/views');
    }

    public function postDispatchBackendOrder(\Enlight_Event_EventArgs $args){    
      $request = $args->get('subject')->Request();
      $view = $args->get('subject')->View();

      $view->addTemplateDir($this->pluginDirectory . '/Resources/views/');

      if ($request->getActionName() === 'load') {
        $view->extendsTemplate('backend/storagelocation/order/model/position.js');
        $view->extendsTemplate('backend/storagelocation/order/view/list/position.js');
        $view->extendsTemplate('backend/storagelocation/order/view/detail/position.js');
      }
    }

    public function afterBackendOrdergetListAction(\Enlight_Hook_HookArgs $args){
      $view = $args->getSubject()->View();
      $assign = $view->getAssign();
      $orders = $assign['data'];
        
      foreach ($orders as $key => $order) {
        foreach ($order["details"] as $detailKey => $orderDetail) {
          $articleRepository = Shopware()->Models()->getRepository('Shopware\Models\Article\Detail');
          $article = $articleRepository->findOneBy(array('number' => $orderDetail["articleNumber"]));

          if ($article instanceof \Shopware\Models\Article\Detail) {
            $storagelocation = Shopware()->Db()->fetchRow("SELECT `label` FROM `s_plugin_storagelocation` WHERE `id` = ?", array($article->getAttribute()->getAttrStoragelocation()));    
          
            $order["details"][$detailKey]['attrStoragelocation'] = $storagelocation['label'];
          }
        }
          
        $orders[$key] = $order;
      }
      
      $assign['data'] = $orders;
      
      $view->assign($assign);
    }

    public function afterDocumentAssignValues(\Enlight_Hook_HookArgs $args){
      $controller = $args->getSubject();
      $order = $args->getSubject()->_order->__toArray();
       
      foreach ($order['_positions'] as $key => $value){
        $articleDetails = Shopware()->Db()->fetchRow("SELECT id FROM s_articles_details WHERE ordernumber = ?", array($value['articleordernumber']));
        $articleAttributes = Shopware()->Db()->fetchRow("SELECT attr_storagelocation FROM s_articles_attributes WHERE articledetailsID = ?", array($articleDetails['id']));
        $storageLocation = Shopware()->Db()->fetchRow("SELECT label FROM s_plugin_storagelocation WHERE id = ?", array($articleAttributes['attr_storagelocation']));
          
        $modifiedData[$key]["attr_storagelocation"] = $storageLocation['label'];
      }
       
      $controller->_view->assign("storagelocations", $modifiedData);
    }

    public function collectedTemplateDirectories(\Enlight_Event_EventArgs $args){
      $directories = $args->getReturn();
 
      array_push(
        $directories,
        $this->pluginDirectory . '/Resources/views/'
      );
 
      return $directories;
    }
  }