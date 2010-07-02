<?php
/* Driver template for the PHP_Haanga_rGenerator parser generator. (PHP port of LEMON)
*/

/**
 * This can be used to store both the string representation of
 * a token, and any useful meta-data associated with the token.
 *
 * meta-data should be stored as an array
 */
class Haanga_yyToken implements ArrayAccess
{
    public $string = '';
    public $metadata = array();

    function __construct($s, $m = array())
    {
        if ($s instanceof Haanga_yyToken) {
            $this->string = $s->string;
            $this->metadata = $s->metadata;
        } else {
            $this->string = (string) $s;
            if ($m instanceof Haanga_yyToken) {
                $this->metadata = $m->metadata;
            } elseif (is_array($m)) {
                $this->metadata = $m;
            }
        }
    }

    function __toString()
    {
        return $this->_string;
    }

    function offsetExists($offset)
    {
        return isset($this->metadata[$offset]);
    }

    function offsetGet($offset)
    {
        return $this->metadata[$offset];
    }

    function offsetSet($offset, $value)
    {
        if ($offset === null) {
            if (isset($value[0])) {
                $x = ($value instanceof Haanga_yyToken) ?
                    $value->metadata : $value;
                $this->metadata = array_merge($this->metadata, $x);
                return;
            }
            $offset = count($this->metadata);
        }
        if ($value === null) {
            return;
        }
        if ($value instanceof Haanga_yyToken) {
            if ($value->metadata) {
                $this->metadata[$offset] = $value->metadata;
            }
        } elseif ($value) {
            $this->metadata[$offset] = $value;
        }
    }

    function offsetUnset($offset)
    {
        unset($this->metadata[$offset]);
    }
}

/** The following structure represents a single element of the
 * parser's stack.  Information stored includes:
 *
 *   +  The state number for the parser at this level of the stack.
 *
 *   +  The value of the token stored at this level of the stack.
 *      (In other words, the "major" token.)
 *
 *   +  The semantic value stored at this level of the stack.  This is
 *      the information used by the action routines in the grammar.
 *      It is sometimes called the "minor" token.
 */
class Haanga_yyStackEntry
{
    public $stateno;       /* The state-number */
    public $major;         /* The major token value.  This is the code
                     ** number for the token at this stack level */
    public $minor; /* The user-supplied minor token value.  This
                     ** is the value of the token  */
};

// code external to the class is included here
#line 2 "parser.y"

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
#line 136 "parser.php"

