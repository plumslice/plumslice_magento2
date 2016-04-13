<?php
/**
 * @author Plumslice Team
 * @copyright Copyright (c) 2016 Plumslice (http://www.plumslice.com)
 * @package Plumslice_Api
 */
namespace Plumslice\Api\Plugin;
use Magento\Framework\Api\Data\ImageContentInterface;
use Magento\Catalog\Api\Data\ProductAttributeMediaGalleryEntryInterface;
use Magento\Framework\Api\ImageContent;


class Before
{
	
    /**
     * @var \Magento\Framework\Api\Data\ImageFactory
     */
    private $imageFactory;
	
	public function beforeCreate($plumslice, $sku, ProductAttributeMediaGalleryEntryInterface $entry)
	{
		print_r($entry->getContent());
		
		$imageUrl = $entry->getExtensionAttributes()->getImageUrl();
		if (isset($imageUrl) && $imageUrl != ''){
		  $path = $imageUrl;
		  $imagetypeArr = pathinfo($path);
		  $imagedata = file_get_contents($path);
		  $imageContent = base64_encode($imagedata);
		  $imagemime = 'image/'.$imagetypeArr['extension'];
		  
		  $newcontentarray = array(
                    ImageContentInterface::BASE64_ENCODED_DATA => $imageContent,
		    ImageContentInterface::TYPE => $imagemime,
		    ImageContentInterface::NAME => $imagetypeArr['basename']
                  );
		  $arrayobject = new ImageContent($newcontentarray);	
		  $entry->setContent($arrayobject);
		  
		}
		print_r($entry->getContent());
		exit();
	
	}
        public function beforeConvertFrom($plumslice, ProductAttributeMediaGalleryEntryInterface $entry)
	{
		//print_r($entry->getContent());
	    
		
		$imageUrl = $entry->getExtensionAttributes()->getImageUrl();
		//print_r($imageUrl);
		//exit();
		if (isset($imageUrl) && $imageUrl != ''){
		  $path = $imageUrl;
		  $imagetypeArr = pathinfo($path);
		  $imagedata = file_get_contents($path);
		  $imageContent = base64_encode($imagedata);
		  $imagemime = 'image/'.$imagetypeArr['extension'];
		  
		  $newcontentarray = array(
                    ImageContentInterface::BASE64_ENCODED_DATA => $imageContent,
		    ImageContentInterface::TYPE => $imagemime,
		    ImageContentInterface::NAME => $imagetypeArr['basename']
                  );
		  $arrayobject = new ImageContent($newcontentarray);	
		  $entry->setContent($arrayobject);
		  
		}
		//print_r($entry->getContent());
		//exit();
	}
}