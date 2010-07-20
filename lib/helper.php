<?php
/*
  +---------------------------------------------------------------------------------+
  | Copyright (c) 2010 Haanga                                                       |
  +---------------------------------------------------------------------------------+
  | Redistribution and use in source and binary forms, with or without              |
  | modification, are permitted provided that the following conditions are met:     |
  | 1. Redistributions of source code must retain the above copyright               |
  |    notice, this list of conditions and the following disclaimer.                |
  |                                                                                 |
  | 2. Redistributions in binary form must reproduce the above copyright            |
  |    notice, this list of conditions and the following disclaimer in the          |
  |    documentation and/or other materials provided with the distribution.         |
  |                                                                                 |
  | 3. All advertising materials mentioning features or use of this software        |
  |    must display the following acknowledgement:                                  |
  |    This product includes software developed by César D. Rodas.                  |
  |                                                                                 |
  | 4. Neither the name of the César D. Rodas nor the                               |
  |    names of its contributors may be used to endorse or promote products         |
  |    derived from this software without specific prior written permission.        |
  |                                                                                 |
  | THIS SOFTWARE IS PROVIDED BY CÉSAR D. RODAS ''AS IS'' AND ANY                   |
  | EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED       |
  | WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE          |
  | DISCLAIMED. IN NO EVENT SHALL CÉSAR D. RODAS BE LIABLE FOR ANY                  |
  | DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES      |
  | (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;    |
  | LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND     |
  | ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT      |
  | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS   |
  | SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE                     |
  +---------------------------------------------------------------------------------+
  | Authors: César Rodas <crodas@php.net>                                           |
  +---------------------------------------------------------------------------------+
*/

class HCode
{
    public $stack;

    public $current;

    protected function _str($string)
    {
        return array("string" => $string);
    }


    protected function _num($number)
    {
        return array("number" => $number);
    }

    protected function getValue($obj, &$value, $get_all=FALSE)
    {
        $class = __CLASS__;

        if ($obj InstanceOf $class) {
            $value = $obj->getArray();
            if (!$get_all) {
                $value = $value[0];
            }
        } else if (is_String($obj)) {
            $value = $this->_str($obj);
        } else if (is_numeric($obj)) {
            $value = $this->_num($obj);
        } else if ($obj === FALSE) {
            $value = array('expr' => FALSE);
        } else if ($obj === TRUE) {
            $value = array('expr' => TRUE);
        } else if (is_array($obj)) {
            throw new Exception("Not yet implemented");
        } else {
            var_Dump($obj);
            throw new Exception("Imposible to get the value of the object");
        }
    }

    function str($string)
    {
        $this->stack[] = $this->_str($string);
    }

    function num($num)
    {
        $this->stack[] = $this->_num($num);
    }

    function getArray()
    {
        $this->end();
        return $this->stack;
    }

    function exec($function)
    {
        $this->current = array('exec' => $function, 'args' => array());
        return $this;
    }

    function arr($function)
    {
        $this->current = array('array' => array());
    }

    function element($key=NULL, $value)
    {
    }

    function decl($name, $value)
    {
        $this->getValue($value, $stmt);
        $this->stack[] = array('op' => 'declare', 'name' => $name, $stmt);
        return $this;
    }

    function param($param)
    {
        $last = & $this->current;

        if (!isset($last['exec'])) {
            throw new Exception("Invalid call to param()");
        }
        
        $this->getValue($param, $value);
        $last['args'][] = $value;

        return $this;
    }

    function end()
    {
        if (count($this->current) > 0) {
            $this->stack[] = $this->current;
            $this->current = array();
        }

        return $this;
    }
}

function h()
{
    return new HCode;
}

$c = h()->decl('cesar', h()->exec('function')->param( h()->exec('bar')->param('foo') ) );
$c->decl('david', FALSE);

require "generator.php";

class Haanga_CompilerException extends Exception {}

$generator = new Haanga_CodeGenerator;

var_dump($c);

$code = $generator->getCode($c->getArray());

var_dump($code);