// declare_class is output here
#line 39 "parser.y"
 class Parser #line 141 "parser.php"
{
/* First off, code is included which follows the "include_class" declaration
** in the input file. */
#line 40 "parser.y"


#line 149 "parser.php"

/* Next is all token values, as class constants
*/
/* 
** These constants (all generated automatically by the parser generator)
** specify the various kinds of tokens (terminals) that the parser
** understands. 
**
** Each symbol here is a terminal symbol in the grammar.
*/
    const T_OPEN_TAG                     =  1;
    const T_AND                          =  2;
    const T_OR                           =  3;
    const T_EQ                           =  4;
    const T_NE                           =  5;
    const T_PLUS                         =  6;
    const T_MINUS                        =  7;
    const T_TIMES                        =  8;
    const T_DIV                          =  9;
    const T_MOD                          = 10;
    const T_HTML                         = 11;
    const T_COMMENT_OPEN                 = 12;
    const T_COMMENT                      = 13;
    const T_PRINT_OPEN                   = 14;
    const T_PRINT_CLOSE                  = 15;
    const T_EXTENDS                      = 16;
    const T_CLOSE_TAG                    = 17;
    const T_INCLUDE                      = 18;
    const T_FOR                          = 19;
    const T_AS                           = 20;
    const T_WITH                         = 21;
    const T_ENDWITH                      = 22;
    const T_IN                           = 23;
    const T_CLOSEFOR                     = 24;
    const T_EMPTY                        = 25;
    const T_IF                           = 26;
    const T_ENDIF                        = 27;
    const T_ELSE                         = 28;
    const T_IFCHANGED                    = 29;
    const T_ENDIFCHANGED                 = 30;
    const T_CUSTOM_END                   = 31;
    const T_BLOCK                        = 32;
    const T_END_BLOCK                    = 33;
    const T_FILTER                       = 34;
    const T_END_FILTER                   = 35;
    const T_REGROUP                      = 36;
    const T_BY                           = 37;
    const T_CYCLE                        = 38;
    const T_PIPE                         = 39;
    const T_COMMA                        = 40;
    const T_STRING_SINGLE_INIT           = 41;
    const T_STRING_SINGLE_END            = 42;
    const T_STRING_DOUBLE_INIT           = 43;
    const T_STRING_DOUBLE_END            = 44;
    const T_STRING_CONTENT               = 45;
    const T_LPARENT                      = 46;
    const T_RPARENT                      = 47;
    const T_NUMERIC                      = 48;
    const T_DOT                          = 49;
    const T_ALPHA                        = 50;
    const YY_NO_ACTION = 236;
    const YY_ACCEPT_ACTION = 235;
    const YY_ERROR_ACTION = 234;

/* Next are that tables used to determine what action to take based on the
** current state and lookahead token.  These tables are used to implement
** functions that take a state number and lookahead value and return an
** action integer.  
**
** Suppose the action integer is N.  Then the action is determined as
** follows
**
**   0 <= N < self::YYNSTATE                              Shift N.  That is,
**                                                        push the lookahead
**                                                        token onto the stack
**                                                        and goto state N.
**
**   self::YYNSTATE <= N < self::YYNSTATE+self::YYNRULE   Reduce by rule N-YYNSTATE.
**
**   N == self::YYNSTATE+self::YYNRULE                    A syntax error has occurred.
**
**   N == self::YYNSTATE+self::YYNRULE+1                  The parser accepts its
**                                                        input. (and concludes parsing)
**
**   N == self::YYNSTATE+self::YYNRULE+2                  No such action.  Denotes unused
**                                                        slots in the yy_action[] table.
**
** The action table is constructed as a single large static array $yy_action.
** Given state S and lookahead X, the action is computed as
**
**      self::$yy_action[self::$yy_shift_ofst[S] + X ]
**
** If the index value self::$yy_shift_ofst[S]+X is out of range or if the value
** self::$yy_lookahead[self::$yy_shift_ofst[S]+X] is not equal to X or if
** self::$yy_shift_ofst[S] is equal to self::YY_SHIFT_USE_DFLT, it means that
** the action is not in the table and that self::$yy_default[S] should be used instead.  
**
** The formula above is for computing the action when the lookahead is
** a terminal symbol.  If the lookahead is a non-terminal (as occurs after
** a reduce action) then the static $yy_reduce_ofst array is used in place of
** the static $yy_shift_ofst array and self::YY_REDUCE_USE_DFLT is used in place of
** self::YY_SHIFT_USE_DFLT.
**
** The following are the tables generated in this section:
**
**  self::$yy_action        A single table containing all actions.
**  self::$yy_lookahead     A table containing the lookahead for each entry in
**                          yy_action.  Used to detect hash collisions.
**  self::$yy_shift_ofst    For each state, the offset into self::$yy_action for
**                          shifting terminals.
**  self::$yy_reduce_ofst   For each state, the offset into self::$yy_action for
**                          shifting non-terminals after a reduce.
**  self::$yy_default       Default action for each state.
*/
    const YY_SZ_ACTTAB = 502;
static public $yy_action = array(
 /*     0 */   133,   14,  106,  115,  150,  153,  148,  144,  146,  145,
 /*    10 */   160,  162,   60,  136,  135,   29,  140,   27,   55,  158,
 /*    20 */    46,  126,   15,   15,   15,   19,   65,  114,   22,  118,
 /*    30 */   128,   58,   47,   30,   51,   62,   45,   23,  106,   18,
 /*    40 */   152,  122,   29,  147,   27,   55,   10,   46,   50,  147,
 /*    50 */   102,  103,   19,  106,   64,   22,  168,  101,   58,   52,
 /*    60 */    30,  106,   62,   61,   23,  139,   82,   29,   59,   27,
 /*    70 */    55,    4,   46,  147,  104,  134,  147,   19,  110,   97,
 /*    80 */    22,  168,  101,   58,   52,   30,  106,   62,  131,   23,
 /*    90 */   161,  164,  106,   29,  121,   27,   55,  106,   46,  166,
 /*   100 */    53,  147,   88,   19,   70,  107,   22,  111,   33,   58,
 /*   110 */    72,   30,  106,   62,   40,   23,  163,   51,   29,   45,
 /*   120 */    27,   55,   12,   46,  117,   31,  147,  147,   19,  104,
 /*   130 */   134,   22,  168,  101,   58,   52,   30,  132,   62,   34,
 /*   140 */    23,  147,  106,   80,   29,  161,   27,   55,    9,   46,
 /*   150 */   106,   67,  147,  112,   19,  109,  154,   22,  168,  101,
 /*   160 */    58,   52,   30,  159,   62,  169,   23,   71,   84,   29,
 /*   170 */    38,   27,   55,   66,   46,   51,  129,   45,  147,   19,
 /*   180 */   104,  156,   22,  105,  147,   58,  151,   30,  106,   62,
 /*   190 */   149,   23,  137,  104,  167,   29,  161,   27,   55,  106,
 /*   200 */    46,  142,  158,  147,   25,   19,  138,  123,   22,  161,
 /*   210 */   113,   58,   63,   30,  141,   62,  143,   23,  104,  134,
 /*   220 */    29,   83,   27,   55,  106,   46,  130,  157,   91,  147,
 /*   230 */    19,   86,   77,   22,  161,    3,   58,   44,   30,  106,
 /*   240 */    62,   48,   23,   81,   92,  168,  101,   29,   52,   27,
 /*   250 */    55,  189,   46,  170,  147,  108,   79,   19,  235,   39,
 /*   260 */    22,   28,   51,   58,   45,   30,   42,   62,  100,   23,
 /*   270 */    85,  147,   29,   87,   27,   55,   89,   46,  155,  104,
 /*   280 */   134,  147,   19,   35,  120,   22,  116,  127,   58,   68,
 /*   290 */    30,   37,   62,   74,   23,  161,   32,   36,   29,  139,
 /*   300 */    27,   55,   95,   46,   94,   96,  147,   73,   19,   90,
 /*   310 */    93,   22,   28,   51,   58,   45,   30,  119,   62,   41,
 /*   320 */    23,   43,  147,   29,    2,   27,   55,  139,   46,  139,
 /*   330 */   139,  139,  147,   19,  168,  101,   22,   52,  139,   58,
 /*   340 */   139,   30,  139,   62,  139,   23,   21,   20,   17,   17,
 /*   350 */    16,   16,   15,   15,   15,  139,  139,  147,  139,  139,
 /*   360 */   139,   69,  139,  139,   21,   20,   17,   17,   16,   16,
 /*   370 */    15,   15,   15,   20,   17,   17,   16,   16,   15,   15,
 /*   380 */    15,   17,   17,   16,   16,   15,   15,   15,   49,    8,
 /*   390 */    54,   56,  124,    7,  139,   57,  139,   13,  139,  168,
 /*   400 */   101,  139,   52,  168,  101,  139,   52,  168,  101,  125,
 /*   410 */    52,  139,   51,  139,   45,   28,   51,    1,   45,  139,
 /*   420 */   106,  147,    5,  139,  139,  147,  139,  168,  101,    6,
 /*   430 */    52,  139,  168,  101,   11,   52,  139,  104,  167,  168,
 /*   440 */   101,  139,   52,  139,  168,  101,  139,   52,   26,  104,
 /*   450 */   167,  139,  139,  161,  104,  134,  139,  104,  134,  139,
 /*   460 */    24,  104,  134,  104,  165,  161,  104,   98,   78,  139,
 /*   470 */   161,   75,  139,  161,  139,   76,  139,  161,  139,  161,
 /*   480 */   139,  139,  161,  139,  139,  104,   99,  139,  139,  139,
 /*   490 */   139,  139,  139,  139,  139,  139,  139,  139,  139,  139,
 /*   500 */   139,  161,
    );
    static public $yy_lookahead = array(
 /*     0 */    55,   56,   49,   58,   59,   60,   61,   62,   63,   64,
 /*    10 */    65,   66,   23,   68,   69,   16,   42,   18,   19,   45,
 /*    20 */    21,   17,    8,    9,   10,   26,   17,   28,   29,   30,
 /*    30 */    17,   32,   20,   34,   41,   36,   43,   38,   49,   46,
 /*    40 */    17,   48,   16,   50,   18,   19,    1,   21,   39,   50,
 /*    50 */    24,   25,   26,   49,   17,   29,   11,   12,   32,   14,
 /*    60 */    34,   49,   36,   20,   38,   17,   56,   16,   20,   18,
 /*    70 */    19,    1,   21,   50,   56,   57,   50,   26,   27,   28,
 /*    80 */    29,   11,   12,   32,   14,   34,   49,   36,   70,   38,
 /*    90 */    72,   17,   49,   16,   54,   18,   19,   49,   21,   45,
 /*   100 */    37,   50,   73,   26,   17,   28,   29,   30,   53,   32,
 /*   110 */    17,   34,   49,   36,   53,   38,   15,   41,   16,   43,
 /*   120 */    18,   19,    1,   21,   22,   53,   50,   50,   26,   56,
 /*   130 */    57,   29,   11,   12,   32,   14,   34,   17,   36,   53,
 /*   140 */    38,   50,   49,   70,   16,   72,   18,   19,    1,   21,
 /*   150 */    49,   17,   50,   56,   26,   27,   17,   29,   11,   12,
 /*   160 */    32,   14,   34,   17,   36,   13,   38,   17,   71,   16,
 /*   170 */    53,   18,   19,   17,   21,   41,   17,   43,   50,   26,
 /*   180 */    56,   57,   29,   30,   50,   32,   17,   34,   49,   36,
 /*   190 */    17,   38,   17,   56,   57,   16,   72,   18,   19,   49,
 /*   200 */    21,   44,   45,   50,   67,   26,   17,   17,   29,   72,
 /*   210 */    31,   32,   17,   34,   17,   36,   17,   38,   56,   57,
 /*   220 */    16,   56,   18,   19,   49,   21,   17,   17,   56,   50,
 /*   230 */    26,   73,   70,   29,   72,    1,   32,   33,   34,   49,
 /*   240 */    36,   20,   38,   56,   56,   11,   12,   16,   14,   18,
 /*   250 */    19,    0,   21,   17,   50,   24,   56,   26,   52,   53,
 /*   260 */    29,   40,   41,   32,   43,   34,   53,   36,   56,   38,
 /*   270 */    56,   50,   16,   56,   18,   19,   56,   21,   17,   56,
 /*   280 */    57,   50,   26,   53,   56,   29,   30,   50,   32,   17,
 /*   290 */    34,   53,   36,   70,   38,   72,   53,   53,   16,   74,
 /*   300 */    18,   19,   56,   21,   56,   56,   50,   17,   26,   56,
 /*   310 */    56,   29,   40,   41,   32,   43,   34,   35,   36,   53,
 /*   320 */    38,   53,   50,   16,    1,   18,   19,   74,   21,   74,
 /*   330 */    74,   74,   50,   26,   11,   12,   29,   14,   74,   32,
 /*   340 */    74,   34,   74,   36,   74,   38,    2,    3,    4,    5,
 /*   350 */     6,    7,    8,    9,   10,   74,   74,   50,   74,   74,
 /*   360 */    74,   17,   74,   74,    2,    3,    4,    5,    6,    7,
 /*   370 */     8,    9,   10,    3,    4,    5,    6,    7,    8,    9,
 /*   380 */    10,    4,    5,    6,    7,    8,    9,   10,   17,    1,
 /*   390 */    19,   20,   17,    1,   74,   20,   74,    1,   74,   11,
 /*   400 */    12,   74,   14,   11,   12,   74,   14,   11,   12,   47,
 /*   410 */    14,   74,   41,   74,   43,   40,   41,    1,   43,   74,
 /*   420 */    49,   50,    1,   74,   74,   50,   74,   11,   12,    1,
 /*   430 */    14,   74,   11,   12,    1,   14,   74,   56,   57,   11,
 /*   440 */    12,   74,   14,   74,   11,   12,   74,   14,   67,   56,
 /*   450 */    57,   74,   74,   72,   56,   57,   74,   56,   57,   74,
 /*   460 */    67,   56,   57,   56,   57,   72,   56,   57,   70,   74,
 /*   470 */    72,   70,   74,   72,   74,   70,   74,   72,   74,   72,
 /*   480 */    74,   74,   72,   74,   74,   56,   57,   74,   74,   74,
 /*   490 */    74,   74,   74,   74,   74,   74,   74,   74,   74,   74,
 /*   500 */    74,   72,
);
    const YY_SHIFT_USE_DFLT = -48;
    const YY_SHIFT_MAX = 120;
    static public $yy_shift_ofst = array(
 /*     0 */   -48,   51,   -1,   26,   77,  128,  179,  256,  204,  231,
 /*    10 */   282,  102,  153,  307,  371,   -7,   -7,   -7,   -7,   -7,
 /*    20 */    -7,   -7,  134,   76,  375,  272,  221,   76,   76,   76,
 /*    30 */    91,  147,   70,  234,  121,   45,  433,  323,  416,  396,
 /*    40 */   388,  421,  392,  428,   23,   54,   91,   91,   91,  251,
 /*    50 */    91,   54,   91,   91,   91,   91,   91,   91,   91,   91,
 /*    60 */    91,   91,   91,  -48,  -48,  -48,  -48,  -48,  -48,  -48,
 /*    70 */   -48,  -48,  -48,  -48,  362,  344,  370,  377,  377,   48,
 /*    80 */    14,    4,  139,  190,    9,  101,  -26,   12,  157,  175,
 /*    90 */    63,  -11,  150,   43,   93,   37,  -47,  195,  209,   74,
 /*   100 */   -47,  152,  120,   87,  -47,  236,  237,  290,   13,  261,
 /*   110 */   210,  146,  -47,  189,  156,  173,  169,  159,  199,  197,
 /*   120 */   -47,
);
    const YY_REDUCE_USE_DFLT = -56;
    const YY_REDUCE_MAX = 73;
    static public $yy_reduce_ofst = array(
 /*     0 */   206,  -55,  -55,  -55,  -55,  -55,  -55,  -55,  -55,  -55,
 /*    10 */   -55,  -55,  -55,  -55,  393,   18,   73,  162,  223,  401,
 /*    20 */   398,  405,  137,  381,  124,  124,  124,  429,  407,  410,
 /*    30 */    97,   40,   40,   40,   40,   40,   40,   40,   40,   40,
 /*    40 */    40,   40,   40,   40,   10,   29,  254,  228,  249,  268,
 /*    50 */   212,  158,  214,  217,  200,  172,  165,  187,  188,  220,
 /*    60 */   248,  246,  253,  266,  244,  230,  213,  238,  243,  117,
 /*    70 */    72,   61,   55,   86,
);
    static public $yyExpectedTokens = array(
        /* 0 */ array(),
        /* 1 */ array(16, 18, 19, 21, 26, 27, 28, 29, 32, 34, 36, 38, 50, ),
        /* 2 */ array(16, 18, 19, 21, 26, 28, 29, 30, 32, 34, 36, 38, 50, ),
        /* 3 */ array(16, 18, 19, 21, 24, 25, 26, 29, 32, 34, 36, 38, 50, ),
        /* 4 */ array(16, 18, 19, 21, 26, 28, 29, 30, 32, 34, 36, 38, 50, ),
        /* 5 */ array(16, 18, 19, 21, 26, 27, 29, 32, 34, 36, 38, 50, ),
        /* 6 */ array(16, 18, 19, 21, 26, 29, 31, 32, 34, 36, 38, 50, ),
        /* 7 */ array(16, 18, 19, 21, 26, 29, 30, 32, 34, 36, 38, 50, ),
        /* 8 */ array(16, 18, 19, 21, 26, 29, 32, 33, 34, 36, 38, 50, ),
        /* 9 */ array(16, 18, 19, 21, 24, 26, 29, 32, 34, 36, 38, 50, ),
        /* 10 */ array(16, 18, 19, 21, 26, 29, 32, 34, 35, 36, 38, 50, ),
        /* 11 */ array(16, 18, 19, 21, 22, 26, 29, 32, 34, 36, 38, 50, ),
        /* 12 */ array(16, 18, 19, 21, 26, 29, 30, 32, 34, 36, 38, 50, ),
        /* 13 */ array(16, 18, 19, 21, 26, 29, 32, 34, 36, 38, 50, ),
        /* 14 */ array(17, 19, 20, 41, 43, 49, 50, ),
        /* 15 */ array(41, 43, 46, 48, 50, ),
        /* 16 */ array(41, 43, 46, 48, 50, ),
        /* 17 */ array(41, 43, 46, 48, 50, ),
        /* 18 */ array(41, 43, 46, 48, 50, ),
        /* 19 */ array(41, 43, 46, 48, 50, ),
        /* 20 */ array(41, 43, 46, 48, 50, ),
        /* 21 */ array(41, 43, 46, 48, 50, ),
        /* 22 */ array(17, 41, 43, 50, ),
        /* 23 */ array(41, 43, 50, ),
        /* 24 */ array(17, 20, 40, 41, 43, 50, ),
        /* 25 */ array(17, 40, 41, 43, 50, ),
        /* 26 */ array(20, 40, 41, 43, 50, ),
        /* 27 */ array(41, 43, 50, ),
        /* 28 */ array(41, 43, 50, ),
        /* 29 */ array(41, 43, 50, ),
        /* 30 */ array(50, ),
        /* 31 */ array(1, 11, 12, 14, ),
        /* 32 */ array(1, 11, 12, 14, ),
        /* 33 */ array(1, 11, 12, 14, ),
        /* 34 */ array(1, 11, 12, 14, ),
        /* 35 */ array(1, 11, 12, 14, ),
        /* 36 */ array(1, 11, 12, 14, ),
        /* 37 */ array(1, 11, 12, 14, ),
        /* 38 */ array(1, 11, 12, 14, ),
        /* 39 */ array(1, 11, 12, 14, ),
        /* 40 */ array(1, 11, 12, 14, ),
        /* 41 */ array(1, 11, 12, 14, ),
        /* 42 */ array(1, 11, 12, 14, ),
        /* 43 */ array(1, 11, 12, 14, ),
        /* 44 */ array(17, 50, ),
        /* 45 */ array(45, ),
        /* 46 */ array(50, ),
        /* 47 */ array(50, ),
        /* 48 */ array(50, ),
        /* 49 */ array(0, ),
        /* 50 */ array(50, ),
        /* 51 */ array(45, ),
        /* 52 */ array(50, ),
        /* 53 */ array(50, ),
        /* 54 */ array(50, ),
        /* 55 */ array(50, ),
        /* 56 */ array(50, ),
        /* 57 */ array(50, ),
        /* 58 */ array(50, ),
        /* 59 */ array(50, ),
        /* 60 */ array(50, ),
        /* 61 */ array(50, ),
        /* 62 */ array(50, ),
        /* 63 */ array(),
        /* 64 */ array(),
        /* 65 */ array(),
        /* 66 */ array(),
        /* 67 */ array(),
        /* 68 */ array(),
        /* 69 */ array(),
        /* 70 */ array(),
        /* 71 */ array(),
        /* 72 */ array(),
        /* 73 */ array(),
        /* 74 */ array(2, 3, 4, 5, 6, 7, 8, 9, 10, 47, ),
        /* 75 */ array(2, 3, 4, 5, 6, 7, 8, 9, 10, 17, ),
        /* 76 */ array(3, 4, 5, 6, 7, 8, 9, 10, ),
        /* 77 */ array(4, 5, 6, 7, 8, 9, 10, ),
        /* 78 */ array(4, 5, 6, 7, 8, 9, 10, ),
        /* 79 */ array(17, 20, 49, ),
        /* 80 */ array(8, 9, 10, ),
        /* 81 */ array(17, 49, ),
        /* 82 */ array(17, 49, ),
        /* 83 */ array(17, 49, ),
        /* 84 */ array(17, 39, ),
        /* 85 */ array(15, 49, ),
        /* 86 */ array(42, 45, ),
        /* 87 */ array(20, 49, ),
        /* 88 */ array(44, 45, ),
        /* 89 */ array(17, 49, ),
        /* 90 */ array(37, 49, ),
        /* 91 */ array(23, 49, ),
        /* 92 */ array(17, 49, ),
        /* 93 */ array(20, 49, ),
        /* 94 */ array(17, 49, ),
        /* 95 */ array(17, 49, ),
        /* 96 */ array(49, ),
        /* 97 */ array(17, ),
        /* 98 */ array(17, ),
        /* 99 */ array(17, ),
        /* 100 */ array(49, ),
        /* 101 */ array(13, ),
        /* 102 */ array(17, ),
        /* 103 */ array(17, ),
        /* 104 */ array(49, ),
        /* 105 */ array(17, ),
        /* 106 */ array(50, ),
        /* 107 */ array(17, ),
        /* 108 */ array(17, ),
        /* 109 */ array(17, ),
        /* 110 */ array(17, ),
        /* 111 */ array(17, ),
        /* 112 */ array(49, ),
        /* 113 */ array(17, ),
        /* 114 */ array(17, ),
        /* 115 */ array(17, ),
        /* 116 */ array(17, ),
        /* 117 */ array(17, ),
        /* 118 */ array(17, ),
        /* 119 */ array(17, ),
        /* 120 */ array(49, ),
        /* 121 */ array(),
        /* 122 */ array(),
        /* 123 */ array(),
        /* 124 */ array(),
        /* 125 */ array(),
        /* 126 */ array(),
        /* 127 */ array(),
        /* 128 */ array(),
        /* 129 */ array(),
        /* 130 */ array(),
        /* 131 */ array(),
        /* 132 */ array(),
        /* 133 */ array(),
        /* 134 */ array(),
        /* 135 */ array(),
        /* 136 */ array(),
        /* 137 */ array(),
        /* 138 */ array(),
        /* 139 */ array(),
        /* 140 */ array(),
        /* 141 */ array(),
        /* 142 */ array(),
        /* 143 */ array(),
        /* 144 */ array(),
        /* 145 */ array(),
        /* 146 */ array(),
        /* 147 */ array(),
        /* 148 */ array(),
        /* 149 */ array(),
        /* 150 */ array(),
        /* 151 */ array(),
        /* 152 */ array(),
        /* 153 */ array(),
        /* 154 */ array(),
        /* 155 */ array(),
        /* 156 */ array(),
        /* 157 */ array(),
        /* 158 */ array(),
        /* 159 */ array(),
        /* 160 */ array(),
        /* 161 */ array(),
        /* 162 */ array(),
        /* 163 */ array(),
        /* 164 */ array(),
        /* 165 */ array(),
        /* 166 */ array(),
        /* 167 */ array(),
        /* 168 */ array(),
        /* 169 */ array(),
        /* 170 */ array(),
);
    static public $yy_default = array(
 /*     0 */   173,  234,  234,  234,  234,  234,  234,  234,  234,  234,
 /*    10 */   234,  234,  234,  234,  234,  234,  234,  234,  234,  234,
 /*    20 */   234,  234,  234,  234,  234,  234,  211,  234,  234,  234,
 /*    30 */   234,  234,  234,  234,  234,  234,  234,  234,  234,  171,
 /*    40 */   234,  234,  234,  234,  234,  234,  234,  234,  234,  173,
 /*    50 */   234,  234,  234,  234,  234,  234,  234,  234,  234,  234,
 /*    60 */   234,  234,  234,  173,  173,  173,  173,  173,  173,  173,
 /*    70 */   173,  173,  173,  173,  234,  234,  225,  227,  226,  234,
 /*    80 */   229,  234,  234,  234,  234,  234,  234,  234,  234,  234,
 /*    90 */   234,  234,  234,  234,  234,  234,  212,  234,  234,  234,
 /*   100 */   213,  234,  234,  234,  218,  234,  234,  234,  234,  234,
 /*   110 */   234,  234,  214,  234,  234,  234,  234,  234,  234,  234,
 /*   120 */   210,  172,  231,  192,  193,  224,  194,  232,  199,  195,
 /*   130 */   178,  228,  198,  174,  230,  197,  196,  191,  206,  190,
 /*   140 */   220,  209,  221,  202,  183,  185,  184,  233,  182,  179,
 /*   150 */   180,  204,  207,  181,  208,  201,  215,  200,  222,  203,
 /*   160 */   187,  219,  188,  177,  186,  216,  223,  217,  175,  176,
 /*   170 */   205,
);
/* The next thing included is series of defines which control
** various aspects of the generated parser.
**    self::YYNOCODE      is a number which corresponds
**                        to no legal terminal or nonterminal number.  This
**                        number is used to fill in empty slots of the hash 
**                        table.
**    self::YYFALLBACK    If defined, this indicates that one or more tokens
**                        have fall-back values which should be used if the
**                        original value of the token will not parse.
**    self::YYSTACKDEPTH  is the maximum depth of the parser's stack.
**    self::YYNSTATE      the combined number of states.
**    self::YYNRULE       the number of rules in the grammar
**    self::YYERRORSYMBOL is the code number of the error symbol.  If not
**                        defined, then do no error processing.
*/
    const YYNOCODE = 75;
    const YYSTACKDEPTH = 100;
    const YYNSTATE = 171;
    const YYNRULE = 63;
    const YYERRORSYMBOL = 51;
    const YYERRSYMDT = 'yy0';
    const YYFALLBACK = 0;
    /** The next table maps tokens into fallback tokens.  If a construct
     * like the following:
     * 
     *      %fallback ID X Y Z.
     *
     * appears in the grammer, then ID becomes a fallback token for X, Y,
     * and Z.  Whenever one of the tokens X, Y, or Z is input to the parser
     * but it does not parse, the type of the token is changed to ID and
     * the parse is retried before an error is thrown.
     */
    static public $yyFallback = array(
    );
    /**
     * Turn parser tracing on by giving a stream to which to write the trace
     * and a prompt to preface each trace message.  Tracing is turned off
     * by making either argument NULL 
     *
     * Inputs:
     * 
     * - A stream resource to which trace output should be written.
     *   If NULL, then tracing is turned off.
     * - A prefix string written at the beginning of every
     *   line of trace output.  If NULL, then tracing is
     *   turned off.
     *
     * Outputs:
     * 
     * - None.
     * @param resource
     * @param string
     */
    static function Trace($TraceFILE, $zTracePrompt)
    {
        if (!$TraceFILE) {
            $zTracePrompt = 0;
        } elseif (!$zTracePrompt) {
            $TraceFILE = 0;
        }
        self::$yyTraceFILE = $TraceFILE;
        self::$yyTracePrompt = $zTracePrompt;
    }

