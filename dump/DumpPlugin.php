<?php

namespace Craft;

class DumpPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Dump');
    }

    public function getDescription()
    {
        return Craft::t('Simple way to create database backups locally and remotely.');
    }

    public function getVersion()
    {
        return '0.3.0';
    }

    public function getDeveloper()
    {
        return 'PutYourLightsOn';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.putyourlightson.net';
    }

    protected function defineSettings()
    {
        return array(
            'key' => array(AttributeType::String, 'required' => true),
            'source' => array(AttributeType::String, 'required' => true),
            'revisions' => array(AttributeType::String),
        );
    }

    public function getSettingsHtml()
    {
        return craft()->templates->render('dump/_settings', array(
            'settings' => $this->getSettings()
        ));
    }
}
