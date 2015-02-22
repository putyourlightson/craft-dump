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
        return '0.2.0';
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
            'key' => array(AttributeType::String, 'required' => true),
	          'revisions' => array(AttributeType::String),
            'folderId' => array(AttributeType::String)
        );
    }

    public function getSettingsHtml()
    {
      $sourceIds = craft()->assetSources->getAllSourceIds();
      $tree = craft()->assets->getFolderTreeBySourceIds($sourceIds);

      return craft()->templates->render('dump/_settings', array(
          'settings' => $this->getSettings(),
          'tree' => $tree
      ));
    }

    public function init() {

      craft()->on('db.onBackup', function(Event $event) {



        $plugin = craft()->plugins->getPlugin('dump');
        $settings = $plugin->getSettings();

        $folderId = $settings->folderId;



        if ($folderId > 0) {

          $segments = explode("/", $event->params['filePath']);
          $filename = array_pop($segments);
          $response = craft()->assets->insertFileByLocalPath($event->params['filePath'], $filename, $folderId);
        }

      });
    }
}