    /**
     * Output debug information to output (php://output stream)
     */
    static function PrintTrace()
    {
        self::$yyTraceFILE = fopen('php://output', 'w');
        self::$yyTracePrompt = '';
    }

    /**
     * @var resource|0
     */
    static public $yyTraceFILE;
    /**
     * String to prepend to debug output
     * @var string|0
     */
    static public $yyTracePrompt;
    /**
     * @var int
     */
    public $yyidx;                    /* Index of top element in stack */
    /**
     * @var int
     */
    public $yyerrcnt;                 /* Shifts left before out of the error */
    /**
     * @var array
     */
    public $yystack = array();  /* The parser's stack */

    /**
     * For tracing shifts, the names of all terminals and nonterminals
     * are required.  The following table supplies these names
     * @var array
     */
    static public $yyTokenName = array( 
  '$',             'T_OPEN_TAG',    'T_AND',         'T_OR',        
  'T_EQ',          'T_NE',          'T_PLUS',        'T_MINUS',     
  'T_TIMES',       'T_DIV',         'T_MOD',         'T_HTML',      
  'T_COMMENT_OPEN',  'T_COMMENT',     'T_PRINT_OPEN',  'T_PRINT_CLOSE',
  'T_EXTENDS',     'T_CLOSE_TAG',   'T_INCLUDE',     'T_FOR',       
  'T_AS',          'T_WITH',        'T_ENDWITH',     'T_IN',        
  'T_CLOSEFOR',    'T_EMPTY',       'T_IF',          'T_ENDIF',     
  'T_ELSE',        'T_IFCHANGED',   'T_ENDIFCHANGED',  'T_CUSTOM_END',
  'T_BLOCK',       'T_END_BLOCK',   'T_FILTER',      'T_END_FILTER',
  'T_REGROUP',     'T_BY',          'T_CYCLE',       'T_PIPE',      
  'T_COMMA',       'T_STRING_SINGLE_INIT',  'T_STRING_SINGLE_END',  'T_STRING_DOUBLE_INIT',
  'T_STRING_DOUBLE_END',  'T_STRING_CONTENT',  'T_LPARENT',     'T_RPARENT',   
  'T_NUMERIC',     'T_DOT',         'T_ALPHA',       'error',       
  'start',         'body',          'code',          'stmts',       
  'varname',       'var_or_string',  'stmt',          'for_stmt',    
  'ifchanged_stmt',  'block_stmt',    'filter_stmt',   'custom_stmt', 
  'if_stmt',       'fnc_call_stmt',  'alias',         'list',        
  'cycle',         'regroup',       'expr',          'piped_list',  
  'string',        's_content',   
    );

