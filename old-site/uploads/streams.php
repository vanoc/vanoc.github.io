<?php
/**
 * PHP-Gettext External Library: StreamReader classes PATCHED!!!
 *
 * @package External
 * @subpackage PHP-gettext
 *
 * @internal
   Copyright (c) 2003, 2005 Danilo Segan <danilo@kvota.net>.

   This file is part of PHP-gettext.

   PHP-gettext is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   PHP-gettext is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with PHP-gettext; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 */


// Simple class to wrap file streams, string streams, etc.
// seek is essential, and it should be byte stream
class StreamReader {
  // should return a string [FIXME: perhaps return array of bytes?]
  function read($bytes) {
    return false;
  }

  // should return new position
  function seekto($position) {
    return false;
  }

  // returns current position
  function currentpos() {
    return false;
  }

  // returns length of entire stream (limit for seekto()s)
  function length() {
    return false;
  }
}

class StringReader {
  var $_pos;
  var $_str;
  var $mem_fd = 0;
  var $mem_fd_clen;

  function StringReader($str='') {
    $this->_str = $str;
    $this->_pos = 0;
  }

  function read($bytes) {
    if($bytes<=0)return 0;
    if(!$this->mem_fd)
    {
      $this->mem_fd = fopen("php://memory", 'r+');
      fputs($this->mem_fd, $this->_str);
      $this->mem_fd_clen = ftell($this->mem_fd);
      fseek($this->mem_fd, 0);
    }
    $data = fread($this->mem_fd, $bytes);
    $this->_pos += $bytes;
    if ($this->mem_fd_clen<$this->_pos)
        $this->_pos = $this->mem_fd_clen;

    return $data;
  }

  function seekto($pos) {
    $this->_pos = $pos;
    if ($this->mem_fd_clen<$this->_pos)
        $this->_pos = $this->mem_fd_clen;
    fseek($this->mem_fd, $this->_pos);
    return $this->_pos;
  }

  function currentpos() {
    return $this->_pos;
  }

  function length() {
    return strlen($this->_str);
  }

}


class FileReader {
  var $_pos;
  var $_fd;
  var $_length;

  function FileReader($filename) {
    if (file_exists($filename)) {

      $this->_length=filesize($filename);
      $this->_pos = 0;
      $this->_fd = fopen($filename,'rb');
      if (!$this->_fd) {
	$this->error = 3; // Cannot read file, probably permissions
	return false;
      }
    } else {
      $this->error = 2; // File doesn't exist
      return false;
    }
  }

  function read($bytes) {
    if ($bytes) {
      fseek($this->_fd, $this->_pos);

      // PHP 5.1.1 does not read more than 8192 bytes in one fread()
      // the discussions at PHP Bugs suggest it's the intended behaviour
      while ($bytes > 0) {
        $chunk  = fread($this->_fd, $bytes);
        $data  .= $chunk;
        $bytes -= strlen($chunk);
      }
      $this->_pos = ftell($this->_fd);

      return $data;
    } else return '';
  }

  function seekto($pos) {
    fseek($this->_fd, $pos);
    $this->_pos = ftell($this->_fd);
    return $this->_pos;
  }

  function currentpos() {
    return $this->_pos;
  }

  function length() {
    return $this->_length;
  }

  function close() {
    fclose($this->_fd);
  }

}

// Preloads entire file in memory first, then creates a StringReader
// over it (it assumes knowledge of StringReader internals)
class CachedFileReader extends StringReader {
  function CachedFileReader($filename) {
    if (file_exists($filename)) {

      $length=filesize($filename);
      $fd = fopen($filename,'rb');

      if (!$fd) {
	$this->error = 3; // Cannot read file, probably permissions
	return false;
      }
      $this->_str = fread($fd, $length);
      fclose($fd);

    } else {
      $this->error = 2; // File doesn't exist
      return false;
    }
  }
}


?>