<?php

namespace Craft;

class DumpVariable
{
    public function getAllSources()
    {
        $allSources = craft()->assetSources->getAllSources();

        $sources = array(
            array(
                'label' => 'None',
                'value' => '',
            )
        );

        // Build custom sources array
        foreach ($allSources as $source) {
            $sources[] = array(
                'label' => $source->name,
                'value' => $source->id,
            );
        }

        return $sources;
    }
}