    /**
     * For tracing reduce actions, the names of all rules are required.
     * @var array
     */
    static public $yyRuleName = array(
 /*   0 */ "start ::= body",
 /*   1 */ "body ::= body code",
 /*   2 */ "body ::=",
 /*   3 */ "code ::= T_OPEN_TAG stmts",
 /*   4 */ "code ::= T_HTML",
 /*   5 */ "code ::= T_COMMENT_OPEN T_COMMENT",
 /*   6 */ "code ::= T_PRINT_OPEN varname T_PRINT_CLOSE",
 /*   7 */ "stmts ::= T_EXTENDS var_or_string T_CLOSE_TAG",
 /*   8 */ "stmts ::= stmt T_CLOSE_TAG",
 /*   9 */ "stmts ::= for_stmt",
 /*  10 */ "stmts ::= ifchanged_stmt",
 /*  11 */ "stmts ::= block_stmt",
 /*  12 */ "stmts ::= filter_stmt",
 /*  13 */ "stmts ::= custom_stmt",
 /*  14 */ "stmts ::= if_stmt",
 /*  15 */ "stmts ::= T_INCLUDE var_or_string T_CLOSE_TAG",
 /*  16 */ "stmts ::= fnc_call_stmt",
 /*  17 */ "stmts ::= alias",
 /*  18 */ "fnc_call_stmt ::= varname T_CLOSE_TAG",
 /*  19 */ "fnc_call_stmt ::= varname T_FOR varname T_CLOSE_TAG",
 /*  20 */ "fnc_call_stmt ::= varname T_FOR varname T_AS varname T_CLOSE_TAG",
 /*  21 */ "fnc_call_stmt ::= varname T_AS varname T_CLOSE_TAG",
 /*  22 */ "fnc_call_stmt ::= varname list T_CLOSE_TAG",
 /*  23 */ "fnc_call_stmt ::= varname list T_AS varname T_CLOSE_TAG",
 /*  24 */ "alias ::= T_WITH varname T_AS varname T_CLOSE_TAG body T_OPEN_TAG T_ENDWITH T_CLOSE_TAG",
 /*  25 */ "stmt ::= cycle",
 /*  26 */ "stmt ::= regroup",
 /*  27 */ "for_stmt ::= T_FOR varname T_IN varname T_CLOSE_TAG body T_OPEN_TAG T_CLOSEFOR T_CLOSE_TAG",
 /*  28 */ "for_stmt ::= T_FOR varname T_IN varname T_CLOSE_TAG body T_OPEN_TAG T_EMPTY T_CLOSE_TAG body T_OPEN_TAG T_CLOSEFOR T_CLOSE_TAG",
 /*  29 */ "if_stmt ::= T_IF expr T_CLOSE_TAG body T_OPEN_TAG T_ENDIF T_CLOSE_TAG",
 /*  30 */ "if_stmt ::= T_IF expr T_CLOSE_TAG body T_OPEN_TAG T_ELSE T_CLOSE_TAG body T_OPEN_TAG T_ENDIF T_CLOSE_TAG",
 /*  31 */ "ifchanged_stmt ::= T_IFCHANGED T_CLOSE_TAG body T_OPEN_TAG T_ENDIFCHANGED T_CLOSE_TAG",
 /*  32 */ "ifchanged_stmt ::= T_IFCHANGED list T_CLOSE_TAG body T_OPEN_TAG T_ENDIFCHANGED T_CLOSE_TAG",
 /*  33 */ "ifchanged_stmt ::= T_IFCHANGED T_CLOSE_TAG body T_OPEN_TAG T_ELSE T_CLOSE_TAG body T_OPEN_TAG T_ENDIFCHANGED T_CLOSE_TAG",
 /*  34 */ "ifchanged_stmt ::= T_IFCHANGED list T_CLOSE_TAG body T_OPEN_TAG T_ELSE T_CLOSE_TAG body T_OPEN_TAG T_ENDIFCHANGED T_CLOSE_TAG",
 /*  35 */ "custom_stmt ::= varname T_CLOSE_TAG body T_OPEN_TAG T_CUSTOM_END T_CLOSE_TAG",
 /*  36 */ "block_stmt ::= T_BLOCK varname T_CLOSE_TAG body T_OPEN_TAG T_END_BLOCK T_CLOSE_TAG",
 /*  37 */ "block_stmt ::= T_BLOCK varname T_CLOSE_TAG body T_OPEN_TAG T_END_BLOCK varname T_CLOSE_TAG",
 /*  38 */ "filter_stmt ::= T_FILTER piped_list T_CLOSE_TAG body T_OPEN_TAG T_END_FILTER T_CLOSE_TAG",
 /*  39 */ "regroup ::= T_REGROUP varname T_BY varname T_AS varname",
 /*  40 */ "cycle ::= T_CYCLE list",
 /*  41 */ "cycle ::= T_CYCLE list T_AS varname",
 /*  42 */ "piped_list ::= piped_list T_PIPE varname",
 /*  43 */ "piped_list ::= varname",
 /*  44 */ "list ::= list var_or_string",
 /*  45 */ "list ::= list T_COMMA var_or_string",
 /*  46 */ "list ::= var_or_string",
 /*  47 */ "var_or_string ::= varname",
 /*  48 */ "var_or_string ::= string",
 /*  49 */ "string ::= T_STRING_SINGLE_INIT s_content T_STRING_SINGLE_END",
 /*  50 */ "string ::= T_STRING_DOUBLE_INIT s_content T_STRING_DOUBLE_END",
 /*  51 */ "s_content ::= s_content T_STRING_CONTENT",
 /*  52 */ "s_content ::= T_STRING_CONTENT",
 /*  53 */ "expr ::= T_LPARENT expr T_RPARENT",
 /*  54 */ "expr ::= expr T_AND expr",
 /*  55 */ "expr ::= expr T_OR expr",
 /*  56 */ "expr ::= expr T_EQ|T_NE expr",
 /*  57 */ "expr ::= expr T_TIMES|T_DIV|T_MOD expr",
 /*  58 */ "expr ::= expr T_PLUS|T_MINUS expr",
 /*  59 */ "expr ::= var_or_string",
 /*  60 */ "expr ::= T_NUMERIC",
 /*  61 */ "varname ::= varname T_DOT T_ALPHA",
 /*  62 */ "varname ::= T_ALPHA",
    );

