<?php
    namespace sschreierStoragelocationsw5;

    use Shopware\Components\Plugin;
    use Shopware\Components\Plugin\Context\InstallContext;
    use Shopware\Components\Plugin\Context\ActivateContext;
    use Shopware\Components\Plugin\Context\UninstallContext;
    use Doctrine\ORM\Tools\SchemaTool;
    use sschreierStoragelocationsw5\Models\Storagelocation;

    class sschreierStoragelocationsw5 extends Plugin {
		public function install(InstallContext $installContext){
            $this->createArticleAttribute();
            
            $this->createDocument();
            
            $entityManager = $this->container->get('models');

            $tool = new SchemaTool($entityManager);

            $classMetaData = [
                $entityManager->getClassMetadata(Storagelocation::class)
            ];

            if (!$entityManager->getConnection()->getSchemaManager()->tablesExist(array('s_plugin_storagelocation'))) {
                $tool->createSchema($classMetaData);
            }else{                
                $tool->updateSchema($classMetaData, true);
            }  
        }

        public function activate(ActivateContext $activateContext){
            $activateContext->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
        }

        public function uninstall(UninstallContext $uninstallContext){
            if($uninstallContext->keepUserData()){
                return;
            }
            
            $entityManager = $this->container->get('models');

            $tool = new SchemaTool($entityManager);

            $classMetaData = [
                $entityManager->getClassMetadata(Storagelocation::class)
            ];

            $tool->dropSchema($classMetaData);
            
            $this->removeArticleAttribute();

            $this->removeDocument();
            
            $uninstallContext->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
        }

        private function createArticleAttribute(){
            $attributeService = $this->container->get('shopware_attribute.crud_service');   
            
            $attributeService->update(
            	's_articles_attributes', 
            	'attr_storagelocation', 
            	'single_selection', 
            	[
	                'label' => 'Lagerort',
	                'supportText' => '',
	                'helpText' => 'Lagerort',
	                'translatable' => true,
	                'displayInBackend' => true,
	                'position' => 4,
	                'custom' => true,
	                'entity' => \sschreierStoragelocationsw5\Models\Storagelocation::class
            	]
            );

            $metaDataCache = $this->container->get('models')->getConfiguration()->getMetadataCacheImpl();
            $metaDataCache->deleteAll();

            $this->container->get('models')->generateAttributeModels(
                array(
                	's_articles_attributes'
                )
            );
        }

        private function removeArticleAttribute(){
            $attributeService = $this->container->get('shopware_attribute.crud_service');
            
            try {
                $attributeService->delete('s_articles_attributes', 'attr_storagelocation');
            } catch (\Exception $e) {}

            $metaDataCache = $this->container->get('models')->getConfiguration()->getMetadataCacheImpl();
            $metaDataCache->deleteAll();

            $this->container->get('models')->generateAttributeModels(
                array(
                	's_articles_attributes'
                )
            );
        }

        private function createDocument(){
			$doc_number = "doc_pl";
			$documentID = 2;
			$value = "";
			
			$dbData = Shopware()->Db()->fetchAll('SELECT * FROM `s_core_documents` WHERE `numbers` = ?', $doc_number);				 
			$numRows = count($dbData);

			if($numRows == 0){					
				Shopware()->Db()->query("INSERT INTO `s_core_documents` (`name`, `template`, `numbers`, `left`, `right`, `top`, `bottom`, `pagebreak`, `key`) VALUES ('Laufzettel', 'index_pl.tpl', '".$doc_number."', '25', '10', '20', '20', '10', 'pick_list');");
					
				$last_insert_id = Shopware()->Db()->lastInsertId();
				
				Shopware()->Db()->query("INSERT INTO `s_order_number` (`number`, `name`, `desc`) VALUES ('20000', '".$doc_number."', 'Laufzettel');");
				
				$documents_box = Shopware()->Db()->fetchAll("SELECT * FROM `s_core_documents_box` WHERE `documentID` = ?", array($documentID));
				
				foreach($documents_box as $dbox) {
					if($dbox['name'] == "Logo"){
						$value = "";
					}else{
						$value = $dbox['value'];
					}
					
					Shopware()->Db()->query("INSERT INTO `s_core_documents_box` (`documentID`, `name`, `style`, `value`) VALUES ('".$last_insert_id."', '".$dbox['name']."', '".$dbox['style']."', '".$value."');");
				}
			}
		}

		private function removeDocument(){
			$doc_number = "doc_pl";
			
			Shopware()->Db()->query("DELETE FROM `s_order_number` WHERE `name` = ?", array($doc_number));
			Shopware()->Db()->query("DELETE FROM `s_core_documents` WHERE `numbers` = ?", array($doc_number));

			$documents = Shopware()->Db()->fetchAll("SELECT * FROM `s_core_documents` WHERE `numbers` = ?", array($doc_number));
			
			foreach($documents as $doc) {
				Shopware()->Db()->query("DELETE FROM `s_core_documents_box` WHERE `documentID` = ?", array($doc['id']));
				Shopware()->Db()->query("DELETE FROM `s_order_documents` WHERE `type` = ?", array($doc['id']));
			}
		}
    }