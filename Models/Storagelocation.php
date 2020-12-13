<?php
	namespace sschreierStoragelocationsw5\Models;

	use Shopware\Components\Model\ModelEntity;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Validator\Constraints as Assert;

	/**
	 * @ORM\Entity
	 * @ORM\Table(name="s_plugin_storagelocation")
	 */
	class Storagelocation extends ModelEntity {
		/**
		 * @var integer $id
		 *
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue(strategy="IDENTITY")
		 */
		private $id;

		/**
		 * @var string $label
		 *
		* @ORM\Column(type="text", nullable=true)
		 */
		private $label;
				
		/**
		 * @return int
		 */
		public function getId(){
			return $this->id;
		}

		/**
		 * @param string $label
		 */
		public function setLabel($label){
			$this->label = $label;
		}

		/**
		 * @return string
		 */
		public function getLabel(){
			return $this->label;
		}
	}