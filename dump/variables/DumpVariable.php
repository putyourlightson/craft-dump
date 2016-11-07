<?php
namespace Craft;

class DumpVariable
{
    function getAllSources()
    {
    	$allSources = craft()->assetSources->getAllSources();
    	$object = array();

        // A custom built array is necessary, since Craft's
        // field-forms require keys not available in the
        // arrays of the assets object
    	foreach ($allSources as $source)
    	{
    		$data = array(
    			'label' => $source->name,
    			'value' => $source->id
    		);

    		array_push($object, $data);
    	}

        return $object;
    }
}