    /**
     * This function returns the symbolic name associated with a token
     * value.
     * @param int
     * @return string
     */
    function tokenName($tokenType)
    {
        if ($tokenType === 0) {
            return 'End of Input';
        }
        if ($tokenType > 0 && $tokenType < count(self::$yyTokenName)) {
            return self::$yyTokenName[$tokenType];
        } else {
            return "Unknown";
        }
    }

    /**
     * The following function deletes the value associated with a
     * symbol.  The symbol can be either a terminal or nonterminal.
     * @param int the symbol code
     * @param mixed the symbol's value
     */
    static function yy_destructor($yymajor, $yypminor)
    {
        switch ($yymajor) {
        /* Here is inserted the actions which take place when a
        ** terminal or non-terminal is destroyed.  This can happen
        ** when the symbol is popped from the stack during a
        ** reduce or during error processing or when a parser is 
        ** being destroyed before it is finished parsing.
        **
        ** Note: during a reduce, the only symbols destroyed are those
        ** which appear on the RHS of the rule, but which are not used
        ** inside the C code.
        */
            default:  break;   /* If no destructor action specified: do nothing */
        }
    }

    /**
     * Pop the parser's stack once.
     *
     * If there is a destructor routine associated with the token which
     * is popped from the stack, then call it.
     *
     * Return the major token number for the symbol popped.
     * @param Haanga_yyParser
     * @return int
     */
    function yy_pop_parser_stack()
    {
        if (!count($this->yystack)) {
            return;
        }
        $yytos = array_pop($this->yystack);
        if (self::$yyTraceFILE && $this->yyidx >= 0) {
            fwrite(self::$yyTraceFILE,
                self::$yyTracePrompt . 'Popping ' . self::$yyTokenName[$yytos->major] .
                    "\n");
        }
        $yymajor = $yytos->major;
        self::yy_destructor($yymajor, $yytos->minor);
        $this->yyidx--;
        return $yymajor;
    }

    /**
     * Deallocate and destroy a parser.  Destructors are all called for
     * all stack elements before shutting the parser down.
     */
    function __destruct()
    {
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
        if (is_resource(self::$yyTraceFILE)) {
            fclose(self::$yyTraceFILE);
        }
    }

