<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 7:00 PM
 */

namespace Angujo\OpenRosaPhp\Libraries;

class Elmt
{
    public const LABEL            = 'label';
    public const HINT             = 'hint';
    public const OUTPUT           = 'output';
    public const ITEM             = 'item';
    public const ITEMSET          = 'itemset';
    public const VALUE            = 'value';
    public const GROUP            = 'group';
    public const REPEAT           = 'repeat';
    public const BIND             = 'bind';
    public const RANGE            = 'range';
    public const INPUT            = 'input';
    public const SELECT           = 'select';
    public const SELECT1          = 'select1';
    public const BODY             = 'body';
    public const INSTANCE         = 'instance';
    public const ITEXTID          = 'itextId';
    public const META             = 'meta';
    public const HEAD             = 'head';
    public const MODEL            = 'model';
    public const HTML             = 'html';
    public const ITEXT            = 'itext';
    public const TEXT             = 'text';
    public const XFORM            = 'xform';
    public const SUBMISSION            = 'submission';
    public const XFORMS           = 'xforms';
    public const XFORMGROUP       = 'xform-group';
    public const TRANSLATION      = 'translation';
    public const OPENROSARESPONSE = 'OpenRosaResponse';
    public const MESSAGE      = 'message';

    public static $DATA_TYPES = ['string', 'int', 'boolean', 'decimal', 'date', 'time', 'dateTime', 'geopoint', 'geotrace', 'geoshape', 'binary', 'barcode', 'intent'];
}
