<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Jimes Yang aka sndnvaps <sndnvaps@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Longman\TelegramBot\Commands;
use Longman\TelegramBot\Command;
use Longman\TelegramBot\Request;
/**
 * User "/time" command
 */
class TimeCommand extends Command
{
    /**#@+
     * {@inheritdoc}
     */
    protected $name = 'time';
    protected $description = 'Show current time';
    protected $usage = '/time ';
    protected $version = '1.0.1';
    protected $public = true;

     //set time zone 
/* * Time Zone as Below */
/*
时区与 UTC 的偏移量描述：
KLT +14:00 基里巴斯线岛时间
NZDT +13:00 新西兰夏时制
IDLW +12:00 国际日期变更线，西边
NZST +12:00 新西兰标准时间
NZT +12:00 新西兰时间
AESST +11:00 澳大利亚东部标准夏时制 （俄罗斯马加丹时区） 东边（俄罗斯彼得罗巴甫洛夫斯克时区）
ACSST +10:30 中澳大利亚标准夏时制
CADT +10:30 中澳大利亚夏时制
SADT +10:30 南澳大利亚夏时制
AEST +10:00 澳大利亚东部标准时间
EAST +10:00 东澳大利亚标准时间
GST +10:00 关岛标准时间，（俄罗斯符拉迪沃斯托克时区）
LIGT +10:00 澳大利亚墨尔本
SAST +09:30 南澳大利亚标准时间
CAST +09:30 中澳大利亚标准时间
MHT +09:00马绍尔群岛瓜加林岛时间
JST +09:00 日本标准时间，（俄罗斯雅库茨克时区）
KST +09:00韩国标准时间
KST +08:30朝鲜平壤时间
AWST +08:00 澳大利亚西部标准时间
CCT +08:00 中国北京时间（俄罗斯伊尔库茨克时区）
WST +08:00 西澳大利亚标准时间
JT +07:30 爪哇时间
ALMST +07:00 阿拉木图 夏令时（俄罗斯泰梅尔半岛时区）
CXT +07:00 澳大利亚圣诞岛时间
MMT +06:30 缅甸时间
ALMT +06:00 哈萨克斯坦阿拉木图 时间（俄罗斯鄂木斯克时区）

IOT +05:00 英属印度洋领地时间（俄罗斯彼尔姆时区）
MVT +05:00 马尔代夫时间
TFT +05:00 法属凯尔盖朗岛时间
AFT +04:30 阿富汗时间
EAST +04:00 马达加斯加塔那那利佛时间 （俄罗斯萨马拉时区）
MUT +04:00 毛里求斯时间
RET +04:00 法属留尼汪岛时间
SCT +04:00 塞舌尔马埃岛时间
IRT,IT +03:30 伊朗时间
EAT +03:00 科摩罗时间
BT +03:00 巴格达时间
EETDST +03:00 东欧夏时制（俄罗斯莫斯科时区）
HMT +03:00 希腊地中海时间
BDST +02:00 英国双重标准时间
CEST +02:00 中欧夏令时
CETDST +02:00 中欧夏时制
EET +02:00 东欧（俄罗斯加里宁格勒时区）
FWT +02:00 法国冬时制
IST +02:00 以色列标准时间
MEST +02:00 中欧夏时制
METDST +02:00 中欧白昼时间
SST +02:00 瑞典夏时制
BST +01:00 英国夏时制
时区
时区 (6张)
CET +01:00 中欧时间
DNT +01:00 丹麦正规时间
FST +01:00 法国夏时制
MET +01:00 中欧时间
NOR +01:00 挪威标准时间
SWT +01:00 瑞典冬时制
WETDST +01:00 西欧光照利用时间（夏时制）
GMT 0:00 格林尼治标准时间
UT +00:00 全球时间
UTC +00:00 校准的全球时间
ZULU +00:00 和 UTC 相同
WET +00:00 西欧
WAT -01:00 西非时间
FNST -01:00 巴西费尔南多·迪诺罗尼亚岛 夏令时
FNT -02:00 巴西费尔南多·迪诺罗尼亚岛时间
BRST -02:00 巴西利亚夏令时
NDT -02:30 纽芬兰夏时制
ADT -03:00 大西洋夏时制
BRT -03:00 巴西利亚时间
NST,NFT -03:30 纽芬兰（Newfoundland）标准时间
AST -04:00 大西洋标准时间（加拿大）
ACST -04:00 大西洋阿雷格里港夏令时
ACT -05:00 大西洋阿雷格里港 标准时间
EDT -04:00 东部夏时制
CDT -05:00 中部夏时制
EST -05:00 东部标准时间
CST -06:00 中部标准时间
MDT -06:00 山地夏时制
MST -07:00 山地标准时间
PDT -07:00 太平洋夏时制
AKDT -08:00 阿拉斯加白昼时间
PST -08:00 太平洋标准时间
YST -08:00 育空地区标准时
AKST -09:00 阿拉斯加标准时间
HDT -09:00 夏威夷/阿拉斯加夏时制
MART -09:30 马克萨斯群岛时间
AHST -10:00 夏威夷-阿拉斯加标准时间
HST -10:00 夏威夷标准时间
CAT -10:00 中阿拉斯加时间
NT -11:00 阿拉斯加诺姆时间（Nome Time）
IDLE -12:00 国际日期变更线，东边
澳大利亚时区. 澳大利亚时区名和南北美常用的时区名之间有三个冲突：ACST，CST，和 EST。
澳大利亚时区缩写，时区与UTC的偏移量描述：
ACST +09:30 中澳大利亚标准时间
CST +10:30 澳大利亚中部标准时间
EST +10:00 澳大利亚东部标准时间
SAT +09:30 南澳大利亚标准时间
澳大利亚时区. 澳大利亚时区名和马达加斯加塔那那利佛时间冲突：EAST。
澳大利亚时区缩写，时区与UTC的偏移量描述：
EAST +10:00 东澳大利亚标准时间
*/  




// date_default_timezone_set('UTC+1');
    /**#@-*/
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
	date_default_timezone_set("PRC");
	// date_default_timezone_set("EST");
	$message = $this->getMessage();
        $message_id = $message->getMessageId();
	$chat_id = $message->getChat()->getId();
 //       $text = trim($message->getText(true));
        $text = strftime ("Time is %F  %H:%M:%S" ,time());
        $data = [
            'chat_id' => $chat_id,
             'reply_to_message_id' => $message_id,   
	     'text'    => $text,
        ];
        return Request::sendMessage($data);
    }
}