    /**
     * Based on the current state and parser stack, get a list of all
     * possible lookahead tokens
     * @param int
     * @return array
     */
    function yy_get_expected_tokens($token)
    {
        $state = $this->yystack[$this->yyidx]->stateno;
        $expected = self::$yyExpectedTokens[$state];
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return $expected;
        }
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
                    if ($done++ == 100) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return array_unique($expected);
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate])) {
                        $expected += self::$yyExpectedTokens[$nextstate];
                            if (in_array($token,
                                  self::$yyExpectedTokens[$nextstate], true)) {
                            $this->yyidx = $yyidx;
                            $this->yystack = $stack;
                            return array_unique($expected);
                        }
                    }
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new Haanga_yyStackEntry;
                        $x->stateno = $nextstate;
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return array_unique($expected);
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return $expected;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
        return array_unique($expected);
    }

    /**
     * Based on the parser state and current parser stack, determine whether
     * the lookahead token is possible.
     * 
     * The parser will convert the token value to an error token if not.  This
     * catches some unusual edge cases where the parser would fail.
     * @param int
     * @return bool
     */
    function yy_is_expected_token($token)
    {
        if ($token === 0) {
            return true; // 0 is not part of this
        }
        $state = $this->yystack[$this->yyidx]->stateno;
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return true;
        }
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
                    if ($done++ == 100) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return true;
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate]) &&
                          in_array($token, self::$yyExpectedTokens[$nextstate], true)) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        return true;
                    }
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new Haanga_yyStackEntry;
                        $x->stateno = $nextstate;
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        if (!$token) {
                            // end of input: this is valid
                            return true;
                        }
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return false;
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return true;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
        $this->yyidx = $yyidx;
        $this->yystack = $stack;
        return true;
    }

    /**
     * Find the appropriate action for a parser given the terminal
     * look-ahead token iLookAhead.
     *
     * If the look-ahead token is YYNOCODE, then check to see if the action is
     * independent of the look-ahead.  If it is, return the action, otherwise
     * return YY_NO_ACTION.
     * @param int The look-ahead token
     */
    function yy_find_shift_action($iLookAhead)
    {
        $stateno = $this->yystack[$this->yyidx]->stateno;
     
        /* if ($this->yyidx < 0) return self::YY_NO_ACTION;  */
        if (!isset(self::$yy_shift_ofst[$stateno])) {
            // no shift actions
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_shift_ofst[$stateno];
        if ($i === self::YY_SHIFT_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
        if ($iLookAhead == self::YYNOCODE) {
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            if (count(self::$yyFallback) && $iLookAhead < count(self::$yyFallback)
                   && ($iFallback = self::$yyFallback[$iLookAhead]) != 0) {
                if (self::$yyTraceFILE) {
                    fwrite(self::$yyTraceFILE, self::$yyTracePrompt . "FALLBACK " .
                        self::$yyTokenName[$iLookAhead] . " => " .
                        self::$yyTokenName[$iFallback] . "\n");
                }
                return $this->yy_find_shift_action($iFallback);
            }
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

    /**
     * Find the appropriate action for a parser given the non-terminal
     * look-ahead token $iLookAhead.
     *
     * If the look-ahead token is self::YYNOCODE, then check to see if the action is
     * independent of the look-ahead.  If it is, return the action, otherwise
     * return self::YY_NO_ACTION.
     * @param int Current state number
     * @param int The look-ahead token
     */
    function yy_find_reduce_action($stateno, $iLookAhead)
    {
        /* $stateno = $this->yystack[$this->yyidx]->stateno; */

        if (!isset(self::$yy_reduce_ofst[$stateno])) {
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_reduce_ofst[$stateno];
        if ($i == self::YY_REDUCE_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
        if ($iLookAhead == self::YYNOCODE) {
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

    /**
     * Perform a shift action.
     * @param int The new state to shift in
     * @param int The major token to shift in
     * @param mixed the minor token to shift in
     */
    function yy_shift($yyNewState, $yyMajor, $yypMinor)
    {
        $this->yyidx++;
        if ($this->yyidx >= self::YYSTACKDEPTH) {
            $this->yyidx--;
            if (self::$yyTraceFILE) {
                fprintf(self::$yyTraceFILE, "%sStack Overflow!\n", self::$yyTracePrompt);
            }
            while ($this->yyidx >= 0) {
                $this->yy_pop_parser_stack();
            }
            /* Here code is inserted which will execute if the parser
            ** stack ever overflows */
            return;
        }
        $yytos = new Haanga_yyStackEntry;
        $yytos->stateno = $yyNewState;
        $yytos->major = $yyMajor;
        $yytos->minor = $yypMinor;
        array_push($this->yystack, $yytos);
        if (self::$yyTraceFILE && $this->yyidx > 0) {
            fprintf(self::$yyTraceFILE, "%sShift %d\n", self::$yyTracePrompt,
                $yyNewState);
            fprintf(self::$yyTraceFILE, "%sStack:", self::$yyTracePrompt);
            for($i = 1; $i <= $this->yyidx; $i++) {
                fprintf(self::$yyTraceFILE, " %s",
                    self::$yyTokenName[$this->yystack[$i]->major]);
            }
            fwrite(self::$yyTraceFILE,"\n");
        }
    }

    /**
     * The following table contains information about every rule that
     * is used during the reduce.
     *
     * <pre>
     * array(
     *  array(
     *   int $lhs;         Symbol on the left-hand side of the rule
     *   int $nrhs;     Number of right-hand side symbols in the rule
     *  ),...
     * );
     * </pre>
     */
    static public $yyRuleInfo = array(
  array( 'lhs' => 52, 'rhs' => 1 ),
  array( 'lhs' => 53, 'rhs' => 2 ),
  array( 'lhs' => 53, 'rhs' => 0 ),
  array( 'lhs' => 54, 'rhs' => 2 ),
  array( 'lhs' => 54, 'rhs' => 1 ),
  array( 'lhs' => 54, 'rhs' => 2 ),
  array( 'lhs' => 54, 'rhs' => 3 ),
  array( 'lhs' => 55, 'rhs' => 3 ),
  array( 'lhs' => 55, 'rhs' => 2 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 3 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 55, 'rhs' => 1 ),
  array( 'lhs' => 65, 'rhs' => 2 ),
  array( 'lhs' => 65, 'rhs' => 4 ),
  array( 'lhs' => 65, 'rhs' => 6 ),
  array( 'lhs' => 65, 'rhs' => 4 ),
  array( 'lhs' => 65, 'rhs' => 3 ),
  array( 'lhs' => 65, 'rhs' => 5 ),
  array( 'lhs' => 66, 'rhs' => 9 ),
  array( 'lhs' => 58, 'rhs' => 1 ),
  array( 'lhs' => 58, 'rhs' => 1 ),
  array( 'lhs' => 59, 'rhs' => 9 ),
  array( 'lhs' => 59, 'rhs' => 13 ),
  array( 'lhs' => 64, 'rhs' => 7 ),
  array( 'lhs' => 64, 'rhs' => 11 ),
  array( 'lhs' => 60, 'rhs' => 6 ),
  array( 'lhs' => 60, 'rhs' => 7 ),
  array( 'lhs' => 60, 'rhs' => 10 ),
  array( 'lhs' => 60, 'rhs' => 11 ),
  array( 'lhs' => 63, 'rhs' => 6 ),
  array( 'lhs' => 61, 'rhs' => 7 ),
  array( 'lhs' => 61, 'rhs' => 8 ),
  array( 'lhs' => 62, 'rhs' => 7 ),
  array( 'lhs' => 69, 'rhs' => 6 ),
  array( 'lhs' => 68, 'rhs' => 2 ),
  array( 'lhs' => 68, 'rhs' => 4 ),
  array( 'lhs' => 71, 'rhs' => 3 ),
  array( 'lhs' => 71, 'rhs' => 1 ),
  array( 'lhs' => 67, 'rhs' => 2 ),
  array( 'lhs' => 67, 'rhs' => 3 ),
  array( 'lhs' => 67, 'rhs' => 1 ),
  array( 'lhs' => 57, 'rhs' => 1 ),
  array( 'lhs' => 57, 'rhs' => 1 ),
  array( 'lhs' => 72, 'rhs' => 3 ),
  array( 'lhs' => 72, 'rhs' => 3 ),
  array( 'lhs' => 73, 'rhs' => 2 ),
  array( 'lhs' => 73, 'rhs' => 1 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 3 ),
  array( 'lhs' => 70, 'rhs' => 1 ),
  array( 'lhs' => 70, 'rhs' => 1 ),
  array( 'lhs' => 56, 'rhs' => 3 ),
  array( 'lhs' => 56, 'rhs' => 1 ),
    );

    /**
     * The following table contains a mapping of reduce action to method name
     * that handles the reduction.
     * 
     * If a rule is not set, it has no handler.
     */
    static public $yyReduceMap = array(
        0 => 0,
        1 => 1,
        2 => 2,
        3 => 3,
        9 => 3,
        10 => 3,
        11 => 3,
        12 => 3,
        13 => 3,
        14 => 3,
        16 => 3,
        17 => 3,
        25 => 3,
        26 => 3,
        52 => 3,
        59 => 3,
        60 => 3,
        62 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        15 => 15,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => 21,
        22 => 22,
        23 => 23,
        24 => 24,
        27 => 27,
        28 => 28,
        29 => 29,
        30 => 30,
        31 => 31,
        32 => 32,
        33 => 33,
        34 => 34,
        35 => 35,
        36 => 36,
        37 => 37,
        38 => 38,
        39 => 39,
        40 => 40,
        41 => 41,
        42 => 42,
        45 => 42,
        43 => 43,
        46 => 43,
        44 => 44,
        47 => 47,
        48 => 48,
        49 => 49,
        50 => 49,
        51 => 51,
        53 => 53,
        54 => 54,
        55 => 54,
        56 => 54,
        57 => 54,
        58 => 54,
        61 => 61,
    );
    /* Beginning here are the reduction cases.  A typical example
    ** follows:
    **  #line <lineno> <grammarfile>
    **   function yy_r0($yymsp){ ... }           // User supplied code
    **  #line <lineno> <thisfile>
    */
#line 63 "parser.y"
    function yy_r0(){ $this->body = $this->yystack[$this->yyidx + 0]->minor;     }
#line 1293 "parser.php"
#line 65 "parser.y"
    function yy_r1(){ $this->_retvalue=$this->yystack[$this->yyidx + -1]->minor; $this->_retvalue[] = $this->yystack[$this->yyidx + 0]->minor;     }
#line 1296 "parser.php"
#line 66 "parser.y"
    function yy_r2(){ $this->_retvalue = array();     }
#line 1299 "parser.php"
#line 69 "parser.y"
    function yy_r3(){ $this->_retvalue = $this->yystack[$this->yyidx + 0]->minor;     }
#line 1302 "parser.php"
#line 70 "parser.y"
    function yy_r4(){ $this->_retvalue = array('operation' => 'html', 'html' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1305 "parser.php"
#line 71 "parser.y"
    function yy_r5(){ $this->yystack[$this->yyidx + 0]->minor=rtrim($this->yystack[$this->yyidx + 0]->minor); $this->_retvalue = array('operation' => 'comment', 'comment' => substr($this->yystack[$this->yyidx + 0]->minor, 0, strlen($this->yystack[$this->yyidx + 0]->minor)-2));     }
#line 1308 "parser.php"
#line 72 "parser.y"
    function yy_r6(){ $this->_retvalue = array('operation' => 'print', 'variable' => $this->yystack[$this->yyidx + -1]->minor);     }
#line 1311 "parser.php"
#line 74 "parser.y"
    function yy_r7(){ $this->_retvalue = array('operation' => 'base', $this->yystack[$this->yyidx + -1]->minor);     }
#line 1314 "parser.php"
#line 75 "parser.y"
    function yy_r8(){ $this->_retvalue = $this->yystack[$this->yyidx + -1]->minor;     }
#line 1317 "parser.php"
#line 82 "parser.y"
    function yy_r15(){ $this->_retvalue = array('operation' => 'include', $this->yystack[$this->yyidx + -1]->minor);     }
#line 1320 "parser.php"
#line 89 "parser.y"
    function yy_r18(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -1]->minor, 'list'=>array());     }
#line 1323 "parser.php"
#line 90 "parser.y"
    function yy_r19(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -3]->minor, 'for' => $this->yystack[$this->yyidx + -1]->minor, 'list' => array());     }
#line 1326 "parser.php"
#line 91 "parser.y"
    function yy_r20(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -5]->minor, 'for' => $this->yystack[$this->yyidx + -3]->minor, 'list' => array(),'as' => $this->yystack[$this->yyidx + -1]->minor);     }
#line 1329 "parser.php"
#line 92 "parser.y"
    function yy_r21(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -3]->minor, 'as' => $this->yystack[$this->yyidx + -1]->minor);     }
#line 1332 "parser.php"
#line 93 "parser.y"
    function yy_r22(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -2]->minor, 'list' => $this->yystack[$this->yyidx + -1]->minor);     }
