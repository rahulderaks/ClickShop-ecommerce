<?php


namespace FontLib\Table\Type;
use FontLib\Table\Table;

/**
 * `maxp` font table.
 *
 * @package php-font-lib
 */
class maxp extends Table {
  protected $def = array(
    "version"               => self::Fixed,
    "numGlyphs"             => self::uint16,
    "maxPoints"             => self::uint16,
    "maxContours"           => self::uint16,
    "maxComponentPoints"    => self::uint16,
    "maxComponentContours"  => self::uint16,
    "maxZones"              => self::uint16,
    "maxTwilightPoints"     => self::uint16,
    "maxStorage"            => self::uint16,
    "maxFunctionDefs"       => self::uint16,
    "maxInstructionDefs"    => self::uint16,
    "maxStackElements"      => self::uint16,
    "maxSizeOfInstructions" => self::uint16,
    "maxComponentElements"  => self::uint16,
    "maxComponentDepth"     => self::uint16,
  );

  function _encode() {
    $font                    = $this->getFont();
    $this->data["numGlyphs"] = count($font->getSubset());

    return parent::_encode();
  }
}