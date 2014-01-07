<?php

namespace Craft;

/**
 * Dump Controller
 */
class DumpController extends BaseController
{
    protected $allowAnonymous = array('actionBackup');

    /**
     * Backup
     */
    public function actionBackup()
    {
        // check if plugin is installed
        if (!$plugin = craft()->plugins->getPlugin('dump'))
        {
            die('Could not find the plugin');
        }

        // get settings
        $settings = $plugin->getSettings();

        // get key
        $key = craft()->request->getParam('key');

        // verify key
        if (!$settings->key OR $key != $settings->key)
        {
            die('Unauthorised key');
        }

        // run backup
        craft()->db->backup();

        // check if a redirect was posted
        if (craft()->request->getPost('redirect'))
        {
            $this->redirectToPostedUrl();
        }

        die('Success');
    }
}
