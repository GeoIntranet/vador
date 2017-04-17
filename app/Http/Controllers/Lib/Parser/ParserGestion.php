<?php
namespace App\Http\Controllers\Lib\Parser;
/**
 * Created by PhpStorm.
 * User: Cana
 * Date: 28/08/2016
 * Time: 23:02
 */
class ParserGestion
{

    protected $bbc;
    protected $replace;

    /**
     * ParserGestion constructor.
     * @param $rules
     */
    public function __construct()
    {
        $this->bbc =  [
            '~\[b\](.*?)\[/b\]~s',
            '~\[td\](.*?)\[/td\]~s',
            '~\[tr\](.*?)\[/tr\]~s',
            '~\[table\](.*?)\[/table\]~s',
            '~\[i\](.*?)\[/i\]~s',
            '~\[u\](.*?)\[/u\]~s',
            '~\[quote\](.*?)\[/quote\]~s',
            '~\[size=(.*?)\](.*?)\[/size\]~s',
            '~\[size=(100)\](.*?)\[/size\]~s',
            '~\[color=(.*?)\](.*?)\[/color\]~s',
            '~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
            '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
        ];

        $this->replace =[
                '<b>$1</b>',
                '<td>$1</td>',
                '<tr>$1</tr>',
                '<table>$1</table>',
                '<i>$1</i>',
                '<span style="text-decoration:underline;">$1</span>',
                '<pre>$1</'.'pre>',
                '<h1>$2</'.'h1>',
                '<span style="font-size:$1px;">$2</span>',
                '<span style="color:$1;">$2</span>',
                '<a href="$1">$1</a>',
                '<img src="$1" alt="" />'
        ];
    }

    public function parse($data)
    {
        return preg_replace($this->bbc,$this->replace,$data);
    }


}