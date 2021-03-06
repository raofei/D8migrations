<?php

namespace Drupal\example_D7D8_migrate\Plugin\migrate\process;

use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Convert a date field to the W3C format.
 *
 * @MigrateProcessPlugin(
 *   id = "render_date",
 * )
 */
class RenderDate extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    try {
      if (is_numeric($value)) {
        $date = new \DateTime();
        $date->setTimestamp($value);
      }
      else {
        $date = new \DateTime($value);
      }
      $value = $date->format('Y-m-d');
    }
    catch (\Exception $e) {
      throw new MigrateException('Invalid source date.');
    }
    return $value;
  }

}
