<?php
	class Shopware_Controllers_Backend_Storagelocation extends Shopware_Controllers_Backend_Application {
		protected $model = 'sschreierStoragelocationsw5\Models\Storagelocation';
		protected $alias = 'storagelocation';

		protected function getListQuery(){
			$builder = parent::getListQuery();
			
			$builder->addSelect(array('storagelocation.id', 'storagelocation.id AS sl_id', 'storagelocation.label'));
			
			return $builder;
		}
		
		protected function getDetailQuery($id){
			$builder = parent::getDetailQuery($id);

			return $builder;
		}
	}