#line 1335 "parser.php"
#line 94 "parser.y"
    function yy_r23(){ $this->_retvalue = array('operation' => 'function', 'name' => $this->yystack[$this->yyidx + -4]->minor, 'as' => $this->yystack[$this->yyidx + -1]->minor, 'list' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1338 "parser.php"
#line 97 "parser.y"
    function yy_r24(){ $this->_retvalue = array('operation' => 'alias', 'var' => $this->yystack[$this->yyidx + -7]->minor, 'as' => $this->yystack[$this->yyidx + -5]->minor, 'body' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1341 "parser.php"
#line 104 "parser.y"
    function yy_r27(){ 
    $this->_retvalue = array('operation' => 'loop', 'variable' => $this->yystack[$this->yyidx + -7]->minor, 'array' => $this->yystack[$this->yyidx + -5]->minor, 'body' => $this->yystack[$this->yyidx + -3]->minor); 
    }
#line 1346 "parser.php"
#line 107 "parser.y"
    function yy_r28(){ 
    $this->_retvalue = array('operation' => 'loop', 'variable' => $this->yystack[$this->yyidx + -11]->minor, 'array' => $this->yystack[$this->yyidx + -9]->minor, 'body' => $this->yystack[$this->yyidx + -7]->minor, 'empty' => $this->yystack[$this->yyidx + -3]->minor); 
    }
#line 1351 "parser.php"
#line 111 "parser.y"
    function yy_r29(){ $this->_retvalue = array('operation' => 'if', 'expr' => $this->yystack[$this->yyidx + -5]->minor, 'body' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1354 "parser.php"
#line 112 "parser.y"
    function yy_r30(){ $this->_retvalue = array('operation' => 'if', 'expr' => $this->yystack[$this->yyidx + -9]->minor, 'body' => $this->yystack[$this->yyidx + -7]->minor, 'else' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1357 "parser.php"
#line 115 "parser.y"
    function yy_r31(){ 
    $this->_retvalue = array('operation' => 'ifchanged', 'body' => $this->yystack[$this->yyidx + -3]->minor); 
    }
#line 1362 "parser.php"
#line 119 "parser.y"
    function yy_r32(){ 
    $this->_retvalue = array('operation' => 'ifchanged', 'body' => $this->yystack[$this->yyidx + -3]->minor, 'check' => $this->yystack[$this->yyidx + -5]->minor);
    }
#line 1367 "parser.php"
#line 122 "parser.y"
    function yy_r33(){ 
    $this->_retvalue = array('operation' => 'ifchanged', 'body' => $this->yystack[$this->yyidx + -7]->minor, 'else' => $this->yystack[$this->yyidx + -3]->minor); 
    }
#line 1372 "parser.php"
#line 126 "parser.y"
    function yy_r34(){ 
    $this->_retvalue = array('operation' => 'ifchanged', 'body' => $this->yystack[$this->yyidx + -7]->minor, 'check' => $this->yystack[$this->yyidx + -9]->minor, 'else' => $this->yystack[$this->yyidx + -3]->minor);
    }
#line 1377 "parser.php"
#line 131 "parser.y"
    function yy_r35(){ if ('end'.$this->yystack[$this->yyidx + -5]->minor != $this->yystack[$this->yyidx + -1]->minor) { throw new Exception("Unexpected ".$this->yystack[$this->yyidx + -1]->minor); } $this->_retvalue = array('operation' => 'filter', 'functions' =>array($this->yystack[$this->yyidx + -5]->minor), 'body' => $this->yystack[$this->yyidx + -3]->minor);    }
#line 1380 "parser.php"
#line 134 "parser.y"
    function yy_r36(){ $this->_retvalue = array('operation' => 'block', 'name' => $this->yystack[$this->yyidx + -5]->minor, 'body' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1383 "parser.php"
#line 136 "parser.y"
    function yy_r37(){ $this->_retvalue = array('operation' => 'block', 'name' => $this->yystack[$this->yyidx + -6]->minor, 'body' => $this->yystack[$this->yyidx + -4]->minor);     }
#line 1386 "parser.php"
#line 139 "parser.y"
    function yy_r38(){ $this->_retvalue = array('operation' => 'filter', 'functions' => $this->yystack[$this->yyidx + -5]->minor, 'body' => $this->yystack[$this->yyidx + -3]->minor);     }
#line 1389 "parser.php"
#line 142 "parser.y"
    function yy_r39(){ $this->_retvalue=array('operation' => 'regroup', 'array' => $this->yystack[$this->yyidx + -4]->minor, 'row' => $this->yystack[$this->yyidx + -2]->minor, 'as' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1392 "parser.php"
#line 145 "parser.y"
    function yy_r40(){ $this->_retvalue = array('operation' => 'cycle', 'vars' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1395 "parser.php"
#line 146 "parser.y"
    function yy_r41(){ $this->_retvalue = array('operation' => 'cycle', 'vars' => $this->yystack[$this->yyidx + -2]->minor, 'as' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1398 "parser.php"
#line 149 "parser.y"
    function yy_r42(){ $this->_retvalue = $this->yystack[$this->yyidx + -2]->minor; $this->_retvalue[] = $this->yystack[$this->yyidx + 0]->minor;     }
#line 1401 "parser.php"
#line 150 "parser.y"
    function yy_r43(){ $this->_retvalue = array($this->yystack[$this->yyidx + 0]->minor);     }
#line 1404 "parser.php"
#line 153 "parser.y"
    function yy_r44(){ $this->_retvalue = $this->yystack[$this->yyidx + -1]->minor; $this->_retvalue[] = $this->yystack[$this->yyidx + 0]->minor;     }
#line 1407 "parser.php"
#line 157 "parser.y"
    function yy_r47(){ $this->_retvalue = array('var' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1410 "parser.php"
#line 158 "parser.y"
    function yy_r48(){ $this->_retvalue = array('string' => $this->yystack[$this->yyidx + 0]->minor);     }
#line 1413 "parser.php"
#line 160 "parser.y"
    function yy_r49(){  $this->_retvalue = $this->yystack[$this->yyidx + -1]->minor;     }
#line 1416 "parser.php"
#line 162 "parser.y"
    function yy_r51(){ $this->_retvalue = $this->yystack[$this->yyidx + -1]->minor.$this->yystack[$this->yyidx + 0]->minor;     }
#line 1419 "parser.php"
#line 166 "parser.y"
    function yy_r53(){ $this->_retvalue = array('op' => 'expr', $this->yystack[$this->yyidx + -1]->minor);     }
#line 1422 "parser.php"
#line 167 "parser.y"
    function yy_r54(){ $this->_retvalue = array('op' => @$this->yystack[$this->yyidx + -1]->minor, $this->yystack[$this->yyidx + -2]->minor, $this->yystack[$this->yyidx + 0]->minor);     }
#line 1425 "parser.php"
#line 177 "parser.y"
    function yy_r61(){ if (!is_array($this->yystack[$this->yyidx + -2]->minor)) { $this->_retvalue = array($this->yystack[$this->yyidx + -2]->minor); } else { $this->_retvalue = $this->yystack[$this->yyidx + -2]->minor; }  $this->_retvalue[]=$this->yystack[$this->yyidx + 0]->minor;    }
#line 1428 "parser.php"

    /**
     * placeholder for the left hand side in a reduce operation.
     * 
     * For a parser with a rule like this:
     * <pre>
     * rule(A) ::= B. { A = 1; }
     * </pre>
     * 
     * The parser will translate to something like:
     * 
     * <code>
     * function yy_r0(){$this->_retvalue = 1;}
     * </code>
     */
    private $_retvalue;

    /**
     * Perform a reduce action and the shift that must immediately
     * follow the reduce.
     * 
     * For a rule such as:
     * 
     * <pre>
     * A ::= B blah C. { dosomething(); }
     * </pre>
     * 
     * This function will first call the action, if any, ("dosomething();" in our
     * example), and then it will pop three states from the stack,
     * one for each entry on the right-hand side of the expression
     * (B, blah, and C in our example rule), and then push the result of the action
     * back on to the stack with the resulting state reduced to (as described in the .out
     * file)
     * @param int Number of the rule by which to reduce
     */
    function yy_reduce($yyruleno)
    {
        //int $yygoto;                     /* The next state */
        //int $yyact;                      /* The next action */
        //mixed $yygotominor;        /* The LHS of the rule reduced */
        //Haanga_yyStackEntry $yymsp;            /* The top of the parser's stack */
        //int $yysize;                     /* Amount to pop the stack */
        $yymsp = $this->yystack[$this->yyidx];
        if (self::$yyTraceFILE && $yyruleno >= 0 
              && $yyruleno < count(self::$yyRuleName)) {
            fprintf(self::$yyTraceFILE, "%sReduce (%d) [%s].\n",
                self::$yyTracePrompt, $yyruleno,
                self::$yyRuleName[$yyruleno]);
        }

        $this->_retvalue = $yy_lefthand_side = null;
        if (array_key_exists($yyruleno, self::$yyReduceMap)) {
            // call the action
            $this->_retvalue = null;
            $this->{'yy_r' . self::$yyReduceMap[$yyruleno]}();
            $yy_lefthand_side = $this->_retvalue;
        }
        $yygoto = self::$yyRuleInfo[$yyruleno]['lhs'];
        $yysize = self::$yyRuleInfo[$yyruleno]['rhs'];
        $this->yyidx -= $yysize;
        for($i = $yysize; $i; $i--) {
            // pop all of the right-hand side parameters
            array_pop($this->yystack);
        }
        $yyact = $this->yy_find_reduce_action($this->yystack[$this->yyidx]->stateno, $yygoto);
        if ($yyact < self::YYNSTATE) {
            /* If we are not debugging and the reduce action popped at least
            ** one element off the stack, then we can push the new element back
            ** onto the stack here, and skip the stack overflow test in yy_shift().
            ** That gives a significant speed improvement. */
            if (!self::$yyTraceFILE && $yysize) {
                $this->yyidx++;
                $x = new Haanga_yyStackEntry;
                $x->stateno = $yyact;
                $x->major = $yygoto;
                $x->minor = $yy_lefthand_side;
                $this->yystack[$this->yyidx] = $x;
            } else {
                $this->yy_shift($yyact, $yygoto, $yy_lefthand_side);
            }
        } elseif ($yyact == self::YYNSTATE + self::YYNRULE + 1) {
            $this->yy_accept();
        }
    }

    /**
     * The following code executes when the parse fails
     * 
     * Code from %parse_fail is inserted here
     */
    function yy_parse_failed()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sFail!\n", self::$yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
        /* Here code is inserted which will be executed whenever the
        ** parser fails */
    }

    /**
     * The following code executes when a syntax error first occurs.
     * 
     * %syntax_error code is inserted here
     * @param int The major type of the error token
     * @param mixed The minor type of the error token
     */
    function yy_syntax_error($yymajor, $TOKEN)
    {
#line 54 "parser.y"

    $expect = array();
    foreach ($this->yy_get_expected_tokens($yymajor) as $token) {
        $expect[] = self::$yyTokenName[$token];
    }
    throw new Exception('Unexpected ' . $this->tokenName($yymajor) . '(' . $TOKEN. '), expected one of: ' . implode(',', $expect));
#line 1548 "parser.php"
    }

    /**
     * The following is executed when the parser accepts
     * 
     * %parse_accept code is inserted here
     */
    function yy_accept()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sAccept!\n", self::$yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $stack = $this->yy_pop_parser_stack();
        }
        /* Here code is inserted which will be executed whenever the
        ** parser accepts */
#line 44 "parser.y"

#line 1569 "parser.php"
    }

    /**
     * The main parser program.
     * 
     * The first argument is the major token number.  The second is
     * the token value string as scanned from the input.
     *
     * @param int the token number
     * @param mixed the token value
     * @param mixed any extra arguments that should be passed to handlers
     */
    function doParse($yymajor, $yytokenvalue)
    {
//        $yyact;            /* The parser action. */
//        $yyendofinput;     /* True if we are at the end of input */
        $yyerrorhit = 0;   /* True if yymajor has invoked an error */
        
        /* (re)initialize the parser, if necessary */
        if ($this->yyidx === null || $this->yyidx < 0) {
            /* if ($yymajor == 0) return; // not sure why this was here... */
            $this->yyidx = 0;
            $this->yyerrcnt = -1;
            $x = new Haanga_yyStackEntry;
            $x->stateno = 0;
            $x->major = 0;
            $this->yystack = array();
            array_push($this->yystack, $x);
        }
        $yyendofinput = ($yymajor==0);
        
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sInput %s\n",
                self::$yyTracePrompt, self::$yyTokenName[$yymajor]);
        }
        
        do {
            $yyact = $this->yy_find_shift_action($yymajor);
            if ($yymajor < self::YYERRORSYMBOL &&
                  !$this->yy_is_expected_token($yymajor)) {
                // force a syntax error
                $yyact = self::YY_ERROR_ACTION;
            }
            if ($yyact < self::YYNSTATE) {
                $this->yy_shift($yyact, $yymajor, $yytokenvalue);
                $this->yyerrcnt--;
                if ($yyendofinput && $this->yyidx >= 0) {
                    $yymajor = 0;
                } else {
                    $yymajor = self::YYNOCODE;
                }
            } elseif ($yyact < self::YYNSTATE + self::YYNRULE) {
                $this->yy_reduce($yyact - self::YYNSTATE);
            } elseif ($yyact == self::YY_ERROR_ACTION) {
                if (self::$yyTraceFILE) {
                    fprintf(self::$yyTraceFILE, "%sSyntax Error!\n",
                        self::$yyTracePrompt);
                }
                if (self::YYERRORSYMBOL) {
                    /* A syntax error has occurred.
                    ** The response to an error depends upon whether or not the
                    ** grammar defines an error token "ERROR".  
                    **
                    ** This is what we do if the grammar does define ERROR:
                    **
                    **  * Call the %syntax_error function.
                    **
                    **  * Begin popping the stack until we enter a state where
                    **    it is legal to shift the error symbol, then shift
                    **    the error symbol.
                    **
                    **  * Set the error count to three.
                    **
                    **  * Begin accepting and shifting new tokens.  No new error
                    **    processing will occur until three tokens have been
                    **    shifted successfully.
                    **
                    */
                    if ($this->yyerrcnt < 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $yymx = $this->yystack[$this->yyidx]->major;
                    if ($yymx == self::YYERRORSYMBOL || $yyerrorhit ){
                        if (self::$yyTraceFILE) {
                            fprintf(self::$yyTraceFILE, "%sDiscard input token %s\n",
                                self::$yyTracePrompt, self::$yyTokenName[$yymajor]);
                        }
                        $this->yy_destructor($yymajor, $yytokenvalue);
                        $yymajor = self::YYNOCODE;
                    } else {
                        while ($this->yyidx >= 0 &&
                                 $yymx != self::YYERRORSYMBOL &&
        ($yyact = $this->yy_find_shift_action(self::YYERRORSYMBOL)) >= self::YYNSTATE
                              ){
                            $this->yy_pop_parser_stack();
                        }
                        if ($this->yyidx < 0 || $yymajor==0) {
                            $this->yy_destructor($yymajor, $yytokenvalue);
                            $this->yy_parse_failed();
                            $yymajor = self::YYNOCODE;
                        } elseif ($yymx != self::YYERRORSYMBOL) {
                            $u2 = 0;
                            $this->yy_shift($yyact, self::YYERRORSYMBOL, $u2);
                        }
                    }
                    $this->yyerrcnt = 3;
                    $yyerrorhit = 1;
                } else {
                    /* YYERRORSYMBOL is not defined */
                    /* This is what we do if the grammar does not define ERROR:
                    **
                    **  * Report an error message, and throw away the input token.
                    **
                    **  * If the input token is $, then fail the parse.
                    **
                    ** As before, subsequent error messages are suppressed until
                    ** three input tokens have been successfully shifted.
                    */
                    if ($this->yyerrcnt <= 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $this->yyerrcnt = 3;
                    $this->yy_destructor($yymajor, $yytokenvalue);
                    if ($yyendofinput) {
                        $this->yy_parse_failed();
                    }
                    $yymajor = self::YYNOCODE;
                }
            } else {
                $this->yy_accept();
                $yymajor = self::YYNOCODE;
            }            
        } while ($yymajor != self::YYNOCODE && $this->yyidx >= 0);
    }
}