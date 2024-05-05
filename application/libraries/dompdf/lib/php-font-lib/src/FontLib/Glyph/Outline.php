<?php
namespace FontLib\Glyph;

use FontLib\Table\Type\glyf;
use FontLib\TrueType\File;
use FontLib\BinaryStream;

/**
 * `glyf` font table.
 *
 * @package php-font-lib
 */
class Outline extends BinaryStream {
  /**
   * @var \FontLib\Table\Type\glyf
   */
  protected $table;

  protected $offset;
  protected $size;

  // Data
  public $numberOfContours;
  public $xMin;
  public $yMin;
  public $xMax;
  public $yMax;

  public $raw;

  /**
   * @param glyf $table
   * @param                 $offset
   * @param                 $size
   *
   * @return Outline
   */
  static function init(glyf $table, $offset, $size, BinaryStream $font) {
    $font->seek($offset);

    if ($font->readInt16() > -1) {
      /** @var OutlineSimple $glyph */
      $glyph = new OutlineSimple($table, $offset, $size);
    }
    else {
      /** @var OutlineComposite $glyph */
      $glyph = new OutlineComposite($table, $offset, $size);
    }

    $glyph->parse($font);

    return $glyph;
  }

  /**
   * @return File
   */
  function getFont() {
    return $this->table->getFont();
  }

  function __construct(glyf $table, $offset = null, $size = null) {
    $this->table  = $table;
    $this->offset = $offset;
    $this->size   = $size;
  }

  function parse(BinaryStream $font) {
    $font->seek($this->offset);

    if (!$this->size) {
      return;
    }

    $this->raw = $font->read($this->size);
  }

  function parseData() {
    $font = $this->getFont();
    $font->seek($this->offset);

    $this->numberOfContours = $font->readInt16();
    $this->xMin             = $font->readFWord();
    $this->yMin             = $font->readFWord();
    $this->xMax             = $font->readFWord();
    $this->yMax             = $font->readFWord();
  }

  function encode() {
    $font = $this->getFont();

    return $font->write($this->raw, strlen($this->raw));
  }

  function getSVGContours() {
    // Inherit
  }

  function getGlyphIDs() {
    return array();
  }
}

