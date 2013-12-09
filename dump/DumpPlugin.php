<?php

namespace Craft;

class DumpPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Dump');
    }

    public function getVersion()
    {
        return '0.1';
    }

    public function getDeveloper()
    {
        return 'PutYourLightsOn (Ben Croker)';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.putyourlightson.net';
    }

    protected function defineSettings()
    {
        return array(
            'key' => array(AttributeType::Email, 'required' => true),
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('dump/_settings', array(
            'settings' => $this->getSettings()
        ));
    }
}
