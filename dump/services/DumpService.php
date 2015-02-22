<?php
namespace Craft;

class DumpService extends BaseApplicationComponent {


  public function deleteOldBackups($revisions = null, $folderId = 0)
  {

    // If a number is not passed return
    if (!is_numeric($revisions))
    {
      return 0;
    }

    $backupPath = craft()->path->getDbBackupPath();

    $i = 0;

    // Get a list of files in the backup directory and sort by descending order
    if ($files = scandir($backupPath, SCANDIR_SORT_DESCENDING))
    {
      // Remove 'x' from the beginning of the array
      $files = array_slice($files, ($revisions - 1));


      // Loop through any remaining files and delete them
      foreach($files as $file)
      {
        $filePath = $backupPath . $file;

        if (is_file($filePath))
        {
          unlink($filePath);
          $i++;
        }
      }

    }

    // if there backups are saving to assets, cleanup those as well
    if ($folderId > 0)
    {

      $backups = $this->getFilesByFolderId($folderId);

      // Remove 'x' from the beginning of the array
      $extraBackups = array_slice($backups, ($revisions - 1));

      // create an array based on the ids from those backups
      $extraBackupIds = array_map(create_function('$b', 'return $b->id;'), $extraBackups);

      // delete those extra files no matter where they are
      craft()->assets->deleteFiles($extraBackupIds);

    }

    return $i;
  }

  private function getFilesByFolderId($folderId, $indexBy = null)
  {
    $files = craft()->db->createCommand()
      ->select('fi.*')
      ->from('assetfiles fi')
      ->join('assetfolders fo', 'fo.id = fi.folderId')
      ->where('fo.id = :folderId', array(':folderId' => $folderId))
      ->order('fi.dateCreated desc')
      ->queryAll();

    return AssetFileModel::populateModels($files, $indexBy);
  }




}
